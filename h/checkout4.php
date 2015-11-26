<?php
$bodyprefix = '';
$curprefix = '';
include('header.php');
?>

    <div class="outer-content-wrapper">
        <div class="content-wrapper">
            <ul class="breadcrumbs">
                <li class="bc-item"><a href="/">Главная</a></li>
                <li class="bc-item"><a>Оформление заказа</a></li>
            </ul>
            <h1>Оформление заказа</h1>
            <div class="checkout-success">
                <p class="header">Ваш заказ успешно оформлен!</p>
                <div class="row">
                    <div class="col">
                        <p class="order-num"><span>Номер вашего заказа</span><span>238-va defss</span></p>
                        <p class="order-meta">На указанный Вами e-mail отправлено письмо с параметрами заказа.</p>
                        <a class="btn important" href="#">Распечатать заказ</a>
                    </div>
                    <div class="col">
                        <p>Также мы отправили Вам письмо с данными регистрации. Письмо содержит автоматически сгенерированный пароль. Рекомендуем Вам сразу изменить пароль в своем <a href="#">Личном кабинете</a>.
                            <br/><br/>
                            В Вашем <a href="#">Личном кабинете</a> содержатся сведения обо всех Ваших заказах и регистрационные данные.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="outer-content-wrapper item-cross">
        <div class="content-wrapper">
            <p class="section-header">Ваc также может заинтересовать</p>

            <div class="item-cards-list-cnt">
                <ul class="item-cards-list js-item-cards-slider">
                    <li class="item-card-item">
                        <a href="#">
                            <div class="img-cnt"><img src="/img/img_item1.jpg" alt=""/></div>
                            <div class="item-info">
                                <p class="item-brand">LA MARINA</p>

                                <p class="item-desc">Светильник подвесной</p>

                                <p class="item-price"><span>48 700</span> руб.</p>
                            </div>
                        </a>
                    </li>
                    <li class="item-card-item">
                        <a href="#">
                            <div class="img-cnt"><img src="/img/img_item2.jpg" alt=""/></div>
                            <div class="item-info">
                                <p class="item-brand">ARTEVALUCE</p>

                                <p class="item-desc">Часы</p>

                                <p class="item-price"><span>9 500</span> руб.</p>
                            </div>
                        </a>
                    </li>
                    <li class="item-card-item">
                        <a href="#">
                            <div class="img-cnt"><img src="/img/img_item3.jpg" alt=""/></div>
                            <div class="item-info">
                                <p class="item-brand">EICHHOLTZ</p>

                                <p class="item-desc">Лампа настольная</p>

                                <p class="item-price"><span>25 000</span> руб.</p>
                            </div>
                        </a>
                    </li>
                    <li class="item-card-item">
                        <a href="#">
                            <div class="img-cnt"><img src="/img/img_item4.jpg" alt=""/></div>
                            <div class="item-info">
                                <p class="item-brand">DEVONSHIRE</p>

                                <p class="item-desc">Стул</p>

                                <p class="item-price"><span>25 500</span> руб.</p>
                            </div>
                        </a>
                    </li>
                    <li class="item-card-item">
                        <a href="#">
                            <div class="img-cnt"><img src="/img/img_item1.jpg" alt=""/></div>
                            <div class="item-info">
                                <p class="item-brand">LA MARINA</p>

                                <p class="item-desc">Светильник подвесной</p>

                                <p class="item-price"><span>48 700</span> руб.</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="outer-content-wrapper">
        <div class="content-wrapper">
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


<?php
include('footer.php');
?>