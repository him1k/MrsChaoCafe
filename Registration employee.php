<?php

/*$login = "";
$pass = "";*/

//хэш + соль
/*$new_pass = mb5($pass."xkghe5241");*/

/*function officiant ($login,$new_pass) {
    $mysql = require "connect/bd.php";

    if ($mysql->connect_error) {
        die("Соединение провалено: " . $mysql->connect_error);
    }

    $stmt = $mysql->prepare("insert into `officiant` (`pass`,`login`) values (?,?)");
    $stmt->bind_param("ss", $new_pass, $login);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Данные успешно обновлены в базе данных.";
        } else {
            echo "Пользователь с таким service number не найден в базе данных.";
        }
    } else {
        echo "Ошибка при обновлении данных в базе данных.";
    }
    $stmt->close();
    $mysql->close();
}
officiant("log", "worlddog");

function cook ($login,$new_pass) {
    $mysql = require "connect/bd.php";

    if ($mysql->connect_error) {
        die("Соединение провалено: " . $mysql->connect_error);
    }

    $stmt = $mysql->prepare("insert into `cook` (`pass`,`login`) values (?,?)");
    $stmt->bind_param("ss", $new_pass, $login);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Данные успешно обновлены в базе данных.";
        } else {
            echo "Пользователь с таким service number не найден в базе данных.";
        }
    } else {
        echo "Ошибка при обновлении данных в базе данных.";
    }
    $stmt->close();
    $mysql->close();
}

officiant("log", "asdasd");*/


function officiant($fio, $work_exp,$service_number, $pass, $login) {

    $work_exp = (int) $work_exp;
    $service_number = (int) $service_number;

    // Хэш + соль
    $new_pass = md5($pass . "xkghe5241");

    $mysql = require "connect/bd.php";

    if ($mysql->connect_error) {
        die("Соединение провалено: " . $mysql->connect_error);
    }

    $stmt = $mysql->prepare("INSERT INTO `officiant` (`FIO`,`work_experience`,`service_number`,`pass`, `login`) VALUES (?, ?,?,?,?)");
    $stmt->bind_param("siiss",$fio,$work_exp,$service_number, $new_pass, $login);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Данные успешно обновлены в базе данных.";
        } else {
            echo "Пользователь с таким номером не найден в базе данных.";
        }
    } else {
        echo "Ошибка при обновлении данных в базе данных.";
    }
    $stmt->close();
    $mysql->close();
}

/*function cook($fio, $work_exp, $pass, $login) {

    $work_exp = (int) $work_exp;


    // Хэш + соль
    $new_pass = md5($pass . "xkghe5241");

    $mysql = require "connect/bd.php";

    if ($mysql->connect_error) {
        die("Соединение провалено: " . $mysql->connect_error);
    }

    $stmt = $mysql->prepare("INSERT INTO `cook` (`FIO`,`work_experience`,`pass`, `login`) VALUES (?, ?,?,?)");
    $stmt->bind_param("siss",$fio,$work_exp, $new_pass, $login);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Данные успешно обновлены в базе данных.";
        } else {
            echo "Пользователь с таким номером не найден в базе данных.";
        }
    } else {
        echo "Ошибка при обновлении данных в базе данных.";
    }
    $stmt->close();
    $mysql->close();
}*/

function cook($fio, $work_exp, $pass, $login) {

    $work_exp = (int) $work_exp;

    // Хэш + соль
    $new_pass = md5($pass . "xkghe5241");

    $mysql = require "connect/bd.php";

    if ($mysql->connect_error) {
        die("Соединение провалено: " . $mysql->connect_error);
    }

    $stmt = $mysql->prepare("INSERT INTO `cook` (`FIO`,`work_experience`,`pass`, `login`) VALUES (?, ?,?,?)");
    $stmt->bind_param("siss",$fio,$work_exp, $new_pass, $login);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Данные успешно обновлены в базе данных. \n";
        } else {
            echo "Пользователь с таким номером не найден в базе данных.";
        }
    } else {
        echo "Ошибка при обновлении данных в базе данных.";
    }
    $stmt->close();
    $mysql->close();
}

/*officiant ("Peter Parker","1", "1","Knigahoroshiydrug1!","logg");*/

//нулевой повар
cook ("null cook","0", "Abrakadabra0!","lg");

//mary jane
cook ("Mary Jane Watson","1", "Knigahoroshiydrug0!","logy");