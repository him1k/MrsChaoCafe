<?php

    // Подключение к базе данных
    $mysqli = require "connect/bd.php";

    if ($mysqli->connect_error) {
       die("Соединение с базой данных не удалось: " . $mysqli->connect_error);
    }

// показывает все блюда за сегодня. Можно добавить условие, что будет подгружать за последние N минут
        $sql = "
        SELECT
        o.id_order,
        d.name_dish,
        od.quantity,
        o.table_number,
        o.sum
    FROM
        `orders` o
    JOIN
        order_dish od ON o.id_order = od.id_order
    JOIN
        dish d ON od.id_dish = d.id_dish
    WHERE
        od.status = 2 AND
        o.id_client IS NULL AND
        DATE(o.datetime) = CURDATE();
        ";


$stmt = $mysqli->prepare($sql);
    if (!$stmt) {
       die("Ошибка подготовки запроса: " . $mysqli->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $orders = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = [
                'id_order' => (int) $row['id_order'],
                'name_dish' =>  htmlspecialchars($row['name_dish']),
                'quantity' =>  (int) ($row['quantity']),
                'table_number' => (int) $row['table_number'],
                'sum' => (int) $row['sum']
            ];
        }
    }

    echo json_encode($orders);
    $mysqli->close();
?>