<?php
session_start();
//запись id клиента из сессии, если пользователь попал сюда через регистрацию
/*if (isset($_SESSION['id_client'])) {
    $userId = (int) $_SESSION['id_client'];*/

/*    if (isset($_SESSION['id_client'])) {
        $userId = (int) $_SESSION['id_client'];
//    echo "<script type=\"text/javascript\"> document.getElementById(\"id_client\").value = \" $userId\";  </script>";
} else {
        $userId = null;
    }*/


//отладка
$userId = 1;
//$userId= null;

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
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="owl-carousel/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="masterslider/style/masterslider.css" type="text/css">
    <link rel="stylesheet" href="masterslider/skins/default/style.css" type="text/css">
    <link rel="stylesheet" href="styles/main.css" type="text/css">
    <script type="text/javascript" src="js/modernizr.js"></script>

    <title>Bakery</title>

</head>

<body>

<!--скрытый input для передачи id_client-->
<input type="hidden" id="clientId" value="<?php echo htmlspecialchars($userId); ?>" >

<div id="all">
    <header class="page-header">
        <div class="page-header-content container">
            <div class="menu-button-container">
                <i id="menu-button" class="menu-button fa fa-reorder"></i>
            </div>
            <nav id="nav-top" class="nav-top">
                <ul>
                    <li><div class="rectangle text_center_middle"><a href="/about.php">О нас</a></div>
                    </li>
                    <li><div class="rectangle text_center_middle"><a href="#">Меню</a></div> </li>
                    <!-- <li><div class="rectangle text_center_middle"><a href="cart.html">Корзина</a></div></li> -->
                    <li><div class="rectangle text_center_middle"><a href="/contact.php">Расположение</a></div></li>
                </ul>
                <h1 class="logo-primary"><img alt="" src="images/logochao.png"></h1>
                <div class="logo-secondary"><img alt="" style="border-radius: 4px;" src="images/ShortLogo.png"></div>
                <ul>
                    <li><div class="rectangle text_center_middle"><a href="/vacancy.php"> Вакансии </a></div></li>
                    <?php
                    if ($userId === null) {
                        echo '<li ><div class="rectangle text_center_middle" ><a href = "login.php" > Вход </a ></div >';
                        echo "<ul>";
                        echo '<li><div class="rectangle text_center_middle"><a href="registration.php"> Регистрация </a></div></li>';
                        echo "</ul>";
                    }
                    else {
                        echo '<li ><div class="rectangle text_center_middle" ><a href = "validation_form/exit.php" > Выход </a ></div >';
                    }
                    ?>

                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div style="float: right">
        <button type="button" style="position: fixed ; right:0%;  z-index: 999;" class="button-index"> <a href="" STYLE="color: white;"> <span> Скачать наше</span> <br> <span> приложение </span> </a> </button>
    </div>
    <section id="slider-container" class="top-section">
        <div class="offset-borders">
            <noscript> <div class="text-center"> <h1>У вас отключён javascript. Для работы сайта необходимо его включить. <br> После его включения перезагрузите страницу </h1> </div> </noscript>
            <div class="ms-fullscreen-template">
                <div class="master-slider ms-skin-round" id="masterslider">
                    <div class="ms-slide">
                        <img src="images/slider/1.jpg" alt="header img">
                    </div><!-- .ms-slide -->
                    <div class="ms-slide">
                        <img src="images/slider/лента3.jpg" alt="header img">
                    </div><!-- .ms-slide -->
                    <div class="ms-slide">
                        <img src="images/slider/лента4.jpg" alt="header img">
                    </div><!-- .ms-slide -->
                </div><!-- .master-slider -->
            </div><!-- .ms-fullscreen-template -->
        </div>
    </section>
    <div id="products-section">
        <div class="section-content">
            <div class="container">
                <header class="section-header">
                    <h1>Пример того, что у нас есть</h1>
                    <p>Попробуйте некоторые из наших лучших продуктов и почувствуйте огромную страсть к еде</p>
                </header>

                <?php
                $mysqli = require "connect/bd.php";

                if ($mysqli->connect_error) {
                    die("Соединение с базой данных не удалось: " . $mysqli->connect_error);
                }

                $result = mysqli_query($mysqli, 'SELECT `id_dish`, `name_dish`, `price`, `structure`, `img`, `img_big` FROM `dish`');

                if (!$result) {
                    die('Ошибка выполнения запроса: ' . mysqli_error($mysqli));
                }

                $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

                ?>

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

                <!--конец-->
                <div id="products-slider-1" class="products-slider">
                    <div><!-- slide 1 -->
                        <div class="row">
                            <div class="col-md-6 onscroll-animate">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="product">
                                            <div class="product-preview" >
                                                <?php
                                                $show_img = base64_encode($products[0]['img']); // Кодируем в base64
                                                echo
                                                    "<img src=\"data:image/jpeg;base64," . $show_img . "\">
                                                        <h3>" . htmlspecialchars($products[0]['name_dish']) ."<br>". "  ". htmlspecialchars($products[0]['price']). "р" . "</h3>";
                                                /*состав блюда*/
                                                       echo "<button type=\"button\" class=\"btn btn-info btn-lg\" name=\"structure\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                                       data-structure=\"" . htmlspecialchars($products[0]['structure']) . "\" > Состав </button>";

                                                echo "<button type=\"button\" class=\"btn btn-danger btn-lg\" name=\"order\" 
                                                data-name=\"" . htmlspecialchars($products[0]['name_dish']) . "\" 
                                                data-price=\"" . htmlspecialchars($products[0]['price']) . "\"
                                                data-id=\"" . htmlspecialchars($products[0]['id_dish']) . "\">
                                                Добавить в корзину
                                                      </button>";

                                                ?>
                                            </div>
                                        </div><!-- .product -->
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="product">
                                            <div class="product-preview">
                                                <?php
                                                $show_img = base64_encode($products[1]['img']); // Кодируем в base64
                                                echo
                                                    "<img src=\"data:image/jpeg;base64," . $show_img . "\">
                                                    <h3>" . htmlspecialchars($products[1]['name_dish']) . "<br>"."  ". htmlspecialchars($products[1]['price']). "р" . "</h3>";

                                                echo "<button id=\"confirmAddDish\" type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                                       data-structure=\"" . htmlspecialchars($products[1]['structure']) . "\" > Состав </button>";

                                                echo "<button type=\"button\" class=\"btn btn-danger btn-lg\" name=\"order\" 
                                                data-name=\"" . htmlspecialchars($products[1]['name_dish']) . "\" 
                                                data-price=\"" . htmlspecialchars($products[1]['price']) . "\"
                                                data-id=\"" . htmlspecialchars($products[1]['id_dish']) . "\">
                                                Добавить в корзину
                                                      </button>";

                                                ?>


                                            </div>
                                        </div><!-- .product -->
                                    </div>
                                </div><!-- .row -->
                            </div><!-- .col-md-6 -->
                            <div class="col-md-6 onscroll-animate" data-delay="300">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="product">
                                            <div class="product-preview">
                                                <?php
                                                $show_img = base64_encode($products[2]['img']); // Кодируем в base64
                                                echo
                                                    "<img src=\"data:image/jpeg;base64," . $show_img . "\">
                                                    <h3>" . htmlspecialchars($products[2]['name_dish']) ."  ". htmlspecialchars($products[2]['price']). "р" . "</h3>" ;

                                                echo "<button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                                       data-structure=\"" . htmlspecialchars($products[2]['structure']) . "\" > Состав </button>";

                                                echo "<button type=\"button\" class=\"btn btn-danger btn-lg\" name=\"order\" 
                                                data-name=\"" . htmlspecialchars($products[2]['name_dish']) . "\" 
                                                data-price=\"" . htmlspecialchars($products[2]['price']) . "\"
                                                data-id=\"" . htmlspecialchars($products[2]['id_dish']) . "\">
                                                Добавить в корзину
                                                      </button>";

                                                ?>

                                            </div>

                                        </div><!-- .product -->
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="product">
                                            <div class="product-preview">
                                                <?php
                                                $show_img = base64_encode($products[3]['img']); // Кодируем в base64
                                                echo
                                                    "<img src=\"data:image/jpeg;base64," . $show_img . "\">
                                                    <h3>" . htmlspecialchars($products[3]['name_dish']) . "<br>". "  ". htmlspecialchars($products[3]['price']). "р" . "</h3>" ;

                                                echo "<button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                                       data-structure=\"" . htmlspecialchars($products[3]['structure']) . "\" > Состав </button>";

                                                echo "<button type=\"button\" class=\"btn btn-danger btn-lg\" name=\"order\" 
                                                data-name=\"" . htmlspecialchars($products[3]['name_dish']) . "\" 
                                                data-price=\"" . htmlspecialchars($products[3]['price']) . "\"
                                                data-id=\"" . htmlspecialchars($products[3]['id_dish']) . "\">
                                                Добавить в корзину
                                                      </button>";
                                                ?>
                                            </div>
                                        </div><!-- .product -->
                                    </div>
                                </div><!-- .row -->
                            </div><!-- .col-md-6 -->
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-md-6 onscroll-animate">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="product">

                                            <div class="product-preview">
                                                <?php
                                                $show_img = base64_encode($products[4]['img']); // Кодируем в base64
                                                echo
                                                    "<img src=\"data:image/jpeg;base64," . $show_img . "\">
                                                    <h3 style=\"font-size: 15px;\">" . htmlspecialchars($products[4]['name_dish']) . "<br>"."  ". htmlspecialchars($products[4]['price']). "р" . "</h3>" ;

                                                echo "<button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                                       data-structure=\"" . htmlspecialchars($products[4]['structure']) . "\" > Состав </button>";

                                                echo "<button type=\"button\" class=\"btn btn-danger btn-lg\" name=\"order\" 
                                                data-name=\"" . htmlspecialchars($products[4]['name_dish']) . "\" 
                                                data-price=\"" . htmlspecialchars($products[4]['price']) . "\"
                                                data-id=\"" . htmlspecialchars($products[4]['id_dish']) . "\">
                                                Добавить в корзину
                                                      </button>";

                                                ?>

                                            </div>
                                        </div><!-- .product -->
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="product">

                                            <div class="product-preview">
                                                <?php
                                                $show_img = base64_encode($products[5]['img']); // Кодируем в base64
                                                echo
                                                    "<img src=\"data:image/jpeg;base64," . $show_img . "\">
                                                    <h3>" . htmlspecialchars($products[5]['name_dish']) . "<br>". "  ". htmlspecialchars($products[5]['price']). "р" . "</h3>" ;

                                                echo "<button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                                       data-structure=\"" . htmlspecialchars($products[5]['structure']) . "\" > Состав </button>";

                                                echo "<button type=\"button\" class=\"btn btn-danger btn-lg\" name=\"order\" 
                                                data-name=\"" . htmlspecialchars($products[5]['name_dish']) . "\" 
                                                data-price=\"" . htmlspecialchars($products[5]['price']) . "\"
                                                data-id=\"" . htmlspecialchars($products[5]['id_dish']) . "\">
                                                Добавить в корзину
                                                      </button>";
                                                ?>
                                            </div>
                                            <h3 style="font-size: 15px;">
                                        </div><!-- .product -->
                                    </div>
                                </div><!-- .row -->
                            </div><!-- .col-md-6 -->
                            <div class="col-md-6 onscroll-animate" data-delay="300">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="product">
                                            <div class="product-preview">
                                                <?php
                                                $show_img = base64_encode($products[6]['img']); // Кодируем в base64
                                                echo
                                                    "<img src=\"data:image/jpeg;base64," . $show_img . "\">
                                                    <h3>" . htmlspecialchars($products[6]['name_dish']) . "<br>". "  ". htmlspecialchars($products[6]['price']). "р" . "</h3>" ;

                                                echo "<button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                                       data-structure=\"" . htmlspecialchars($products[6]['structure']) . "\" > Состав </button>";

                                                echo "<button type=\"button\" class=\"btn btn-danger btn-lg\" name=\"order\" 
                                                data-name=\"" . htmlspecialchars($products[6]['name_dish']) . "\" 
                                                data-price=\"" . htmlspecialchars($products[6]['price']) . "\"
                                                data-id=\"" . htmlspecialchars($products[6]['id_dish']) . "\">
                                                Добавить в корзину
                                                      </button>";
                                                ?>
                                            </div>
                                        </div><!-- .product -->
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="product">
                                            <div class="product-preview">
                                                <?php
                                                $show_img = base64_encode($products[7]['img']); // Кодируем в base64
                                                echo
                                                    "<img src=\"data:image/jpeg;base64," . $show_img . "\">
                                                    <h3>" . htmlspecialchars($products[7]['name_dish']) . "<br>"."  ". htmlspecialchars($products[7]['price']). "р" . "</h3>" ;

                                                echo "<button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                                       data-structure=\"" . htmlspecialchars($products[7]['structure']) . "\" > Состав </button>";

                                                echo "<button type=\"button\" class=\"btn btn-danger btn-lg\" name=\"order\" 
                                                data-name=\"" . htmlspecialchars($products[7]['name_dish']) . "\" 
                                                data-price=\"" . htmlspecialchars($products[7]['price']) . "\"
                                                data-id=\"" . htmlspecialchars($products[7]['id_dish']) . "\">
                                                Добавить в корзину
                                                      </button>";
                                                ?>
                                            </div>
                                        </div><!-- .product -->
                                    </div>
                                </div><!-- .row -->
                            </div><!-- .col-md-6 -->
                        </div><!-- .row -->
                    </div><!-- .slide-1 -->
                    <div><!-- slide 2 -->
                        <div class="row">
                            <div class="col-md-6 onscroll-animate">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="product">
                                            <!--Го Бао Жоу-->
                                            <div class="product-preview">
                                                <?php
                                                $show_img = base64_encode($products[8]['img']); // Кодируем в base64
                                                echo
                                                    "<img src=\"data:image/jpeg;base64," . $show_img . "\">
                                                    <h3>" . htmlspecialchars($products[8]['name_dish']) ."<br>"."  ". htmlspecialchars($products[8]['price']). "р" . "</h3>" ;

                                                echo "<button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                                       data-structure=\"" . htmlspecialchars($products[8]['structure']) . "\" > Состав </button>";

                                                echo "<button type=\"button\" class=\"btn btn-danger btn-lg\" name=\"order\" 
                                                data-name=\"" . htmlspecialchars($products[8]['name_dish']) . "\" 
                                                data-price=\"" . htmlspecialchars($products[8]['price']) . "\"
                                                data-id=\"" . htmlspecialchars($products[8]['id_dish']) . "\">
                                                Добавить в корзину
                                                      </button>";
                                                ?>
                                            </div>
                                        </div><!-- .product -->
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="product">
                                            <div class="product-preview">
                                                <?php
                                                $show_img = base64_encode($products[9]['img']); // Кодируем в base64
                                                echo
                                                    "<img src=\"data:image/jpeg;base64," . $show_img . "\">
                                                    <h3>" . htmlspecialchars($products[9]['name_dish']) ."<br>"."  ". htmlspecialchars($products[9]['price']). "р" . "</h3>" ;

                                                echo "<button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                                       data-structure=\"" . htmlspecialchars($products[9]['structure']) . "\" > Состав </button>";

                                                echo "<button type=\"button\" class=\"btn btn-danger btn-lg\" name=\"order\" 
                                                data-name=\"" . htmlspecialchars($products[9]['name_dish']) . "\" 
                                                data-price=\"" . htmlspecialchars($products[9]['price']) . "\"
                                                data-id=\"" . htmlspecialchars($products[9]['id_dish']) . "\">
                                                Добавить в корзину
                                                      </button>";
                                                ?>
                                            </div>
                                        </div><!-- .product -->
                                    </div>
                                </div><!-- .row -->
                            </div><!-- .col-md-6 -->
                            <div class="col-md-6 onscroll-animate" data-delay="300">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="product">

                                            <div class="product-preview">
                                                <?php
                                                $show_img = base64_encode($products[10]['img']); // Кодируем в base64
                                                echo
                                                    "<img src=\"data:image/jpeg;base64," . $show_img . "\">
                                                    <h3>" . htmlspecialchars($products[10]['name_dish']) ."<br>"."  ". htmlspecialchars($products[10]['price']). "р" . "</h3>" ;

                                                echo "<button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                                       data-structure=\"" . htmlspecialchars($products[10]['structure']) . "\" > Состав </button>";

                                                echo "<button type=\"button\" class=\"btn btn-danger btn-lg\" name=\"order\" 
                                                data-name=\"" . htmlspecialchars($products[10]['name_dish']) . "\" 
                                                data-price=\"" . htmlspecialchars($products[10]['price']) . "\"
                                                data-id=\"" . htmlspecialchars($products[10]['id_dish']) . "\">
                                                Добавить в корзину
                                                      </button>";
                                                ?>
                                            </div>
                                        </div><!-- .product -->
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="product">

                                            <div class="product-preview">
                                                <?php
                                                $show_img = base64_encode($products[11]['img']); // Кодируем в base64
                                                echo
                                                    "<img src=\"data:image/jpeg;base64," . $show_img . "\">
                                                    <h3>" . htmlspecialchars($products[11]['name_dish']) ."<br>"."  ". htmlspecialchars($products[11]['price']). "р" . "</h3>" ;

                                                echo "<button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                                       data-structure=\"" . htmlspecialchars($products[11]['structure']) . "\" > Состав </button>";

                                                echo "<button type=\"button\" class=\"btn btn-danger btn-lg\" name=\"order\" 
                                                data-name=\"" . htmlspecialchars($products[11]['name_dish']) . "\" 
                                                data-price=\"" . htmlspecialchars($products[11]['price']) . "\"
                                                data-id=\"" . htmlspecialchars($products[11]['id_dish']) . "\">
                                                Добавить в корзину
                                                      </button>";
                                                ?>
                                            </div>
                                        </div><!-- .product -->
                                    </div>
                                </div><!-- .row -->
                            </div><!-- .col-md-6 -->
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-md-6 onscroll-animate">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="product">

                                            <div class="product-preview">
                                                <?php
                                                $show_img = base64_encode($products[12]['img']); // Кодируем в base64
                                                echo
                                                    "<img src=\"data:image/jpeg;base64," . $show_img . "\">
                                                    <h3>" . htmlspecialchars($products[12]['name_dish']) ."<br>"."  ". htmlspecialchars($products[12]['price']). "р" . "</h3>" ;

                                                echo "<button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                                       data-structure=\"" . htmlspecialchars($products[12]['structure']) . "\" > Состав </button>";

                                                echo "<button type=\"button\" class=\"btn btn-danger btn-lg\" name=\"order\" 
                                                data-name=\"" . htmlspecialchars($products[12]['name_dish']) . "\" 
                                                data-price=\"" . htmlspecialchars($products[12]['price']) . "\"
                                                data-id=\"" . htmlspecialchars($products[12]['id_dish']) . "\">
                                                Добавить в корзину
                                                      </button>";
                                                ?>
                                            </div>
                                        </div><!-- .product -->
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="product">
                                            <div class="product-preview">
                                                <?php
                                                $show_img = base64_encode($products[13]['img']); // Кодируем в base64
                                                echo
                                                    "<img src=\"data:image/jpeg;base64," . $show_img . "\">
                                                    <h3>" . htmlspecialchars($products[13]['name_dish']) ."<br>"."  ". htmlspecialchars($products[13]['price']). "р" . "</h3>" ;

                                                echo "<button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                                       data-structure=\"" . htmlspecialchars($products[13]['structure']) . "\" > Состав </button>";

                                                echo "<button type=\"button\" class=\"btn btn-danger btn-lg\" name=\"order\" 
                                                data-name=\"" . htmlspecialchars($products[13]['name_dish']) . "\" 
                                                data-price=\"" . htmlspecialchars($products[13]['price']) . "\"
                                                data-id=\"" . htmlspecialchars($products[13]['id_dish']) . "\">
                                                Добавить в корзину
                                                      </button>";
                                                ?>
                                            </div>
                                        </div><!-- .product -->
                                    </div>
                                </div><!-- .row -->
                            </div><!-- .col-md-6 -->
                            <div class="col-md-6 onscroll-animate" data-delay="300">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="product">

                                            <div class="product-preview">
                                                <?php
                                                $show_img = base64_encode($products[14]['img']); // Кодируем в base64
                                                echo
                                                    "<img src=\"data:image/jpeg;base64," . $show_img . "\">
                                                    <h3>" . htmlspecialchars($products[14]['name_dish']) ."<br>"."  ". htmlspecialchars($products[14]['price']). "р" . "</h3>";

                                                echo "<button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                                       data-structure=\"" . htmlspecialchars($products[0]['structure']) . "\" > Состав </button>";

                                                echo "<button type=\"button\" class=\"btn btn-danger btn-lg\" name=\"order\" 
                                                data-name=\"" . htmlspecialchars($products[14]['name_dish']) . "\" 
                                                data-price=\"" . htmlspecialchars($products[14]['price']) . "\"
                                                data-id=\"" . htmlspecialchars($products[14]['id_dish']) . "\">
                                                Добавить в корзину
                                                      </button>";
                                                ?>

                                            </div>
                                        </div><!-- .product -->
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="product">

                                            <div class="product-preview">

                                                 <?php
                                                $show_img = base64_encode($products[15]['img']); // Кодируем в base64
                                                echo
                                                    "<img src=\"data:image/jpeg;base64," . $show_img . "\">
                                                    <h3>" . htmlspecialchars($products[15]['name_dish']) ."<br>"."  ". htmlspecialchars($products[15]['price']). "р" . "</h3>";

                                                 echo "<button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\" 
                                                       data-structure=\"" . htmlspecialchars($products[15]['structure']) . "\" > Состав </button>";

                                                 echo "<button type=\"button\" class=\"btn btn-danger btn-lg\" name=\"order\" 
                                                data-name=\"" . htmlspecialchars($products[15]['name_dish']) . "\" 
                                                data-price=\"" . htmlspecialchars($products[15]['price']) . "\"
                                                data-id=\"" . htmlspecialchars($products[15]['id_dish']) . "\">
                                                Добавить в корзину
                                                      </button>";
                                                 ?>

                                            </div>
                                        </div><!-- .product -->
                                    </div>
                                </div><!-- .row -->
                            </div><!-- .col-md-6 -->
                        </div><!-- .row -->
                    </div>
                </div><!-- .products-slider -->

                <div class="margin-60"></div>

                <p class="text-center onscroll-animate">
                    <button id="sendOrder" type="button" class="btn btn-danger"> Заказать </button>

                    <button id="status_order" type="button" class="btn btn-danger"> Посмотреть состояние заказа </button>

                </p>

                <div class="margin-10"></div>

                <!--ВТОРАЯ НОВАЯ ТАБЛИЦА-->

                <table class="table table-bordered" id="orderTable">
                    <thead>
                    <tr>
                        <th>№ блюда</th>
                        <th>Название</th>
                        <th>Цена</th>
                        <th>Количество <br> (не больше 5 блюд) </th>
                        <th>Добавить комментарий <br> (максимум 120 символов) </th>
                        <th>Общая стоимость блюда</th>
                        <th>Удалить</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Здесь будут добавляться строки с блюдами -->
                    </tbody>
                </table>
                <div class="total-sum">
                    <strong>Итого: <span id="totalSum">0</span> руб.</strong>
                </div>

                <!--конец второй новой таблицы-->

                <!--div style none-->
            </div><!-- .container -->
        </div><!-- .section-content -->
    </div>


    <div class="margin-100"></div>

    <section id="offer-section">
        <div class="section-content">
            <div class="container">
                <header class="section-header onscroll-animate">
                    <h1>Интересные предложения</h1>

                </header>

                <div class="tabs-big-container centered-columns">
                    <div class="centered-column centered-column-top">
                        <!-- Nav tabs -->
                        <ul class="nav" role="tablist">

                            <li class="active onscroll-animate"><a href="#popular" role="tab" data-toggle="tab">
                                    <?php
                                    $show_img = base64_encode($products[16]['img']); // Кодируем в base64
                                    echo
                                        "<img alt=\"product \" src=\"data:image/jpeg;base64," . $show_img . "\">";
                                    ?>
                                </a></li>
                            <li class="onscroll-animate" data-delay="400"><a href="#recent" role="tab" data-toggle="tab">
                                    <?php
                                    $show_img = base64_encode($products[17]['img']); // Кодируем в base64
                                    echo
                                        "<img alt=\"product 2 thumb\" src=\"data:image/jpeg;base64," . $show_img . "\">";
                                    ?>
                                </a></li>
                            <li class="onscroll-animate" data-delay="600"><a href="#comments" role="tab" data-toggle="tab">
                                    <?php
                                    $show_img = base64_encode($products[18]['img']); // Кодируем в base64
                                    echo
                                        "<img alt=\"product 3 thumb\" src=\"data:image/jpeg;base64," . $show_img . "\">";
                                    ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--кружок 1-->
                    <div class="centered-column tab-content centered-column-top">
                        <!-- Tab panes -->
                        <div role="tabpanel" class="tab-pane fade in active" id="popular">
                            <article>
                                <div class="centered-columns offer-box">
                                    <div class="offer-box-left centered-column">
                                        <div class="offer-info">
                                            <h1>
                                                <?php
                                                echo htmlspecialchars($products[16]['name_dish']);
                                                ?>
                                            </h1>
                                            <p>Китайские кексы фа-гао — это традиционная выпечка, которая имеет форму шара или цилиндра.
 Они могут быть приготовлены из различных видов муки, включая пшеничную, рисовую, кукурузную.
 В качестве начинки для фа-гао часто используют сладкие ингредиенты, такие как фруктовые джемы, орехи или шоколад.
 Однако также существуют и несладкие варианты, например, с мясом или овощами.</p>
                                          <?php
