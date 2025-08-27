<?php
session_start();

/* if (isset($_SESSION['id_client'])) {
    $userId = $_SESSION['id_client'];
} else {
    echo "<script type=\"text/javascript\"> alert (\"Вы не зарегистрированы.\")</script>";
    // Можно добавить редирект на страницу входа
} */

// Отладка
$userId = 1;
?>

<!DOCTYPE html>
<html lang="ru" xml:lang="ru" class="no-js">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css" type="text/css">
    <title>Cafe</title>
</head>

<body>

<input type="hidden" id="userId" value="<?php echo $userId; ?>">

<div class="container justify-content-center" id="orderContainer">
    <p style="text-align: center;"><strong>Данные ваших заказов:</strong></p>
    <p id="noOrdersMessage" style="text-align: center; display: none;">Нет заказов.</p>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function order() {
        const userId = document.getElementById("userId").value;
        const orderContainer = $('#orderContainer');
        const noOrdersMessage = $('#noOrdersMessage');

        $.ajax({
            url: 'client_order.php',
            type: 'POST',
            data: { id_client: userId },
            dataType: 'json',
            success: function(response) {
                // Очищаем контейнер перед обновлением
                orderContainer.empty().append('<p style="text-align: center;"><strong>Данные ваших заказов:</strong></p>');

                if (response.success) {
                    noOrdersMessage.hide(); // Скрываем сообщение "Нет заказов"

                    response.orders.forEach(order => {
                        const orderDiv = $('<div class="order-item" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;"></div>');
                        orderDiv.append('<p><strong>Номер заказа:</strong> ' + order.order_number + '</p>');
                        orderDiv.append('<p><strong>Время заказа:</strong> ' + order.datetime + '</p>');
                        orderDiv.append('<p><strong>Состав:</strong> ' + order.dishes + '</p>');
                        orderDiv.append('<p><strong>Статус:</strong> ' + order.status + '</p>');
                        orderDiv.append('<p><strong>Комментарий:</strong> ' + order.comment + '</p>');
                        orderContainer.append(orderDiv);
                    });
                } else {
                    noOrdersMessage.show(); // Показываем сообщение "Нет заказов"
                }
            },
            error: function(xhr, status, error) {
                alert(`Произошла ошибка: ${xhr.status} - ${xhr.responseText}`);
            }
        });
    }
    // обновление страницы
    setInterval(order, 15000);
</script>

<script type="text/javascript" src="js/jQuery%203.7.1.js"></script>
<script type="text/javascript" src="bootstrap/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

</body>
</html>