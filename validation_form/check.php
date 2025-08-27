<?php

// Начинаем сессию
session_start();

// Получаем данные из POST-запроса
$newLogin = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
$number = filter_var(trim($_POST['number']), FILTER_SANITIZE_STRING);

// Хешируем пароль
$new_pass = md5($password . "xkghe5241");

// Подключаемся к базе данных
$mysql = require "../connect/bd.php";

// Проверяем, есть ли уже клиент с таким логином
$resultCheck = $mysql->prepare("SELECT `id_client` FROM `client` WHERE `login` = ?");
$resultCheck->bind_param("s", $newLogin);
$resultCheck->execute();
$resultCheck->store_result();

if ($resultCheck->num_rows > 0) {
    echo "Пользователь с таким логином уже существует.";
    exit();
}

$resultCheck->close();

// Вставляем данные клиента в базу данных
$resultInsert = $mysql->prepare("INSERT INTO `client` (`number_phone`, `pass`, `login`) VALUES (?, ?, ?)");
$resultInsert->bind_param("sss", $number, $new_pass, $newLogin);
$resultInsert->execute();

// Получаем id нового клиента для сессии
$clientId = $mysql->insert_id; // Получаем id последней вставленной записи

// Устанавливаем переменные сессии
$_SESSION['login'] = $newLogin;
$_SESSION['id_client'] = $clientId;

// Закрываем подготовленный запрос и соединение с БД
$resultInsert->close();
$mysql->close();

// Перенаправляем клиента на нужную страницу
echo "<script>window.location.href='index.php';</script>";
exit();
?>