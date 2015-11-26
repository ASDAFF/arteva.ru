<?php
$bodyprefix = '';
$curprefix = '';
    include('header.php');
?>

<div class="salons-slider-cnt swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img class="cover" src="/img/img_salons_slide1.jpg" alt="slide1"/>
        </div>
        <div class="swiper-slide">
            <img class="cover" src="/img/img_salons_slide2.jpg" alt="slide1"/>
        </div>
        <div class="swiper-slide">
            <img class="cover" src="/img/img_salons_slide3.jpg" alt="slide1"/>
        </div>
    </div>
    <div class="swiper-controls">
        <a class="next" href="#"></a>
        <a class="prev" href="#"></a>
    </div>
</div>

<div class="outer-content-wrapper nopb">
    <div class="content-wrapper">
        <ul class="breadcrumbs">
            <li class="bc-item"><a href="/">Главная</a></li>
            <li class="bc-item"><a>Купить в салоне</a></li>
        </ul>
        <h1>Купить в салоне</h1>
        <div class="buy-salons-list-cnt">
            <ul class="buy-salons-list">
                <li>
                    <a href="#">
                        <div class="img-cnt"><img class="cover" src="/img/img_salon_preview1.jpg" alt="img"/></div>
                        <div class="salon-descr">
                            <p class="name">Нахимовский</p>

                            <p class="location">в торгово-выставочном комплексе «Строй-Сити»</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="img-cnt"><img class="cover" src="/img/img_salon_preview2.jpg" alt="img"/></div>
                        <div class="salon-descr">
                            <p class="name">Нахимовский</p>

                            <p class="location">в торгово-выставочном комплексе «Строй-Сити»</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="img-cnt"><img class="cover" src="/img/img_salon_preview3.jpg" alt="img"/></div>
                        <div class="salon-descr">
                            <p class="name">Нахимовский</p>

                            <p class="location">в торгово-выставочном комплексе «Строй-Сити»</p>
                        </div>
                    </a>
                </li>
            </ul>
            <ul class="buy-salons-list">
                <li>
                    <a href="#">
                        <div class="img-cnt"><img class="cover" src="/img/img_salon_preview4.jpg" alt="img"/></div>
                        <div class="salon-descr">
                            <p class="name">Нахимовский</p>

                            <p class="location">в торгово-выставочном комплексе «Строй-Сити»</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="img-cnt"><img class="cover" src="/img/img_salon_preview5.jpg" alt="img"/></div>
                        <div class="salon-descr">
                            <p class="name">Нахимовский</p>

                            <p class="location">в торгово-выставочном комплексе «Строй-Сити»</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php
    include('footer.php');
?>