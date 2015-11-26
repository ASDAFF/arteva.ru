<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Главная</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="stylesheet" href="/css/plugins/jquery.fancybox3.css"/>
    <link rel="stylesheet" href="/css/plugins/jquery.fancybox-thumbs.css"/>
    <link rel="stylesheet" href="/css/plugins/coin-slider-styles.css"/>
    <link rel="stylesheet" href="/css/plugins/idangerous.swiper.css"/>
    <link rel="stylesheet" href="/css/plugins/chosen.min.css"/>
    <link rel="stylesheet" href="/css/plugins/jquery.nouislider.min.css"/>
    <link rel="stylesheet" href="/css/plugins/jquery.mCustomScrollbar.css"/>
    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/addons/modernizr-2.6.2.min.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAvQSpv4GNTxToru5eLi-iQ16oGp9-XapE&sensor=true"></script>

    <!--[if lt IE 9]>
    <script>
        document.createElement('main');
        document.createElement( "picture" );
    </script>
    <![endif]-->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-46203144-1', 'auto');
        ga('require', 'displayfeatures');
        ga('require', 'linkid', 'linkid.js');
        ga('send', 'pageview');
    </script>
</head>
<body>
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div id="root-wrapper">
    <div class="overlay"></div>
    <div id="site-wrapper">

        <!-- Для адаптивной версии -->
        <div class="mobile-menu-cnt">
            <a class="close-mobile-menu js-close-menu" href="#"></a>
            <div class="search-form-cnt">
                <form action="">
                    <input type="text" name="search" id="mobile-search" placeholder="Поиск по сайту"/><input type="submit" value=""/>
                </form>
            </div>
            <div class="phones-cnt">
                <p><span>8 (800) 775-40-48</span>Бесплатно по России</p>
                <p><span>8 (495) 255-21-51</span>Телефон в Москве</p>
                <p><a class="fancy-popup" href="#callback-form">Прошу перезвонить</a></p>
            </div>
            <div class="mobile-top-links">
                <a href="#">Оплата и доставка</a>
                <a href="#">Купить в салоне</a>
            </div>
            <div class="mobile-top-nav">
                <ul class="top-nav-list">
                    <li><a href="#">Светильники</a></li>
                    <li><a href="#">Предметы интерьера</a></li>
                    <li><a href="#">Мебель</a></li>
                    <li><a href="#">Новинки</a></li>
                    <li class="marked"><a href="#">Sale</a></li>
                </ul>
            </div>
            <div class="mobile-top-user">
                <a class="icon-fav" href="#">Избранное</a>
                <a class="icon-user" href="#">Личный кабинет</a>
                <a class="icon-cart" href="#">Корзина</a>
            </div>
        </div>
        <!-- Для адаптивной версии -->

        <div class="top-search-cnt">
            <div class="<?=$curprefix?>content-wrapper">
                <a class="close-top-search js-close-search" href="#">Закрыть</a>

                <form action="">
                    <i class="search-icon"></i>
                    <input class="search-text" placeholder="Поиск..." type="text" name="search-text" id="search-text"/><input class="search-submit" type="submit" value=""/>
                </form>
            </div>
        </div>
        <div class="site-header">
            <div class="top-cnt">
            <div class="top-row">
                <div class="<?=$curprefix?>content-wrapper">
                    <div class="top-links fleft">
                        <a href="#">Оплата и доставка</a>
                        <a href="#">Купить в салоне</a>
                    </div>
                    <div class="top-user fright">
                        <a class="iconic icon-fav" href="#">Избранное</a>
                        <a class="iconic icon-user" href="#">Личный кабинет</a>
                    </div>
                </div>
            </div>
            <div class="fix-header">
                <div class="fix-top">
                    <div class="<?=$curprefix?>content-wrapper">
                        <div class="phone-cnt">
                            <p class="phone">8 (800) 775-40-48</p>
                            <p class="meta">Бесплатно по России</p>
                            <a class="fancy-popup" href="#callback-form">Прошу перезвонить</a>
                        </div>
                        <div class="phone-cnt">
                            <p class="phone">8 (495) 255-21-51</p>
                            <p class="meta">телефон в москве</p>
                        </div>
                        <div class="top-cart-btn">
                            <a class="js-cart-trigger" data-overlay="cart" href="/cart/">
                                <div class="cart-icon"><span class="js-cart-items-count">12</span></div>
                                <div class="cart-text">
                                    <p>Корзина</p>
                                    <p class="sum js-sum">57 500 <span class="rub">a</span></p>
                                </div>
                            </a>
                        </div>
                        <div class="mobile-menu">
                            <a class="js-mobile-menu-trigger" data-overlay="mobile-menu" href="#"></a>
                        </div>
                        <a class="logo" href="#"></a>
                    </div>
                </div>
            </div>
            </div>
            <div class="top-nav">
                <div class="<?=$curprefix?>content-wrapper">
                    <ul class="top-nav-list">
                        <li class="has-sublist">
                            <a href="#">
                                Светильники
                            </a>
                            <div class="top-nav-sublist-cnt">
                                <div class="top-nav-sublist-wrapper">
                                    <ul class="top-nav-sublist">
                                        <li><a href="#">Зеркала</a></li>
                                        <li><a href="#">Часы</a></li>
                                        <li><a href="#">Подсвечники</a></li>
                                        <li><a href="#">Скульптуры</a></li>
                                        <li><a href="#">Статуэтки</a></li>
                                        <li><a href="#">Вазы</a></li>
                                        <li><a href="#">Вешалки</a></li>
                                    </ul>
                                    <ul class="top-nav-sublist">
                                        <li><a href="#">Шкатулки</a></li>
                                        <li><a href="#">Принты, фото</a></li>
                                        <li><a href="#">Посуда</a></li>
                                        <li><a href="#">Предметы декора</a></li>
                                        <li><a href="#">Подставки для книг</a></li>
                                        <li><a href="#">Аксессуары, подарки</a></li>
                                    </ul>
                                    <div class="top-nav-img-wrapper">
                                        <div class="bg-cover top-nav-img" style="background-image: url('/img/bg_top_nav.jpg');"></div>
                                    </div>
                                </div>

                            </div>
                        </li>
                        <li class="has-sublist">
                            <a href="#">Предметы интерьера</a>
                            <div class="top-nav-sublist-cnt">
                                <div class="top-nav-sublist-wrapper">
                                    <ul class="top-nav-sublist">
                                        <li><a href="#">Зеркала</a></li>
                                        <li><a href="#">Часы</a></li>
                                        <li><a href="#">Подсвечники</a></li>
                                        <li><a href="#">Скульптуры</a></li>
                                        <li><a href="#">Статуэтки</a></li>
                                        <li><a href="#">Вазы</a></li>
                                        <li><a href="#">Вешалки</a></li>
                                    </ul>
                                    <ul class="top-nav-sublist">
                                        <li><a href="#">Шкатулки</a></li>
                                        <li><a href="#">Принты, фото</a></li>
                                        <li><a href="#">Посуда</a></li>
                                        <li><a href="#">Предметы декора</a></li>
                                        <li><a href="#">Подставки для книг</a></li>
                                        <li><a href="#">Аксессуары, подарки</a></li>
                                    </ul>
                                    <div class="top-nav-img-wrapper">
                                        <div class="bg-cover top-nav-img" style="background-image: url('/img/bg_top_nav.jpg');"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li><a href="#">Мебель</a></li>
                        <li class="has-sublist">
                            <a href="#">Новинки</a>
                            <div class="top-nav-sublist-cnt">
                                <div class="top-nav-sublist-wrapper">
                                    <ul class="top-nav-sublist">
                                        <li><a href="#">Зеркала</a></li>
                                        <li><a href="#">Часы</a></li>
                                        <li><a href="#">Подсвечники</a></li>
                                        <li><a href="#">Скульптуры</a></li>
                                        <li><a href="#">Статуэтки</a></li>
                                        <li><a href="#">Вазы</a></li>
                                        <li><a href="#">Вешалки</a></li>
                                    </ul>
                                    <ul class="top-nav-sublist">
                                        <li><a href="#">Шкатулки</a></li>
                                        <li><a href="#">Принты, фото</a></li>
                                        <li><a href="#">Посуда</a></li>
                                        <li><a href="#">Предметы декора</a></li>
                                        <li><a href="#">Подставки для книг</a></li>
                                        <li><a href="#">Аксессуары, подарки</a></li>
                                    </ul>
                                    <div class="top-nav-img-wrapper">
                                        <div class="bg-cover top-nav-img" style="background-image: url('/img/bg_top_nav.jpg');"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="marked"><a href="#">Sale</a></li>
                    </ul>
                    <a class="search-trigger js-search-trigger" data-overlay="search" href="#">Поиск</a>
                </div>
            </div>
        </div>