/*                                            echo htmlspecialchars($products[16]['description']);
                                            */?>
                                            <h2>Ингридиенты:</h2>
                                            <ul class="list-numbers">
                                                <?php
                                                $structure = $products[16]['structure'];
                                                $ingredients = array_map('trim', explode(',', $structure));
                                                foreach ($ingredients as $ingredient) {
                                                    echo '<li>' . htmlspecialchars($ingredient) . '</li>';
                                                }
                                                ?>

                                            </ul>

                                        </div>
                                    </div>
                                    <div class="offer-box-right centered-column" style="background-image:url('images/фа-гаоБ.jpg');">

                                    </div>
                                </div><!-- .row -->
                            </article>
                        </div><!-- .tab-pane -->
                        <div role="tabpanel" class="tab-pane fade" id="recent">
                            <article>
                                <div class="centered-columns offer-box">
                                    <div class="offer-box-left centered-column">
                                        <div class="offer-info">
                                            <h1><?php
                                                echo htmlspecialchars($products[17]['name_dish']);
                                                ?></h1>
                                            <p> Гедзе — блюдо китайской, а также японской и корейской кухни, одна из разновидностей пельменных изделий этого региона.
Гёдза лепятся из теста с начинкой из мяса (чаще всего — свиного фарша) и овощей (чаще всего — капусты), реже только из мяса.
Они могут иметь различную форму и подаются с соусом из уксуса, соевого соуса и измельчённого чеснока.</p>
                                            <?php
