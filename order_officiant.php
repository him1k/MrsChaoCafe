<?php
// Подключение к базе данных
$mysqli = require "connect/bd.php";

if ($mysqli->connect_error) {
    die("Соединение с базой данных не удалось: " . $mysqli->connect_error);
}

// Получаем данные из POST-запроса
$tableNumber = $_POST['tableNumber'] ?? null;
$comment = $_POST['comment'] ?? null;
$idOfficiant = $_POST['id_of'] ?? null;
$dishes = $_POST['orders'] ?? [];


// Проверка на наличие необходимых данных
if ($tableNumber && $idOfficiant && !empty($dishes)) {
    // Начало транзакции
    $mysqli->begin_transaction();

    try {
        // Вставка нового заказа
        $stmt = $mysqli->prepare("INSERT INTO `orders` (`table_number`, `datetime`, `id_client`, `id_of`, `sum`) VALUES (?, NOW(), NULL, ?, ?)");

        // Проверка запроса
        if (!$stmt) {
            die("Ошибка подготовки запроса: " . $mysqli->error);
        }

        // Подсчет суммы заказа
        $sum = 0;
        foreach ($dishes as $order) {
            $sum += $order['total_price'];
        }

        // Вставка
        $stmt->bind_param("iii", $tableNumber, $idOfficiant, $sum);
        $result = $stmt->execute();

        // Проверка вставки
        if (!$result) {
            throw new Exception("Ошибка выполнения запроса: " . $stmt->error);
        }

        $order_id = $mysqli->insert_id; // Получаем ID последнего вставленного заказа
        $stmt->close();

        // Статус = не готово
        $status = 1;

        // Значение по умолчанию
        $idCook = 1;

        // Вставка блюд в order_dish
        $stmt = $mysqli->prepare("INSERT INTO `order_dish` (`id_order`, `id_dish`, `quantity`, `status`, `id_cook`, `comment`) VALUES (?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса для вставки блюд: " . $mysqli->error);
        }

        foreach ($dishes as $dish) {
            $idDish = $dish['id_dish']; // Предполагаем, что id_dish передается в массиве $dishes
            $quantity = $dish['quantity']; // Предполагаем, что quantity передается в массиве $dishes

            $stmt->bind_param("iiiiis", $order_id, $idDish, $quantity, $status, $idCook, $comment);
            $result = $stmt->execute();
            if (!$result) {
                throw new Exception("Ошибка выполнения запроса в order_dish: " . $stmt->error);
            }
        }

        $stmt->close();

        // Подтверждение транзакции
        $mysqli->commit();
        echo "Заказ успешно добавлен.";
    } catch (Exception $e) {
        // Откат транзакции в случае ошибки
        $mysqli->rollback();
        echo "Ошибка при добавлении заказа: " . $e->getMessage();
    }
} else {
    echo "Ошибка: недостаточно данных для оформления заказа. \t";

    echo "номер стола:"; var_dump($tableNumber); echo "\t";
    echo "коммент:"; var_dump($comment); echo "\t";
    echo "id официанта:"; var_dump($idOfficiant); echo "\t";
    echo "блюда :"; var_dump($dishes); echo "\t";
}


// Закрытие соединения
$mysqli->close();
?>
