
<?php
session_start();

//получение куки из сессии
if (isset($_COOKIE['officiant'])) {
    $id = $_COOKIE['officiant'];
} else {
    echo "<script type=\"text\/javascript\"> alert (\" Куки для официанта не найдены. Пожалуйста, войдите в систему. \")</script>";
/*    sleep(15);

    echo "<script>window.location.href='/login.php';</script>";
    exit();*/
}

//отладка
    $id_of = 1;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="styles/main.css" type="text/css">
    <link rel="stylesheet" href="styles/custom1.css" type="text/css">
    <title>Bakery</title>
    <script type="text/javascript" src="js/jQuery%203.7.1.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h3> Готовые заказы </h3>
            <input type="text" id="search1" placeholder="Поиск блюда" class="form-control" onkeyup="filterDishes()">
            <div class="box">
                <ul id="order-list" class="list-group"></ul>

                <script type="text/javascript">
                    function fetchOrders() {
                        $.ajax({
                            url: '/mail_order.php', // Use a relative URL or a configurable URL
                            method: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $('#order-list').empty();
                                if (data.length > 0) {
                                    data.forEach(function(order) {
                                        $('#order-list').append(
                                            '<li id="order-' + order.id_order + '" class="list-group-item">' +
                                            order.name_dish + ', ' + order.quantity + ' шт' + '<br>' +  ' номер стола: ' + order.table_number + '<br>' +
                                            '</li>'
                                        );
                                    });
                                } else {
                                    $('#order-list').append('<li class="list-group-item">Нет готовых заказов</li>');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Ошибка при загрузке данных:', error);
                                // Отобразить пользователю сообщение об ошибке
                                $('#order-list').append('<li class="list-group-item text-danger">Ошибка при загрузке данных</li>');
                            }
                        });
                    }

                    // Первоначальная загрузка данных
                    fetchOrders();
                    // Обновление данных каждые 15 секунд
                    setInterval(fetchOrders, 15000);

                    function filterDishes() {
                        let input = document.getElementById('search1').value.toLowerCase();
                        let ul = document.getElementById('order-list');
                        let li = ul.getElementsByTagName('li');

                        for (let i = 0; i < li.length; i++) {
                            let dishName = li[i].innerText.toLowerCase();
                            if (dishName.includes(input)) {
                                li[i].style.display = '';
                            } else {
                                li[i].style.display = 'none';
                            }
                        }
                    }

                </script>

            </div>
        </div>
    </div>


</body>
</html>
