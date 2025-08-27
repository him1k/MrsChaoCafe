<?php

$newLogin = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);

$new_pass = md5($password."xkghe5241");

$mysqli = require "../connect/bd.php";

if ($mysqli->connect_error) {
    die("Соединение с базой данных не удалось: " . $mysqli->connect_error);
}


//РАЗБЛОКИРОВАТЬ
// Массива с ролями для проверки
$roles = ['client', 'officiant', 'cook'];
$authenticated = false;

// Проходим по каждой роли и проверяем
foreach ($roles as $role) {
    $stmt = $mysqli->prepare("SELECT `login`, `pass` FROM $role WHERE `login` = ?");
    $stmt->bind_param("s", $newLogin);
    $stmt->execute();
    $stmt->store_result();

    // Проверяем, найден ли пользователь с таким логином
    if ($stmt->num_rows == 1) {
        // Логин найден, извлекаем информацию о пользователе
        $stmt->bind_result($dblogin, $dbpass);
        $stmt->fetch();

        // Проверяем хэшированный пароль
        if ($new_pass === $dbpass && $dblogin === $newLogin) {

            // Авторизация успешна, сессия
            session_start();

            //отключил сессию, новое
/*            $_SESSION['login'] = $dblogin;*/

            //проверка сессии
/*            if (session_status() === PHP_SESSION_NONE) {
                $_SESSION['role'] = $role; // Установка роли пользователя в сессии
            }*/

            $_SESSION['role'] = $role; // Установка роли пользователя в сессии

/*            echo "Авторизация успешна как " . htmlspecialchars($role);*/

            // Поиск id официанта
            if ($role === "officiant") {

                $idStmt = $mysqli->prepare("SELECT `id_of` FROM `officiant` WHERE `login` = ?");

                $idStmt->bind_param("s", $newLogin);

                //проверка запоросов
/*                if (!$idStmt) {
                    die("Ошибка подготовки запроса: " . $mysqli->error);
                }
                $result = $idStmt->execute();

                //проверка вставки
                if (!$result) {
                    die("Ошибка выполнения запроса: " . $stmt->error);
                }*/

                $idStmt->execute();
                $idStmt->bind_result($idValue);
                $idStmt->fetch();

                // Запись в куки официанта его id, 10 часов
                setcookie("officiant", $idValue, time() + 36000, "/");

                $idStmt->close();

/*                $authenticated = true;*/
                echo "<script>window.location.href='officiant.php';</script>";
                exit();
            }

            if ($role === "cook") {

                $idStmt = $mysqli->prepare("SELECT `id_cook` FROM `cook` WHERE `login` = ?");

                $idStmt->bind_param("s", $newLogin);

                $idStmt->execute();
                $idStmt->bind_result($idValue);
                $idStmt->fetch();

                // Запись в куки официанта его id, 10 часов
                setcookie("cook", $idValue, time() + 36000, "/");

                $idStmt->close();

                /*                $authenticated = true;*/
                echo "<script>window.location.href='cook.php';</script>";
                exit();
            }

            //для клиента установил сессию
            if ($role === "client") {

                $idStmt = $mysqli->prepare("SELECT `id_client` FROM `client` WHERE `login` = ?");

                $idStmt->bind_param("s", $newLogin);

                $idStmt->execute();
                $idStmt->bind_result($idValue);
                $idStmt->fetch();

                // Запись в куки официанта его id, 10 часов
                /*setcookie("client", $idValue, time() + 36000, "/");*/

                $_SESSION['id_client'] = $idValue;

                $idStmt->close();

                echo "<script>window.location.href='index.php';</script>";
                exit();
            }


        } else {
            echo "Неправильный пароль для роли $role.";
        }
    }
    $stmt->close(); // Закрываем подготовленный запрос для каждой роли
}


/*if (!$authenticated) {
    // Если авторизация не удалась для всех ролей
    echo "Пользователь с таким логином не найден в системах.";
}*/

$mysqli->close();

