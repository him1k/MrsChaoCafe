<?php
session_start();

// Удаление всех переменных сессии
$_SESSION = [];

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Уничтожаем сессию
session_destroy();

// Возвращаем успешный ответ
http_response_code(200);

echo "<script>window.location.href='index.php';</script>";
exit();

