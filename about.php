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
    
    <link rel="icon" href="icon.png" type="image/png">

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
    
	<title>Bakery - About</title>
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
                        <li><div class="rectangle text_center_middle"><a href="#">О нас</a></div>
                        </li>
                        <li><div class="rectangle text_center_middle"><a href="/index.php">Меню</a></div> </li>
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
        
        <section class="top-section">
            <!--это полоска коричневая-->
<!--        	<div class="offset-borders">
                <div class="full-header-container" id="header-about">
                    <div class="full-header">
                        <div class="container">
                            <h1>About</h1>
                            <h3>What is our company worth for</h3>
                        </div>
                    </div>
                </div>
            </div>-->
        </section>

		<section id="quote-section">            
            <div class="container">
               	<div class="quote">
                    Мы постоянно работаем с нашими клиентами, и вместе нам удается создавать красивые и удивительные вещи, которые, несомненно, приносят положительные результаты и полное удовлетворение.
                </div>
            </div>
      	</section>
        
        <section id="about-section">
        	<div class="section-content">
                <div class="container">
                    <header class="section-header">
                        <h1></h1>
<!--                        <p>See our big range of departaments, whe offer a lot of attention to our patients<br>
                        see what fits you and give us a call</p>-->
                    </header>
                    
                    <div class="row">
                    	<!-- <div class="col-md-6 onscroll-animate">
                        	<img class="img-responsive" alt="cup and logo" src="images/cup_and_logo.png">
                        </div> -->
                        <div class="col-md-6 onscroll-animate" data-delay="400">
                        	<article>
                            	<div class="article-header-2">
                        			<h1>Наша история</h1>
                        		</div>
                                <p>
                                    Кафе "Мистер Чао" — это место, где можно попробовать настоящую азиатскую еду. Мы готовим блюда из разных стран Азии: Китая, Японии, Кореи.

                                    У нас работают профессиональные повара, которые знают все тонкости приготовления азиатских блюд. Они используют только свежие и качественные продукты, чтобы каждый гость мог насладиться вкусом настоящей азиатской кухни.

                                    Мы предлагаем широкий выбор блюд: от супов до различных десертов. Каждый найдёт что-то по своему вкусу.
								</p>
                                
                                <div class="margin-20"></div>
                                
                                <p>
                                    Кроме того, у нас есть уютная атмосфера и дружелюбный персонал, который всегда готов помочь гостям выбрать подходящее блюдо или рассказать о наших специальных предложениях.

                                    Мы уверены, что каждый посетитель останется довольным и захочет вернуться к нам снова!
                               	</p>
                            </article>
                            
<!--                            <div class="margin-20"></div>
                            
                            <div class="row">
                            	<div class="col-xs-6">
                                	<div class="item-check">100% Отзывчивый</div>
                               		<div class="item-check">RETINA READY ICONS</div>
                                </div>
                                <div class="col-xs-6">
                                	<div class="item-check">BOXED AND WIDE VERSION</div>
                                	<div class="item-check">NICE DOCUMENTATION</div>
                                </div>
                            </div>-->
                            <div class="margin-70"></div>
                        </div>
                    </div>
              	</div>
          	</div>
      	</section>

        <div class="margin-70"></div>
        
<!--        <section id="video-section" class="section-white-cover parallax-background">
            <div class="section-content">
                <div class="container onscroll-animate">
                	<div class="margin-40"></div>
                    <h2 class="heading-huge">Video presentation</h2>
                    <div class="margin-20"></div>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/j5H8Z0k6uUY?si=cXR_GBp2l3yOjzFB" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    <div class="margin-30"></div>
                </div>&lt;!&ndash; .container &ndash;&gt;
            </div>&lt;!&ndash; .section-content &ndash;&gt;
        </section>-->
        
