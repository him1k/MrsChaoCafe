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
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!-- Icon-Font -->
    <link rel="stylesheet" href="font-awesome/font-awesome/css/font-awesome.min.css" type="text/css">
    <!--[if IE 7]>
    	<link rel="stylesheet" href="font-awesome/font-awesome/css/font-awesome-ie7.min.css" type="text/css">
    <![endif]-->
    
    <!-- Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600italic,700%7CMontserrat:400,700%7CLato' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="owl-carousel/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="masterslider/style/masterslider.css" type="text/css">
    <link rel="stylesheet" href="masterslider/skins/default/style.css" type="text/css">
    <link rel="stylesheet" href="styles/main.css" type="text/css">
    
    <script type="text/javascript" src="js/modernizr.js"></script>
    
	<title>Bakery</title>
</head>

<body>
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
                        <li><div class="rectangle text_center_middle"><a href="/index.php">Меню</a></div> </li>
                        <!-- <li><div class="rectangle text_center_middle"><a href="cart.html">Корзина</a></div></li> -->
                        <li><div class="rectangle text_center_middle"><a href="/contact.php">Расположение</a></div></li>
                    </ul>
                    <h1 class="logo-primary"><img alt="" src="images/logochao.png"></h1>
                    <div class="logo-secondary"><img alt="" style="border-radius: 4px;" src="images/ShortLogo.png"></div>
                    <ul>
                        <li><div class="rectangle text_center_middle"><a href="#"> Вакансии </a></div></li>
                        <?php
                        if ($userId === null) {
                            echo '<li ><div class="rectangle text_center_middle" ><a href = "/login.php" > Вход </a ></div >';
                            echo "<ul>";
                            echo '<li><div class="rectangle text_center_middle"><a href="/registration.php"> Регистрация </a></div></li>';
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
        
        <section class="top-section">
        </section>


        <div class="martgin margin-10"> </div>

        <section id="products-section">
            <div class="section-content">
                <div class="container">
                    <header class="section-header" style="padding: 0 0 0 0">
                        <h1>Вакансии</h1>
                        <p></p>
                    </header>


                </div> <!-- .container -->
            </div><!-- .section-content -->
        </section>

            <div class="container square-box d-flex justify-content-center align-items-center" style="width: 600px;">
                <div style="border: 1px solid red; padding: 10px; border-radius: 20px; font-size: 15px">
                <div>Мы ищем ответственных и трудолюбивых людей для работы на кухне.
                Работа будет заключаться в приготовлении блюд, поддержании чистоты и порядка на рабочем месте, а также в соблюдении всех санитарных норм.
                </div>
                    <div>Мы предлагаем стабильную заработную плату, возможность карьерного роста и приятную атмосферу в коллективе.
                Если вы заинтересованы в данной ваканси, пожалуйста, свяжитесь с нами по указанным контактам.
                    </div> <br>
                    <div> Повар, кассир. <br>
                        Заработная плата 38000 - 45000 руб.<br>
                        График работы: Сменный<br><br>

                        Чтo мы предлагаeм:<br>
                        - выплатa заработнoй платы двa раза в месяц без задepжeк;<br>
                        - пpeдocтавляем униформу;<br>
                        - oфopмлeние мeдицинскoй книжки;<br>
                        - oплaта пpoeзда в ночнoe время дo домa;<br>
                        - cпоpтивная пpогрaммa (бacceйн, тренaжеpный зaл, сауна - зa cчeт pаботодaтеля).<br><br>

                        Чтo предcтоит дeлать:<br>
                        - oбслуживание посетителей;<br>
                        - подготовка бара к бесперебойной работе;<br>
                        - создавать атмосферу уюта и гостеприимства;<br>
                        - работа с кассой;<br>
                        - оказание помощи гостям при выборе ассортимента.<br><br>

                        Условия рассмотрения:<br>
                        - опыт работы в аналогичной должности как преимущество;<br>
                        - готовы рассмотреть кандидатов без опыта с последующим обучением, так же работа подойдет для студентов;<br>
                        - вежливость, ответственность, доброжелательность, желание работать и зарабатывать, умение работать в команде, готовность к обучению и развитию.<br><br>

                        30-20-54, Андрей
                    </div>
                </div>
            </div>

        <div class="margin-40"></div>

        <footer class="page-footer">
            <div class="footer-dark-contact">
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

            </div><!-- .footer-darl -->
            <p class=""> 2014 All rights reserved, Powered by IgnitionThemes</p>
        </footer>

	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="owl-carousel/owl.carousel.min.js"></script>
	<script type="text/javascript" src="masterslider/masterslider.min.js"></script>
    <script type="text/javascript" src="js/jquery.scrollTo.min.js"></script>
    <script type="text/javascript" src="js/jquery.stellar.min.js"></script>
    <script type="text/javascript" src="js/placeholder-fallback.js"></script>
    <script type="text/javascript" src="js/jquery.inview.min.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>
