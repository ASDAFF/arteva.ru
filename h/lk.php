<?php
$bodyprefix = '';
$curprefix = '';
    include('header.php');
?>

<div class="outer-content-wrapper lk-page">
    <div class="content-wrapper">
        <a class="lk-sidebar-trigger js-lk-side-trigger mobile" href="#">Личный кабинет</a>
        <aside class="lk-sidebar">
            <div class="sb-menu-category">
                <p class="header">Личная информация</p>
                <ul class="sb-menu">
                    <li class="sb-menu-item"><a href="#">Изменить личную информацию</a></li>
                    <li class="sb-menu-item"><a href="#">Изменить пароль</a></li>
                </ul>
            </div>
            <div class="sb-menu-category">
                <p class="header">Заказы и товары</p>
                <ul class="sb-menu">
                    <li class="sb-menu-item"><a href="#">Моя корзина</a></li>
                    <li class="sb-menu-item"><a href="#">Мои заказы</a></li>
                    <li class="sb-menu-item"><a href="#">Мое избранное</a></li>
                    <li class="sb-menu-item"><a href="#">Помощь</a></li>
                </ul>
            </div>
            <p class="news-feed-header">Новостная рассылка</p>
            <a class="btn important js-subscribe-trigger" href="#">Подписаться</a>
        </aside>
        <div class="lk-inner">
            <ul class="breadcrumbs">
                <li class="bc-item"><a href="/">Главная</a></li>
            </ul>
            <h1>Личный кабинет</h1>
            <div class="lk-section lk-section-main">
                <div class="lk-content">
                    <div class="lk-orders">
                        <p class="header">Мой последний заказ</p>
                        <p class="last-order-info">85-Аф тетрк<span>03.07.2014 16:45</span></p>
                        <div class="last-order-params">
                            <div class="lk-toc-row"><span>Стоимость товаров</span><span>50 000 руб.</span></div>
                            <div class="lk-toc-row"><span>Со скидкой</span><span>49 000 руб.</span></div>
                            <div class="lk-toc-row"><span>Стоимость доставки</span><span>бесплатно</span></div>
                            <div class="lk-toc-row"><span>Ваша экономия</span><span>1 000 руб.</span></div>
                            <div class="lk-toc-row"><span><strong>ИТОГО</strong></span><span><strong>49 000 руб.</strong></span></div>
                            <p class="lk-payment-info">Оплата наличными при получении</p>
                        </div>
                        <a class="btn small-btn js-order-contents-trigger" href="#">Состав заказа</a>
                        <div class="lk-order-contents-wrapper">
                            <ul class="checkout-order-list">
                                <li class="checkout-order-item">
                                    <aside>
                                        <div class="img-cnt"><img src="/img/img_item1.jpg" alt="item"/></div>
                                    </aside>
                                    <div class="order-item-info">
                                        <p class="item-num">Артикул C141-1</p>

                                        <p class="item-descr">Дизайнерский потолочный светильник D50 с длинным названием в пару строк</p>

                                        <p>
                                            <span class="item-count">x 15 шт.</span><span class="item-sum">на сумму 18 880 руб.</span>
                                        </p>
                                    </div>
                                </li>
                                <li class="checkout-order-item">
                                    <aside>
                                        <div class="img-cnt"><img src="/img/img_item1.jpg" alt="item"/></div>
                                    </aside>
                                    <div class="order-item-info">
                                        <p class="item-num">Артикул C141-1</p>

                                        <p class="item-descr">Дизайнерский потолочный светильник D50 с длинным названием в пару строк</p>

                                        <p>
                                            <span class="item-count">x 15 шт.</span><span class="item-sum">на сумму 18 880 руб.</span>
                                        </p>
                                    </div>
                                </li>
                                <li class="checkout-order-item">
                                    <aside>
                                        <div class="img-cnt"><img src="/img/img_item1.jpg" alt="item"/></div>
                                    </aside>
                                    <div class="order-item-info">
                                        <p class="item-num">Артикул C141-1</p>

                                        <p class="item-descr">Дизайнерский потолочный светильник D50 с длинным названием в пару строк</p>

                                        <p>
                                            <span class="item-count">x 15 шт.</span><span class="item-sum">на сумму 18 880 руб.</span>
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="lk-cart-side">
                        <div class="lk-cart-side-wrapper">
                            <p class="header">Моя корзина</p>
                            <div class="lk-toc-row"><span>Товаров</span><span>3</span></div>
                            <div class="lk-toc-row"><span>На общую сумму</span><span>50 000 руб.</span></div>
                            <a class="btn small-btn important" href="#">Перейти в корзину</a>
                        </div>
                    </div>
                </div>
                <div class="text-content">
                    <p class="section-header">Ваши избранные товары</p>

                    <div class="cart-cnt">
                        <div class="cart-header">
                            <div class="cart-row">
                                <div class="cell header-cell cell-img">&nbsp;</div>
                                <div class="cell header-cell cell-descr">Описание</div>
                                <div class="cell header-cell cell-count">Количество</div>
                                <div class="cell header-cell cell-price">Цена</div>
                                <div class="cell header-cell cell-to-cart">В корзину</div>
                                <div class="cell header-cell cell-to-spec">В спецификацию</div>
                            </div>
                        </div>
                        <div class="cart-body">
                            <div class="cart-row">
                                <div class="cell body-cell cell-img">
                                    <div class="img-cnt"><img src="/img/img_item3.jpg" alt="item image"/></div>
                                </div>

                                <div class="cells-cnt">
                                    <div class="cell body-cell cell-descr">
                                        <p class="num">Артикул 37315</p>

                                        <p>Дизайнерская подвесная собака</p>
                                    </div>
                                    <div class="cell body-cell cell-count">
                                        <div class="cart-item-count">
                                            <a class="item-dec js-dec" href="#">–</a><input class="item-count js-item-count" value="1" type="text" name="item1-count" id="item1-count"/><a class="item-inc js-inc" href="#">+</a>
                                        </div>
                                    </div>
                                    <div class="cell body-cell cell-price">
                                        <p>18 880 руб.</p>

                                        <p class="item-old-price">25 880 руб.</p>
                                    </div>
                                    <div class="tocart-cnt">
                                        <div class="cell body-cell cell-to-cart">
                                            <a class="js-add-to-cart" href="#"><i class="icon icon-cart"></i><span>В корзину</span></a>
                                        </div>
                                        <div class="cell body-cell cell-to-spec">
                                            <a class="js-add-to-spec" href="#"><i class="icon icon-spec"></i><span>В спецификацию</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-row">
                                <div class="cell body-cell cell-img">
                                    <div class="img-cnt"><img src="/img/img_item3.jpg" alt="item image"/></div>
                                </div>
                                <div class="cells-cnt">
                                    <div class="cell body-cell cell-descr">
                                        <p class="num">Артикул 37315</p>

                                        <p>Дизайнерская подвесная собака</p>
                                    </div>
                                    <div class="cell body-cell cell-count">
                                        <div class="cart-item-count">
                                            <a class="item-dec js-dec" href="#">–</a><input class="item-count js-item-count" value="1" type="text" name="item1-count" id="item1-count"/><a class="item-inc js-inc" href="#">+</a>
                                        </div>
                                    </div>
                                    <div class="cell body-cell cell-price">
                                        <p>18 880 руб.</p>

                                        <p class="item-old-price">25 880 руб.</p>
                                    </div>
                                    <div class="tocart-cnt">
                                        <div class="cell body-cell cell-to-cart">
                                            <a class="js-add-to-cart" href="#"><i class="icon icon-cart"></i><span>В корзину</span></a>
                                        </div>
                                        <div class="cell body-cell cell-to-spec">
                                            <a class="js-add-to-spec" href="#"><i class="icon icon-spec"></i><span>В спецификацию</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include('footer.php');
?>