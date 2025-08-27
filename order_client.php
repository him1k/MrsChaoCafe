<?php
$mysqli = require "connect/bd.php"; // Подключение к базе данных

$jsonData = json_decode(file_get_contents('php://input'), true);
$orderData = $jsonData['orders'];
$totalSum = (int)$jsonData['totalSum'];
$idClient = (int)$jsonData['client_id'];


if (!empty($orderData)) {
    // Начало транзакции
    $mysqli->begin_transaction();

    try {
        // Вставка нового заказа
        $stmt = $mysqli->prepare("INSERT INTO `orders` (`table_number`, `datetime`, `id_client`, `id_of`, `sum`) VALUES (NULL, NOW(), ?, NULL, ?)");

        //отладка подготовки запроса
        if (!$stmt) {
            die("Ошибка подготовки запроса: " . $mysqli->error);
        }

        // Вставка
        $stmt->bind_param("ii", $idClient, $totalSum);
        $result = $stmt->execute();

        //ошибка выполнения запроса
        if (!$result) {
            throw new Exception("Ошибка выполнения запроса: " . $stmt->error);
        }

        $order_id = $mysqli->insert_id; // Получаем ID последнего вставленного заказа
        $stmt->close();

        // Вставка блюд в order_dish
        $stmt = $mysqli->prepare("INSERT INTO `order_dish` (`id_order`, `id_dish`, `quantity`, `status`, `id_cook`, `comment`) VALUES (?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            throw new Exception("Ошибка подготовки запроса для вставки блюд: " . $mysqli->error);
        }

        foreach ($orderData as $dish) {
            $idDish = (int)$dish['id_dish'];
            $quantity = (int)$dish['quantity'];
            $status = 1;
            $idCook = 1;
            $comment = $mysqli->real_escape_string($dish['comment']);

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
    echo "Ошибка: недостаточно данных для оформления заказа.";
}
?>
