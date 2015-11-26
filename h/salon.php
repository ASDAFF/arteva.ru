<?php
$bodyprefix = '';
$curprefix = '';
    include('header.php');
?>

<div class="outer-content-wrapper nop salon-page">
    <div class="salon-slider-cnt">
        <ul class="salon-slider">
            <li class="slide">
                <a href="/img/img_salon.jpg" class="js-fbx-image" rel="gallery1"><img class="bgc-image" src="/img/img_salon.jpg" alt="salon"/></a>
            </li>
            <li class="slide">
                <a href="/img/img_salon2.jpg" class="js-fbx-image" rel="gallery1"><img class="bgc-image" src="/img/img_salon2.jpg" alt="salon"/></a>
            </li>
            <li class="slide">
                <a href="/img/img_salon.jpg" class="js-fbx-image" rel="gallery1"><img class="bgc-image" src="/img/img_salon.jpg" alt="salon"/></a>
            </li>
        </ul>
        <div class="salon-slider-pager">
            <a data-slide-index="0" href="#"><img src="/img/img_salon.jpg" /></a><!--
            --><a data-slide-index="1" href="#"><img src="/img/img_salon2.jpg" /></a><!--
            --><a data-slide-index="2" href="#"><img src="/img/img_salon.jpg" /></a>
        </div>
    </div>
    <div class="nav-container">
        <ul class="breadcrumbs">
            <li class="bc-item"><a href="/">Главная</a></li>
            <li class="bc-item"><a href="#">Купить в салоне</a></li>
            <li class="bc-item"><a>Салон</a></li>
        </ul>
        <h1>Нахимовский</h1>
    </div>
    <div class="salon-contact-info-cnt">
        <aside>
            Контактная информация
        </aside>
        <div class="salon-contact-info">
            <div class="row">
                <div class="info-block">
                    <p class="header">Адрес</p>
                    <p class="block-info">Москва, Нахимовский проспект, д. 24, ТВК «Строй-Сити», 1 этаж, павильон К1 </p>
                </div>
                <div class="info-block">
                    <p class="header">Телефоны</p>
                    <p class="block-info">8 (800) 775-40-48 <br/>
                        8 (495) 662-91-45 <span>бесплатный</span> </p>
                </div>
            </div>
            <div class="row">
                <div class="info-block">
                    <p class="header">Режим работы </p>
                    <p class="block-info">с 10.00 до 20.00 <span>без выходных</span> </p>
                </div>
            </div>
        </div>
    </div>
    <div class="howto-find-wrapper">
        <p class="find-header">Как нас найти</p>
        <aside>
            <div class="salon-route-cnt">
                <img src="/img/map.gif" alt=""/>
            </div>
        </aside>
        <div class="salon-route-info">
            <p>Входите в ТВК «Строй-Сити» в крайний левый вход, проходите прямо примерно 30 метров и справа от Вас будет угловой двухуровневый открытый павильон. Вы на месте.</p>
            <p class="small">Вы сможете посмотреть вживую светильники, мебель и аксессуары, получить консультации, выбрать товар, оформить и оплатить заказ, а также заказать доставку.<br/>
                При оформлении заказа назовите кодовое слово <strong>«Артева Хоум»</strong> и получите дополнительную скидку 10%. <br/>
                Также Вы можете сделать заказ on-line или по телефону, заказать доставку по городу, за МКАД и в любой регион России. </p>
            <p><a class="btn important js-show-on-map" href="#map">Показать на карте</a></p>
            <div class="fbx-content" id="map" data-lat="55.67202539" data-long="37.58390542"></div>
        </div>
    </div>
</div>

<?php
    include('footer.php');
?>