<!--        <section id="team-section">
            <div class="section-content">
                <div class="container">
                    <header class="section-header onscroll-animate">
                        <h1>Team Members</h1>
                        <p>Main core of our company is our team see the best people we have</p>
                    </header>
                    <div class="row"> 
                        <div class="col-md-3 onscroll-animate">
                            <div class="profile">
                                <div class="profile-box">
                                    <div class="profile-photo">
                                        <img alt="profile photo 1" src="images/profile1.png">
                                        <div class="profile-photo-info">
                                            <div class="profile-photo-info-container">
                                                <div class="profile-photo-info-content">
                                                    <div class="profile-icon"><a href="#"><i class="fa fa-facebook"></i></a></div>
                                                    <div class="profile-icon"><a href="#"><i class="fa fa-twitter"></i></a></div>
                                                    <div class="profile-icon"><a href="#"><i class="fa fa-google-plus"></i></a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Ch. <span class="text-uppercase">Morgan Dutch</span></h3>
                                </div>&lt;!&ndash; .profile-box &ndash;&gt;
                                <div class="profile-info">
                                    <p>Whether the flitting attendance of the one still and solitary jet had gradually worked upon Ahab.</p>
                                </div>
                            </div>&lt;!&ndash; .profile &ndash;&gt;
                            <div class="margin-40"></div>
                        </div>&lt;!&ndash; .col-md-3 &ndash;&gt;
                        <div class="col-md-3 onscroll-animate" data-delay="300">
                            <div class="profile">
                                <div class="profile-box">
                                    <div class="profile-photo">
                                        <img alt="profile photo 2" src="images/profile2.png">
                                        <div class="profile-photo-info">
                                            <div class="profile-photo-info-container">
                                                <div class="profile-photo-info-content">
                                                    <div class="profile-icon"><a href="#"><i class="fa fa-facebook"></i></a></div>
                                                    <div class="profile-icon"><a href="#"><i class="fa fa-twitter"></i></a></div>
                                                    <div class="profile-icon"><a href="#"><i class="fa fa-google-plus"></i></a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Ass. <span class="text-uppercase">Mikkie Rurk</span></h3>
                                </div>&lt;!&ndash; .profile-box &ndash;&gt;
                                <div class="profile-info">
                                    <p>Whether the flitting attendance of the one still and solitary jet had gradually worked upon Ahab.</p>
                                </div>
                            </div>&lt;!&ndash; .profile &ndash;&gt;
                            <div class="margin-40"></div>
                        </div>&lt;!&ndash; .col-md-3 &ndash;&gt;
                        <div class="col-md-3 onscroll-animate" data-delay="400">
                            <div class="profile">
                                <div class="profile-box">
                                    <div class="profile-photo">
                                        <img alt="profile photo 3" src="images/profile3.png">
                                        <div class="profile-photo-info">
                                            <div class="profile-photo-info-container">
                                                <div class="profile-photo-info-content">
                                                    <div class="profile-icon"><a href="#"><i class="fa fa-facebook"></i></a></div>
                                                    <div class="profile-icon"><a href="#"><i class="fa fa-twitter"></i></a></div>
                                                    <div class="profile-icon"><a href="#"><i class="fa fa-google-plus"></i></a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h3><span class="text-uppercase">Brandon Razer</span></h3>
                                </div>&lt;!&ndash; .profile-box &ndash;&gt;
                                <div class="profile-info">
                                    <p>Whether the flitting attendance of the one still and solitary jet had gradually worked upon Ahab.</p>
                                </div>
                            </div>&lt;!&ndash; .profile &ndash;&gt;
                            <div class="margin-40"></div>
                        </div>&lt;!&ndash; .col-md-3 &ndash;&gt;
                        <div class="col-md-3 onscroll-animate" data-delay="500">
                            <div class="profile">
                                <div class="profile-box">
                                    <div class="profile-photo">
                                        <img alt="profile photo 4" src="images/profile4.png">
                                        <div class="profile-photo-info">
                                            <div class="profile-photo-info-container">
                                                <div class="profile-photo-info-content">
                                                    <div class="profile-icon"><a href="#"><i class="fa fa-facebook"></i></a></div>
                                                    <div class="profile-icon"><a href="#"><i class="fa fa-twitter"></i></a></div>
                                                    <div class="profile-icon"><a href="#"><i class="fa fa-google-plus"></i></a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h3><span class="text-uppercase">Lindsie Rob</span></h3>
                                </div>&lt;!&ndash; .profile-box &ndash;&gt;
                                <div class="profile-info">
                                    <p>Whether the flitting attendance of the one still and solitary jet had gradually worked upon Ahab.</p>
                                </div>
                            </div>&lt;!&ndash; .profile &ndash;&gt;
                            <div class="margin-40"></div>
                        </div>&lt;!&ndash; .col-md-3 &ndash;&gt;
                    </div>&lt;!&ndash; .row &ndash;&gt;
                </div>&lt;!&ndash; .container &ndash;&gt;
            </div>&lt;!&ndash; .section-content &ndash;&gt;
        </section>-->


           

    </div>

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