/*                                            echo htmlspecialchars($products[17]['description']);*/
                                            ?>
                                            <h2>Ингридиенты:</h2>
                                            <ul class="list-numbers">

                                                <?php
                                                $structure = $products[17]['structure'];
                                                $ingredients = array_map('trim', explode(',', $structure));
                                                foreach ($ingredients as $ingredient) {
                                                    echo '<li>' . htmlspecialchars($ingredient) . '</li>';
                                                }
                                                ?>


                                            </ul>
                                        </div>
                                    </div>
                                    <div class="offer-box-right centered-column" style="background-image:url('images/гедзеБ.jpg');">

                                    </div>
                                </div><!-- .row -->
                            </article>
                        </div><!-- .tab-pane -->
                        <div role="tabpanel" class="tab-pane fade" id="comments">
                            <article>
                                <div class="centered-columns offer-box">
                                    <div class="offer-box-left centered-column">
                                        <div class="offer-info">
                                            <h1>
                                                <?php
                                                echo htmlspecialchars($products[18]['name_dish']);
                                                ?></h1>
                                            <p>Лунные пряники — это главное лакомство в Китае в Праздник середины осени.
Это своеобразная и довольно калорийная выпечка, главными ингредиентами которой являются яичный желток с бобовой пастой.
Начинка может быть любой, насколько позволяет фантазия: от классической (орехи, бобы, паста из семян лотоса, сухофрукты, роза, мясо) до экзотической (самбал, дуриан, солёные яица, акулий плавник).</p>
                                            <p><?php
