<?php

session_start();

//получение куки из сессии
if (isset($_COOKIE['officiant'])) {
    $id = (int) $_COOKIE['officiant'];
/*    echo "Здравствуйте, " . htmlspecialchars($id) ;*/

} else {
    echo "<script type=\"text/javascript\"> alert (\" Куки для официанта не найдены. Пожалуйста, войдите в систему. \")</script>";
/*    sleep(15);

    echo "<script>window.location.href='/login.php';</script>";
    exit();*/
}


//отладка
$id = 1;


?>

<!DOCTYPE html>
<!--[if IE 7 ]>    <html lang="ru" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="ru" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="ru" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="ru" xml:lang="ru" class="no-js"> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <!--[if lt IE 9]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--[if lt IE 9]>
    <script src="bower_components/html5shiv/dist/html5shiv.js"></script>
    <![endif]-->

    <!-- Icon-Font -->
    <link rel="stylesheet" href="font-awesome/font-awesome/css/font-awesome.min.css" type="text/css">
    <!--[if IE 7]>
    <link rel="stylesheet" href="font-awesome/font-awesome/css/font-awesome-ie7.min.css" type="text/css">
    <![endif]-->

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600italic,700%7CMontserrat:400,700%7CLato' rel='stylesheet' type='text/css'>

<!--    <link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css" type="text/css">-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="styles/main.css" type="text/css">
    <link rel="stylesheet" href="styles/custom1.css" type="text/css">

    <script type="text/javascript" src="js/modernizr.js"></script>

    <title>Bakery</title>
</head>
<body>

<noscript>
    <p style="color: white; font-size: 17px"> У вас отключён javascript. Его необходимо включить <br>
        После его включения перезагрузите страницу
    </p>
</noscript>

<!-- Модальное окно -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Содержимое модального окна -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Состав блюда</h4>
            </div>
            <div class="modal-body">
                <p id="dishStructure">Некоторые тексты в модальном окне.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<!-- Установка для скрытого input значение,чтобы передать его на другую форму order.php -->

<?php

$mysqli = require "connect/bd.php";

if ($mysqli->connect_error) {
    die("Соединение с базой данных не удалось: " . $mysqli->connect_error);
} ?>

<div class="container" style="height: 70vh;">
    <div class="row">
        <div class="col-md-4">
            <h3>Меню</h3>
            <input type="text" id="search" placeholder="Поиск блюда" class="form-control" onkeyup="filterDishes()">
            <div class="box">

                <!--новое-->
                <ul id="dishList" class="list-group mt-2">
                    <?php
                    $sql = "SELECT `id_dish`, `name_dish`, `price`, `structure` FROM `dish`;";
                    $result = $mysqli->query($sql);

                    if ($result->num_rows > 0) : ?>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <li class="list-group-item" data-price="<?php echo $row['price']; ?>">
                                <?php echo $row['name_dish']; ?> - <?php echo $row['price']; ?>₽ <br>
                                <input type="number" name="quantity" class="form-control" onchange="updateOrderList();" oninput="validateInput(this);" placeholder="Кол-во" style="width: 80px; display: inline;" min="1">
                                <span style="display: none;"><?php echo $row['id_dish']; ?></span>

                                <?php echo
                                    "<button type=\"button\" class=\"btn btn-info btn-lg\" 
                                    data-toggle=\"modal\" data-target=\"#myModal\" 
                                    data-structure=\"" . htmlspecialchars($row['structure']) . "\">Состав</button>"; ?>
                            </li>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <li class="list-group-item">Нет доступных блюд</li>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
        <div class="col-md-8">
            <div class="margin-20"> </div>
            <h3>Выбрано</h3>

            <textarea name="orderTextArea" id="orderTextArea" class="form-control" rows="10" readonly></textarea>

            <div class="mb-3">
                <label for="table_number" class="form-label">Номер стола</label>
                <input type="number" class="form-control" id="table_number" name="table_number" required>
            </div>

            <input type="hidden" id="id_of" value="<?php echo htmlspecialchars($id);?>">

            <div class="mb-3">
                <label for="comment" class="form-label">Комментарий</label>
                <textarea class="form-control" id="comment" name="comment"></textarea>
            </div>
            <button class="btn btn-success" id="submitOrder" onclick="sendOrder()">Отправить заказ</button>
        </div>
    </div>
</div>


<script type="text/javascript" src="js/jQuery%203.7.1.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/officiant_mail.js"></script>

<script type="text/javascript">

$(document).ready(function() {
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Кнопка, которая вызвала модальное окно
        var structure = button.data('structure'); // Извлекаем данные о составе
        console.log(structure); // Вывод значения в консоль
        var modal = $(this);
        modal.find('.modal-body #dishStructure').text(structure); // Обновляем текст в модальном окне
    });
});

</script>


<?php
$mysqli->close();
?>

</body>
</html>