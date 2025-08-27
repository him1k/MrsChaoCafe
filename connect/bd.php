<?php

$mysql = mysqli_connect('localhost','root','','cafe');

if (!$mysql) {
    die("Ошибка подключения: " . mysqli_connect_error());
}
return $mysql;