/*                                                echo htmlspecialchars($products[18]['description']);*/
                                                ?></p>
                                            <h2>Ингридиенты:</h2>
                                            <ul class="list-numbers">

                                                <?php
                                                $structure = $products[18]['structure'];
                                                $ingredients = array_map('trim', explode(',', $structure));
                                                foreach ($ingredients as $ingredient) {
                                                    echo '<li>' . htmlspecialchars($ingredient) . '</li>';
                                                }
                                                ?>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="offer-box-right centered-column" style="background-image:url('images/лунный-пряникБ.jpg');">

                                    </div>
                                </div><!-- .row -->
                            </article>
                        </div><!-- .tab-pane -->
                    </div><!-- .centered-column -->
                </div><!-- .tabs-big-container -->

                <div class="margin-80"></div>
            </div><!-- .container -->
        </div><!-- .section-content -->
    </section>

</div>

<footer class="page-footer">
    <div class="footer-dark-contact">
        <div class="margin-30"></div>
        <div class="container text-center">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-6 footer-column onscroll-animate">
                            <h4>Время работы</h4>
                            <p>
                                Понедельник - Пятница: <span class="highlight">08:00 - 20:30 </span><br>
                                Суббота - Воскресение: <span class="highlight">10:00 - 16:30 </span>
                            </p>
                        </div>
                        <div class="col-sm-6 footer-column onscroll-animate" data-delay="300">
                            <h4>Счастливые часы</h4>
                            <p>
                                Присоединяйтесь к нам в счастливые часы<br>
                                Попробуйте вкусный вок с говядиной.<br>
                                <span class="highlight">Ежедневно с 11:00 до 18:00</span>
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-6 footer-column onscroll-animate" data-delay="400">
                            <h4>Мы есть в: </h4>
                            <div class="social-icon-container">
                                <a href="#"><i class="fa fa-youtube"></i></a>
                            </div>
                            <div class="social-icon-container">
                                <a href="#"><i class="fa fa-vk"></i></a>
                            </div>
                            <!--fa-rss вай фай-->
                        </div>
                        <div class="col-sm-6 footer-column onscroll-animate" data-delay="500">
                            <h4>У нас:</h4>
                            <p><li>Уютно</li></p>
                            <p><li>Есть вай - фай</li></p>
                            <p><li>Можно вкусно покушать</li></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- .footer-dark -->
    <p class=""> 2014 All rights reserved, Powered by IgnitionThemes</p>
