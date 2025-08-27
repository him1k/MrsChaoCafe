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

    <!--    <link rel="icon" href="icon.png" type="image/png">-->

    <!--[if lt IE 9]>
    <script src="bower_components/html5shiv/dist/html5shiv.js"></script>
    <![endif]-->

    <!-- Icon-Font -->
    <link rel="stylesheet" href="font-awesome/font-awesome/css/font-awesome.min.css" type="text/css">
    <!--[if IE 7]>
    <link rel="stylesheet" href="font-awesome/font-awesome/css/font-awesome-ie7.min.css" type="text/css">
    <![endif]-->

    <!-- Google Fonts -->
    <link rel="stylesheet" href="bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="styles/main.css" type="text/css">
    <title>Bakery</title>

    <style>
        .tab-content {
            display: none;
            min-height: 100%;
        }
        .tab-content.active {
            display: block;
            overflow-y: auto; /* Добавление прокрутки по вертикали при необходимости */
            border: 1px solid #ccc; /* Рамка вокруг контейнера */
            padding: 10px; /* Отступы внутри контейнера */
            margin-top: 10px; /* Отступ сверху */
/*            flex-grow: 1;*/
/*            min-height: 100%;*/
            height: 100%;
        }

        .tab-button {
            margin: 5px; /* Добавить отступы между кнопками */
        }

        @media (max-width: 576px) {
            .tab-content {
                height: 300px; /* Меньшая высота для маленьких экранов */
            }
        }
    </style>

    <style>

        i.fa-exclamation {
            color: orangered; /* Цвет значка */
            visibility: visible; /* Видимость значка */
            border: 2px solid orangered; /* Обводка: 2 пикселя, сплошная, цвет orangered */
            border-radius: 4px; /* Радиус скругления углов (по желанию) */
            padding: 4px; /* Отступ внутри обводки (по желанию) */
        }


    </style>

</head>

<body>

<!--модальное окно-->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Содержимое модального окна-->
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

<!--<div class="tab">

    <button class="tab-button btn-primary" data-target="content-1">Заказать</button>
    <button class="tab-button btn-primary" data-target="content-2">Посмотреть готовые</button>

    <div class="tab-content active " id="content-1"></div>
    <div class="tab-content " id="content-2"></div>

</div>-->

<?php

$mysqli = require "connect/bd.php";

if ($mysqli->connect_error) {
    die("Соединение с базой данных не удалось: " . $mysqli->connect_error);
}


$sql = "
    SELECT o.id_order, o.quantity, o.status, d.name_dish 
    FROM order_dish o 
    JOIN dish d ON o.id_dish = d.id_dish
    WHERE o.status = 2;
";

$stmt = $mysqli->prepare($sql);

// Проверка запроса
if (!$stmt) {
    die("Ошибка подготовки запроса: " . $mysqli->error);
}

// Выполнение подготовленного запроса
$stmt->execute();

// Получение результатов
$result = $stmt->get_result();

    ?>


    <table class="table">
            <div class="tab">
        <tbody>
        <tr>
            <th scope="row"><button class="tab-button btn-primary" data-target="content-1">Заказать</button> <button class="tab-button btn-primary" data-target="content-2">Посмотреть готовые</button>
                <?php
                if ($result->num_rows > 0) {
                echo "<i class=\"fa-exclamation\" ></i>"; }
                ?>

                <button class="tab-button btn-primary" id="exit"> Выйти </button>
            </th>
        </tr>
        <tr>
            <th scope="row"><div class="tab-content active " id="content-1"></div> <div class="tab-content " id="content-2"></th>
        </tr>
            </div>
        </tbody>
    </table>





<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="bootstrap/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/officiant_mail.js"></script>

<script type="text/javascript">

    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    const urls = [
        "/officiant.php",
        "/officiant3.php"
    ];

    let loadedScripts = new Set(); // Для отслеживания загруженных скриптов

    tabButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            tabContents.forEach(content => content.classList.remove('active'));
            const targetContent = document.getElementById(button.dataset.target);
            targetContent.classList.add('active');

            if (targetContent.dataset.loaded !== "true") { // Проверка, загружен ли контент
                loadContent(index);
                targetContent.dataset.loaded = "true"; // Помечаем контент как загруженный
            }
        });
    });

    function loadContent(tabIndex) {
        const container = tabContents[tabIndex];
        const url = urls[tabIndex];

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text();
            })
            .then(html => {
                container.innerHTML = html;
                // Ключевое изменение:  выполняем скрипты после вставки HTML
                executeScripts(container);
            })

            .catch(error => {
                console.error("Ошибка загрузки контента:", error);
                container.innerHTML = `<p>Ошибка загрузки контента: ${error.message}</p>`;
            });
    }



    function executeScripts(container) {
        const scripts = container.querySelectorAll('script');

        scripts.forEach(script => {
            if (!loadedScripts.has(script.src)) { // Проверяем, загружен ли уже этот скрипт
                if (script.src) { // Если скрипт внешний
                    const newScript = document.createElement('script');
                    newScript.src = script.src;
                    newScript.onload = () => {
                        loadedScripts.add(script.src)
                    }; // добавляем в Set после загрузки
                    document.head.appendChild(newScript); // Вставляем в <head>, чтобы порядок загрузки был правильный
                } else { // Если скрипт встроенный
                    try {
                        eval(script.textContent);
                    } catch (e) {
                        console.error("Ошибка выполнения скрипта:", e);
                    }
                }
                loadedScripts.add(script.src || script.textContent);
            }
        });

    }

    // Загрузка контента для первой вкладки по умолчанию
    loadContent(0);

    //выход из аккаунта

    document.getElementById("exit").addEventListener("click", function() {
        // Отправка запроса на выход
        fetch('/exit.php', { // Предполагается, что у вас есть файл logout.php для обработки выхода
            method: 'POST', // Используем POST для безопасности
            credentials: 'same-origin' // Отправляем куки с запросом
        })
            .then(response => {
                if (response.ok) {
                    // Если выход успешен, перенаправляем на страницу входа или главную
                    window.location.href = 'login.php'; // Замените на нужный URL
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




</body>
</html>
