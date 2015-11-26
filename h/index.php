<?php
$curprefix = 'index-';
    include('header.php');
?>

<div class="<?=$curprefix?>content-wrapper">
    <div class="main-slider-cnt">
        <ul class="main-slider">
            <li><a href="#"><img src="/img/img_main_slider1.jpg" alt="slide"/></a></li>
            <li><a href="#"><img src="/img/img_main_slider2.jpg" alt="slide"/></a></li>
            <li><a href="#"><img src="/img/img_main_slider3.jpg" alt="slide"/></a></li>
        </ul>
    </div>
    <div class="main-items">
        <div class="item-big">
            <a href="#">
                <div class="img-cnt">
                    <img src="/img/img_item_big1.jpg" alt="item"/>
                </div>
                <div class="item-info">
                    <div>
                        <p class="item-name">ARTEVULANCE</p>
                        <p class="item-desc">Панно настенное</p>
                        <p class="item-price"><span>19 800</span> руб.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="item"><a href="#">
                <div class="img-cnt"><img src="/img/img_item1.jpg" alt=""/></div>
                <div class="item-info">
                    <p class="item-name">LA MARINA</p>

                    <p class="item-desc">Светильник подвесной</p>

                    <p class="item-price"><span>48 700</span> руб.</p>
                </div>
            </a></div>
        <div class="item"><a href="#">
                <div class="img-cnt"><img src="/img/img_item2.jpg" alt=""/></div>
                <div class="item-info">
                    <p class="item-name">ARTEVALUCE</p>

                    <p class="item-desc">Часы</p>

                    <p class="item-price"><span>9 500</span> руб.</p>
                </div>
            </a></div>
        <div class="item"><a href="#">
                <div class="img-cnt"><img src="/img/img_item3.jpg" alt=""/></div>
                <div class="item-info">
                    <p class="item-name">EICHHOLTZ</p>

                    <p class="item-desc">Лампа настольная</p>

                    <p class="item-price"><span>25 000</span> руб.</p>
                </div>
            </a></div>
        <div class="item"><a href="#">
                <div class="img-cnt"><img src="/img/img_item4.jpg" alt=""/></div>
                <div class="item-info">
                    <p class="item-name">DEVONSHIRE</p>

                    <p class="item-desc">Стул</p>

                    <p class="item-price"><span>25 500</span> руб.</p>
                </div>
            </a></div>
    </div>
    <div class="promo-header">
        <p>Наши изделия</p>
        <p>в интерьерах</p>
    </div>
    <div class="main-promo">
        <div class="center">
            <p>Наши изделия</p>
            <p>в интерьерах</p>
        </div>
        <div class="center-big">
            <div class="img-cnt">
                <img class="cover" src="/img/img_promo1.jpg" alt="promo1"/>
            </div>
        </div><!--
        --><div class="left">
            <div class="img-cnt">
                <img class="cover" src="/img/img_promo2.jpg" alt="promo2"/>
            </div><!--
            --><div class="img-cnt">
                <img class="cover" src="/img/img_promo3.jpg" alt="promo3"/>
            </div>
        </div><!--
        --><div class="right">
            <div class="img-cnt">
                <img class="cover" src="/img/img_promo4.jpg" alt="promo4"/>
            </div>
        </div>
    </div>
    <div class="main-about">
        <div class="about-img img-cnt">
            <img class="cover" src="/img/img_about.jpg" alt="about"/>
        </div>
        <div class="about-text">
            <p class="header">О компании</p>
            <p>Ассортимент нашего интернет-магазина представляет собой линейку дизайнерских люстр, которая постоянно расширяется и обновляется.
                <br/>Вы можете обставить квартиру или дом, приобретя у нас шкафы, диваны, столы, кресла, стулья, дизайнерский светильник, бра и торшер с настольной лампой в нужном вам стиле, подобрав продукцию по доступным для вас ценам.</p>
            <p><a href="#">Подробнее</a></p>
        </div>
    </div>
</div>

<?php
    include('footer.php');
?>