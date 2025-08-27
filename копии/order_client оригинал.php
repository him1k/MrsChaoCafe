<?php
/*$mysqli = require "connect/bd.php";

// Обработка данных из POST запроса
$jsonData = json_decode(file_get_contents('php://input'), true);

// Логирование
$logFileName = 'log.txt';
$logMessage = date('Y-m-d H:i:s') . ": Received data: " . json_encode($jsonData, JSON_PRETTY_PRINT) . PHP_EOL;
file_put_contents($logFileName, $logMessage, FILE_APPEND);

// Проверка на null и существование ключей
if ($jsonData === null || !isset($jsonData['orders'], $jsonData['totalSum'], $jsonData['client_id'])) {
    http_response_code(400);
    $errorMessage = $jsonData === null ? 'Неверный формат JSON' : 'Отсутствуют необходимые ключи в JSON';
    echo json_encode(['status' => 'error', 'message' => $errorMessage]);
    exit;
}

$orderData = $jsonData['orders'];
$totalSum = (int) $jsonData['totalSum'];
$idClient = (int) $jsonData['client_id'];

// Валидация
if (!is_array($orderData) || empty($orderData) || $totalSum <= 0 || $idClient <= 0) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Некорректные данные заказа']);
    exit;
}

//$idCook = 1;

//$status = 1;

$mysqli->begin_transaction();
try {
    // Вставка в orders
    $stmtOrders = $mysqli->prepare("INSERT INTO `orders` (`table_number`, `datetime`, `id_client`, `id_of`, `sum`) VALUES (NULL, NOW(), ?, NULL, ?)");
    $stmtOrders->bind_param("ii", $idClient, $totalSum);
    $stmtOrders->execute();
    $order_id = $mysqli->insert_id; //последний вставленный заказ
    $stmtOrders->close();

    // Вставка в order_dish - используем LAST_INSERT_ID()
//    $stmtOrderDish = $mysqli->prepare("INSERT INTO `order_dish` (`id_order`, `id_dish`, `quantity`, `status`, `id_cook`, `comment`) SELECT LAST_INSERT_ID(), ?, ?, ?, ?, NULL");


    $stmt = $mysqli->prepare("INSERT INTO `order_dish` (`id_order`, `id_dish`, `quantity`, `status`, `id_cook`, `comment`) VALUES (?, ?, ?, ?, ?, NULL)");

    if (!$stmt) {
        die("Ошибка подготовки запроса: " . $mysqli->error);
    }

    foreach ($orderData as $dish) {
        if (!isset($dish['id_dish'], $dish['quantity']) || !is_numeric($dish['id_dish']) || !is_numeric($dish['quantity']) || $dish['quantity'] <= 0) {
            throw new Exception("Ошибка: некорректные данные блюда");
        }
        $idDish = (int)$dish['id_dish'];
        $quantity = (int)$dish['quantity'];
        $stmt->bind_param("iiiii", $order_id, $idDish, $quantity, $status, $idCook);
        $result = $stmt->execute();

        if (!$result) {
            throw new Exception("Ошибка выполнения запроса: " . $stmt->error);
        }

        $stmt->execute();
    }
    $stmt->close();
    $mysqli->commit();


    echo json_encode(['status' => 'success', 'orderId' => $order_id]);
} catch (Exception $e) {
    $mysqli->rollback();
    error_log("Ошибка добавления заказа: " . $e->getMessage() . "  " . date("Y-m-d H:i:s"));
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Ошибка при добавлении заказа']);
}
$mysqli->close();
*/


$mysqli = require "connect/bd.php";

// Обработка данных из POST запроса
$jsonData = json_decode(file_get_contents('php://input'), true);

// Логирование
$logFileName = 'log.txt';
$logMessage = date('Y-m-d H:i:s') . ": Received data: " . json_encode($jsonData, JSON_PRETTY_PRINT) . PHP_EOL;
file_put_contents($logFileName, $logMessage, FILE_APPEND);

// Проверка на null и существование ключей
if ($jsonData === null || !isset($jsonData['orders'], $jsonData['totalSum'], $jsonData['client_id'])) {
    http_response_code(400);
    $errorMessage = $jsonData === null ? 'Неверный формат JSON' : 'Отсутствуют необходимые ключи в JSON';
    echo json_encode(['status' => 'error', 'message' => $errorMessage]);
    exit;
}

$orderData = $jsonData['orders'];
$totalSum = (int)$jsonData['totalSum'];
$idClient = (int)$jsonData['client_id'];

// Валидация
if (!is_array($orderData) || empty($orderData) || $totalSum <= 0 || $idClient <= 0) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Некорректные данные заказа']);
    exit;
}

$idCook = 1;

$mysqli->begin_transaction();
try {
    // Вставка в orders
    $stmtOrders = $mysqli->prepare("INSERT INTO orders (table_number, datetime, id_client, id_of, sum) VALUES (NULL, NOW(), ?, NULL, ?)");
    $stmtOrders->bind_param("ii", $idClient, $totalSum);
    if (!$stmtOrders->execute()) {
        throw new Exception("Ошибка выполнения запроса для вставки в orders: " . $stmtOrders->error);
    }

    $order_id = $mysqli->insert_id; // последний вставленный заказ
    $stmtOrders->close();

    $stmtOrderDish = $mysqli->prepare("INSERT INTO order_dish (id_order, id_dish, quantity, status, id_cook, comment) VALUES (?, ?, ?, ?, ?, NULL)");
    if (!$stmtOrderDish) {
        throw new Exception("Ошибка подготовки запроса для вставки блюд: " . $mysqli->error);
    }

    foreach ($orderData as $dish) {
        $idDish = (int) $dish['id_dish']; // ID блюда
        $quantity = (int) $dish['quantity']; // Количество блюда
        $status = 1; // Статус = 1 (не готово)

        $stmtOrderDish->bind_param("iiiii", $order_id, $idDish, $quantity, $status, $idCook);
        if (!$stmtOrderDish->execute()) {
            throw new Exception("Ошибка выполнения запроса в order_dish: " . $stmtOrderDish->error);
        }
    }

    $stmtOrderDish->close();

    // Подтверждение транзакции
    $mysqli->commit();

    echo json_encode(['status' => 'success', 'orderId' => $order_id]);
catch (Exception $e) {
        $mysqli->rollback();
        error_log("Ошибка добавления заказа: " . $e->getMessage() . " в файле " . $e->getFile() . " на строке " . $e->getLine() . " " . date("Y-m-d H:i:s"));
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Ошибка при добавлении заказа.']);
    }
} finally {
    $mysqli->close();
}


?>