<?php
$bodyprefix = '';
$curprefix = '';
    include('header.php');
?>

<div class="outer-content-wrapper">
    <div class="content-wrapper">
        <ul class="breadcrumbs">
            <li class="bc-item"><a href="/">Главная</a></li>
            <li class="bc-item"><a href="#">Личный кабинет</a></li>
        </ul>
        <h1>Избранные товары</h1>
        <div class="item-cards-list-cnt wishlist">
            <ul class="item-cards-list actionable matrix">
                <li class="item-card-item" data-id="1">
                    <a href="#">
                        <div class="img-cnt"><img src="/img/img_item1.jpg" alt=""/></div>
                        <div class="item-info">
                            <p class="item-brand">LA MARINA</p>
                            <p class="item-desc">Светильник подвесной</p>
                            <p class="item-price"><span>48 700</span> руб.</p>
                        </div>
                    </a>
                    <div class="item-actions">
                        <a class="fleft btn small-btn important js-wishlist-add-item" href="#">В корзину</a><a class="fright mr10 inline fancy-popup" href="#add-to-spec-form">В спецификацию</a>
                    </div>
                    <a class="item-remove js-wishlist-item-remove" href="#"></a>
                </li>
                <li class="item-card-item" data-id="2">
                    <a href="#">
                        <div class="img-cnt"><img src="/img/img_item2.jpg" alt=""/></div>
                        <div class="item-info">
                            <p class="item-brand">ARTEVALUCE</p>
                            <p class="item-desc">Часы</p>
                            <p class="item-price"><span>9 500</span> руб.</p>
                        </div>
                    </a>
                    <div class="item-actions">
                        <a class="fleft btn small-btn important js-wishlist-add-item" href="#">В корзину</a><a class="fright mr10 inline fancy-popup" href="#add-to-spec-form">В спецификацию</a>
                    </div>
                    <a class="item-remove js-wishlist-item-remove" href="#"></a>
                </li>
                <li class="item-card-item" data-id="3">
                    <a href="#">
                        <div class="img-cnt"><img src="/img/img_item3.jpg" alt=""/></div>
                        <div class="item-info">
                            <p class="item-brand">EICHHOLTZ</p>
                            <p class="item-desc">Лампа настольная</p>
                            <p class="item-price"><span>25 000</span> руб.</p>
                        </div>
                    </a>
                    <div class="item-actions">
                        <a class="fleft btn small-btn important js-wishlist-add-item" href="#">В корзину</a><a class="fright mr10 inline fancy-popup" href="#add-to-spec-form">В спецификацию</a>
                    </div>
                    <a class="item-remove js-wishlist-item-remove" href="#"></a>
                </li>
                <li class="item-card-item" data-id="4">
                    <a href="#">
                        <div class="img-cnt"><img src="/img/img_item4.jpg" alt=""/></div>
                        <div class="item-info">
                            <p class="item-brand">DEVONSHIRE</p>
                            <p class="item-desc">Стул</p>
                            <p class="item-price"><span>25 500</span> руб.</p>
                        </div>
                    </a>
                    <div class="item-actions">
                        <a class="fleft btn small-btn important js-wishlist-add-item" href="#">В корзину</a><a class="fright mr10 inline fancy-popup" href="#add-to-spec-form">В спецификацию</a>
                    </div>
                    <a class="item-remove js-wishlist-item-remove" href="#"></a>
                </li>
                <li class="item-card-item" data-id="5">
                    <a href="#">
                        <div class="img-cnt"><img src="/img/img_item1.jpg" alt=""/></div>
                        <div class="item-info">
                            <p class="item-brand">LA MARINA</p>
                            <p class="item-desc">Светильник подвесной</p>
                            <p class="item-price"><span>48 700</span> руб.</p>
                        </div>
                    </a>
                    <div class="item-actions">
                        <a class="fleft btn small-btn important js-wishlist-add-item" href="#">В корзину</a><a class="fright mr10 inline fancy-popup" href="#add-to-spec-form">В спецификацию</a>
                    </div>
                    <a class="item-remove js-wishlist-item-remove" href="#"></a>
                </li>
            </ul>
        </div>

    </div>
</div>

<?php
    include('footer.php');
?>