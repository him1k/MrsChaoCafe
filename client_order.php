
<?php
session_start();
header('Content-Type: application/json');

$mysqli = require "connect/bd.php";

// Проверяем, передан ли id_client
if (isset($_POST['id_client'])) {
    $id_client = intval($_POST['id_client']);

    // Запрос к базе данных
$sql = "SELECT
    o.id_order,
    o.datetime,
    o.table_number,
    o.sum,
    od.status AS order_status,
    od.comment,
    GROUP_CONCAT(CONCAT(d.name_dish, ', ', od.quantity, ' шт') SEPARATOR '; ') AS dishes
FROM
    orders o
JOIN
    order_dish od ON o.id_order = od.id_order
JOIN
    dish d ON od.id_dish = d.id_dish
WHERE
    o.id_client = ?
GROUP BY
    o.id_order, o.datetime, o.table_number, o.sum, od.status, od.comment
ORDER BY
    o.datetime DESC;";
    // Подготовка и выполнение запроса
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id_client); // Привязываем параметр
        $stmt->execute();
        $result = $stmt->get_result(); // Получаем результат

        $orders = []; // Массив для хранения всех заказов

        // Извлекаем все заказы
        while ($order = $result->fetch_assoc()) {
            // Преобразуем статус в слова
            $statusText = '';
            switch ($order['order_status']) {
                case 1:
                    $statusText = 'Не готово';
                    break;
                case 2:
                    $statusText = 'Готово';
                    break;
                default:
                    $statusText = 'Неизвестный статус';
                    break;
            }

            // Добавляем заказ в массив
            $orders[] = [
                'order_number' => $order['id_order'],
                'datetime' => $order['datetime'],
                'table_number' => $order['table_number'],
                'sum' => $order['sum'],
                'dishes' => $order['dishes'],
                'status' => $statusText,
                'comment' => $order['comment']
            ];
        }

        // Проверяем, есть ли заказы
        if (!empty($orders)) {
            echo json_encode([
                'success' => true,
                'orders' => $orders // Возвращаем массив заказов
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Заказы не найдены.']);
        }

        $stmt->close(); // Закрываем подготовленный запрос
    } else {
        echo json_encode(['success' => false, 'message' => 'Ошибка выполнения запроса.']);
    }
} /*else { //отладка
    echo json_encode(['success' => false, 'message' => 'ID клиента не передан.']);
}*/
?>