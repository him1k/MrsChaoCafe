<?php

session_start();
//считывание куки
if(isset($_COOKIE["officiant"])){
    echo "<script>window.location.href='/tabs.php';</script>";
    exit();
}

if(isset($_COOKIE["cook"])){
    echo "<script>window.location.href='/cook.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Вход</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="font-awesome/font-awesome/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="font-awesome/font-awesome/css/font-awesome-ie7.min.css" type="text/css">
  <link rel="stylesheet" href="./styles/registration2.css">

</head>
<body>


<!--колонки тут-->
<div class="row align-items-center">
  <noscript>
    <p style="color: white; font-size: 17px"> У вас отключён javascript. Его необходимо включить <br>
      После его включения перезагрузите страницу
    </p>
  </noscript>
  <div class="col">

<div class="container">
  <div class="header" id="header">
    <h1> Вход </h1>
  </div>

  <form action="/auth1.php" method="post" class="form" id="form" required>
    <div class="form-control">
      <label for="login">Логин</label>
      <input type="text" placeholder="" id="login" name="login">
      <i class="fa-check"></i>
      <i class="fa-exclamation"></i>
      <small> Можно вводить только цифры </small>
    </div>

    <div class="form-control">
      <label for="pass"> Пароль </label>
      <input type="password" placeholder="" id="pass" name="pass" required>
      <i class="fa-check"></i>
      <i class="fa-exclamation"></i>
      <label for="pass_box"> Показать пароль <input type="checkbox"  id="pass_box"> </label>
      <small> Можно вводить только цифры </small>
    </div>

    <div class="d-flex flex-row align-items-center justify-content-between">
      <a href="/registration.html">Регистрация</a>
      <button type="submit" class="btn btn-primary" id="button1">Вход</button>
    </div>

  </form>
</div>



    <!--конец колонок-->
  </div>

</div> <!--div row col center-->

<script type="text/javascript" src="js/jQuery 3.7.1.js"></script>
<script src="js/check_login.js"></script>
<script type="text/javascript" src="js/jquery.inview.min.js"></script>
<script type="text/javascript" src="js/jquery.scrollTo.min.js"></script>
<script type="text/javascript" src="js/jquery.stellar.min.js"></script>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>

</body>
</html>