</footer>

<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="owl-carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="masterslider/masterslider.min.js"></script>
<script type="text/javascript" src="js/jquery.scrollTo.min.js"></script>
<script type="text/javascript" src="js/jquery.stellar.min.js"></script>
<script type="text/javascript" src="js/placeholder-fallback.js"></script>
<script type="text/javascript" src="js/jquery.inview.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>

<script type="text/javascript">

    //пересылка на страницу, где показываются заказы
    document.getElementById('status_order').addEventListener('click', function() {
        window.location.href='/client.php'
    });

</script>

<script type="text/javascript" defer>


$('#myModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Кнопка, которая вызвала модальное окно

        var structure = button.data('structure'); // Извлекаем данные о составе
        var modal = $(this);
        modal.find('.modal-body #dishStructure').text(structure); // Обновляем текст в модальном окне

});


$(document).ready(function() {
    let totalSum = 0;

    $('#orderTable').on('change', '.quantity', function() {
        let input = this; // Ссылка на input элемент
        validateInput(input); // Вызов функции валидации

        let quantity = parseInt($(this).val());
        let price = parseFloat($(this).closest('tr').find('.price').text());

        //Проверка на валидность quantity после валидации
        if (isNaN(quantity) || quantity < 1 || quantity > 5) {
            quantity = 1; // Устанавливаем значение по умолчанию, если ввод некорректен.
            $(this).val(1); // Обновление значение в input
        }

        let currentRowTotal = quantity * price;
        $(this).closest('tr').find('.row-total').text(currentRowTotal.toFixed(2));

        calculateTotal();
    });

    $('#orderTable').on('click', '.remove-row', function() {
        let rowTotal = parseFloat($(this).closest('tr').find('.row-total').text());
        totalSum -= rowTotal;
        $(this).closest('tr').remove();
        $('#totalSum').text(totalSum.toFixed(2));
    });

    function calculateTotal() {
        totalSum = 0;
        $('.row-total').each(function() {
            totalSum += parseFloat($(this).text());
        });
        $('#totalSum').text(totalSum.toFixed(2));
    }

    $('button[name="order"]').click(function() {
        let name = $(this).data('name');
        let price = $(this).data('price');
        let idDish = $(this).data('id');
        let rowCount = $('#orderTable tbody tr').length + 1;

        let newRow = `
            <tr>
                <td>${rowCount}</td>
                <td>${name}</td>
                <td class="price">${price}</td>
                <td><input type="number" class="form-control quantity" required value="1" min="1" max="5"></td>
                <td><textarea class="comment-input form-control" placeholder="На что у вас аллергия? Что вы не любите?" maxlength="120"></textarea></td>
                <td class="row-total">${price}</td>
                <td><button class="btn btn-default remove-row">Удалить</button></td>
                <td style="display:none;" class="id-dish">${idDish}</td>
            </tr>
        `;

        $('#orderTable tbody').append(newRow);
        calculateTotal();
    });

    $('#sendOrder').click(function() {

        let orderData = [];
        let isValid = true; // Флаг для проверки валидности данных

        $('#orderTable tbody tr').each(function() {
            let idDish = $(this).find('.id-dish').text();
            let quantity = parseInt($(this).find('.quantity').val());
            let comment = $(this).find('.comment-input').val();

            if (isNaN(quantity) || quantity < 1 || quantity > 5) {
                alert('Некорректное количество для блюда! (Допустимо от 1 до 5)');
                isValid = false;
                return false; // Прерываем обработку текущей строки
            }
            if (comment.length > 120) {
                alert('Превышено допустимое количество символов в комментарии (максимум 120)');
                isValid = false;
                return false; // Прерываем обработку текущей строки
            }
            orderData.push({id_dish: idDish, quantity: quantity, comment: comment});
        });

        let totalSum = $('#totalSum').text();

        //получение id клиента
        let clientId = $('#clientId').val();

        if (!clientId || isNaN(parseInt(clientId)) || orderData.length === 0 || !isValid) {
            alert('Некорректные данные заказа!');
            return;
        }

        //отладка
        console.log("Data to send:", orderData, totalSum, clientId);

        $.ajax({
            url: '/order_client.php',
            type: 'POST',
            data: JSON.stringify({orders: orderData, totalSum: totalSum, client_id: clientId}),
            contentType: 'application/json',
            success: function(response) {
                console.log("Success response:", response);
                alert('Заказ успешно отправлен!');
                $('#orderTable tbody').empty();
                totalSum = 0;
                $('#totalSum').text(totalSum.toFixed(2));
            },
            error: function(xhr, status, error) {
                console.error("Error:", status, error, xhr.responseText);
                alert('Произошла ошибка при отправке заказа. Попробуйте ещё раз.');
            }
        });
    });
});

function validateInput(input) {
    let value = parseInt(input.value);
    if (isNaN(value) || value < 1 || value > 5) {
        input.value = ''; // Очищаем input при некорректном значении
    }
}

</script>

</body>
</html>
