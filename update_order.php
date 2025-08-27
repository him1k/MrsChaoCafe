<?php
$mysqli = require "connect/bd.php";

$id_record = (int) $_POST['id_record'];
$id_cook = (int) $_POST['id_cook'];
$quantity = (int) $_POST['quantity'];
$dishName = $_POST['dishName'];

$sql = "
    UPDATE order_dish
    SET status = 2, id_cook = ?
    WHERE id_record = ?;
";

$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    $response['success'] = false;
    $response['error'] = "Ошибка подготовки запроса: " . $mysqli->error;
    echo json_encode($response);
    exit;
}

$stmt->bind_param("ii", $id_cook, $id_record);
$success = $stmt->execute();

$response = [];
if ($success) {
    $response['success'] = true;
    $response['quantity'] = $_POST['quantity'];
    $response['dishName'] = $dishName;
} else {
    $response['success'] = false;
    $response['error'] = $mysqli->error;
}



header('Content-Type: application/json');
echo json_encode($response);

/*//логи
$logFilePath = 'D:/xampp/htdocs/bakeryhtml/Bakery Main/update_order_log.json';

// Запись ответа в формате JSON в файл
file_put_contents($logFilePath, json_encode($response) . PHP_EOL, FILE_APPEND);*/


//отладка
/*header('Content-Type: application/json');
echo json_encode($response);
if (json_last_error() !== JSON_ERROR_NONE) {
    error_log('JSON ошибка: ' . json_last_error_msg());
}*/

?>






