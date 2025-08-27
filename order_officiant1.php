<?php

$mysqli = require "connect/bd.php";

if ($mysqli->connect_error) {
    die("Соединение с базой данных не удалось: " . $mysqli->connect_error);
}

// номер стола
$tableNumber = $_POST['tableNumber'] ?? NULL;
$tableNumber = (int) $tableNumber;

// комментарий (проверьте, чтобы он был корректно передан)
$comment = $_POST['comment'] ?? NULL;

// айди официанта
$id_officiant = 1;

// Получение строки с id и количеством блюд, очищение от лишнего
$orderTextArea_id = str_replace(array("\r", "\n"), "\n", $_POST['orderTextArea_id']);
$orderTextArea_id = explode("\n", $orderTextArea_id); // Разбиваем текст по новому абзацу

$dishes = [];


$sum = 0; // Инициализируем переменную для суммы заказа

// Получаем цены из базы данных
$prices = [];
$result = $mysqli->query("SELECT `id_dish`, `price` FROM `dish`");
while ($row = $result->fetch_assoc()) {
    $prices[$row['id_dish']] = $row['price'];
}

foreach ($orderTextArea_id as $line) {
    $line = trim($line);
    if (!empty($line)) {
        list($id_dish, $quantity) = array_map('trim', explode(",", $line)); // Ожидаем, что формат: id, quantity
        $id_dish = intval($id_dish);
        $quantity = intval($quantity);

        if ($id_dish > 0 && $quantity > 0) {
            $dishes[$id_dish] = $quantity; // Сохраняем в массив
            // Добавляем к сумме
            if (isset($prices[$id_dish])) {
                $sum += $prices[$id_dish] * $quantity; // Увеличиваем сумму заказа
            } else {
                echo "Цена для блюда с id $id_dish не найдена.\n";
            }
        } else {
            echo "Некорректные значения для строки: $line\n";
        }
    }
}

// После обработки всех строк можно вывести общую сумму заказа
/*echo "Общая сумма заказа: $sum\n";*/

$mysqli->begin_transaction();

try {
    // Вставка нового заказа
/*    $stmt = $mysqli->prepare("INSERT INTO `orders` (`table_number`,`datetime`, `id_client`, `id_of`, `sum`) VALUES (?,NOW(), null, ?, ?)");
    $stmt->bind_param("iii", $tableNumber, $id_officiant, $sum);

    // Отладка запроса
    if (!$stmt) {
        die("Ошибка подготовки запроса: " . $mysqli->error);
    }

    $stmt->execute();*/

    $stmt = $mysqli->prepare("INSERT INTO `orders` (`table_number`, `datetime`, `id_client`, `id_of`,`sum`) VALUES (?, NOW(), NULL, ?,?)");

    //проверка запроса
    if (!$stmt) {
        die("Ошибка подготовки запроса: " . $mysqli->error);
    }
//вставка
    $stmt->bind_param("iii", $tableNumber, $id_officiant, $sum);
    $result = $stmt->execute();
    //проверка вставки
    if (!$result) {
        die("Ошибка выполнения запроса: " . $stmt->error);
    }

    $order_id = $mysqli->insert_id; // Получаем ID последнего вставленного заказа
    $stmt->close();

    //статус = не готово
    $status = 1;

    //значение по умолчанию
    $id_cook = 1;

    // Вставка блюд в order_dish
    $stmt = $mysqli->prepare("INSERT INTO `order_dish` (`id_order`, `id_dish`, `quantity`, `status`,`id_cook`, `comment`) VALUES (?, ?, ?, ?, ? ,?)");

    if (!$stmt) {
        die("Ошибка подготовки запроса для вставки блюд: " . $mysqli->error);
    }

    foreach ($dishes as $id_dish => $quantity) {
        $stmt->bind_param("iiiiis", $order_id, $id_dish, $quantity, $status,$id_cook, $comment);
        $result = $stmt->execute();
        if (!$result) {
            die("Ошибка выполнения запроса в order_dish: " . $stmt->error);
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

$mysqli->close();