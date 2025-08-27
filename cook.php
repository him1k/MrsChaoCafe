
<?php

session_start();

//считывание куки
if (isset($_COOKIE['cook'])) {
    $id_cook = (int) $_COOKIE['cook'];
/*    echo "Здравствуйте, " . htmlspecialchars($id_cook) . "! Вы вошли как повар.";*/

} else {

    echo "<script type=\"text/javascript\"> alert (\" Куки для официанта не найдены. Пожалуйста, войдите в систему. \")</script>";
    /*        sleep(15);

    //пересылка на вход
            echo "<script>window.location.href='/login.php';</script>";
            exit();*/
}
//откладка
$id_cook = 1 ;
?>

<!DOCTYPE html>
<html lang="ru" xml:lang="ru" class="no-js">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css" type="text/css">
    <script type="text/javascript" src="js/jQuery%203.7.1.js"></script>
    <title>Bakery</title>
</head>

<body>

<noscript>
    <p style="color: white; font-size: 17px"> У вас отключён javascript. Его необходимо включить <br>
        После его включения перезагрузите страницу
    </p>
</noscript>

<?php
$mysqli = require "connect/bd.php";

if ($mysqli->connect_error) {
    die("Соединение с базой данных не удалось: " . $mysqli->connect_error);
}
?>

<div class="container " style="height: 100vh;">
    <div class="row">
        <div class="col-md-8">
            <button class="tab-button btn-primary align-items-center" id="exit"> Выйти </button> <h3>Меню</h3>

            <input type="text" id="search" placeholder="Поиск блюда" class="form-control" onkeyup="filterDishes()">
            <div class="box">

            <ul id="dishList" class="list-group"></ul>

            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
    <h3>Готово</h3>
    <ul id="dishList_new" class="list-group"></ul>
        </div>
    </div>

</div>



<input type="hidden" id="id_cook" value="<?php echo htmlspecialchars($id_cook);?>">

<script>
    //загрузка контента
    function loadOrders() {
        $.ajax({
            url: 'get_order.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#dishList').empty();
                if (data.length > 0) {
                    $.each(data, function(index, order) {
                        let listItem = $('<li class="list-group-item">')
                            .attr('id', 'order-' + order.id_record)
                            .text(order.name_dish + ', ' + order.quantity + ' шт')
                            .append($('<button class="btn btn-dark" style="width: 80px;">')
                                .text('Готово')
                                .click(function() {
                                    updateOrder(order.id_record, order.name_dish);
                                }));
                        $('#dishList').append(listItem);
                    });
                } else {
                    $('#dishList').append('<li class="list-group-item">Нет заказов</li>');
                }
            },
            error: function(xhr, status, error) {
                console.error("Ошибка загрузки заказов:", error);
                alert('Ошибка загрузки заказов!');
            }
        });
    }
    //отправка и получение ответа
    function updateOrder(id_record, dishName) {
        const id_cook = document.getElementById("id_cook").value;
        const quantity = $('#order-' + id_record).text().match(/(\d+)\s*шт/)[1];

        console.log("Отправляем данные:", { id_record: id_record, id_cook: id_cook, quantity: quantity, dishName: dishName });

        $.ajax({
            url: 'update_order.php',
            method: 'POST',
            data: { id_record: id_record, id_cook: id_cook, quantity: quantity, dishName: dishName },
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    $('#order-' + id_record).remove();
                    $('#dishList_new').append('<li class="list-group-item">' + dishName + ' (' + quantity + ' шт.)</li>');
                } else {
                    alert('Ошибка обновления статуса: ' + data.error);
                }
            },
            error: function(xhr, status, error) {
                console.error("Ошибка обновления заказа:", error);
                console.error("Ответ сервера:", xhr.responseText);
                alert('Ошибка обновления статуса!');
            }
        });
    }

    loadOrders(); //загрузка контента
    setInterval(loadOrders, 15000); // Загрузка каждые 15 секунд

    //выход

    document.getElementById("exit").addEventListener("click", function() {
        // Отправка запроса на выход
        fetch('/exit.php', {
            method: 'POST', // Используем POST для безопасности
            credentials: 'same-origin' // Отправляем куки с запросом
        })
            .then(response => {
                if (response.ok) {
                    // Если выход успешен, перенаправляем на страницу входа или главную
                    window.location.href = '/login.php';
                } else {
                    alert('Ошибка при выходе. Пожалуйста, попробуйте еще раз.');
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
                alert('Ошибка при выходе. Пожалуйста, попробуйте еще раз.');
            });
    });
</script>


<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
