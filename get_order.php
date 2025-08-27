<?php
$mysqli = require "connect/bd.php";

$sql = "
    SELECT od.id_record, d.name_dish, od.quantity
    FROM order_dish od
    JOIN dish d ON od.id_dish = d.id_dish
    WHERE od.status = 1;
";

$result = $mysqli->query($sql);
$orders = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($orders);
?>


