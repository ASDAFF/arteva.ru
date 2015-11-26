<?php
$bodyprefix = '';
$curprefix = '';
    include('header.php');
?>

<div class="outer-content-wrapper">
    <div class="content-wrapper">
        <ul class="breadcrumbs">
            <li class="bc-item"><a href="/">Главная</a></li>
            <li class="bc-item"><a>Корзина</a></li>
        </ul>
        <div class="text-content">
            <h1>Корзина</h1>
            <div class="cart-cnt">
                <a class="cart-print-link js-print" href="#">Распечатать</a>
                <div class="cart-header">
                    <div class="cart-row">
                        <div class="cell header-cell cell-img">&nbsp;</div>
                        <div class="cell header-cell cell-descr">Описание</div>
                        <div class="cell header-cell cell-color">Цвет</div>
                        <div class="cell header-cell cell-count">Количество</div>
                        <div class="cell header-cell cell-price">Цена</div>
                        <div class="cell header-cell cell-remove">Удалить</div>
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
                            <div class="cell body-cell cell-color">
                                <p>Коричневый</p>
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
                            <div class="cell body-cell cell-remove"><a class="remove-item js-item-remove" href="#"></a></div>
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
                            <div class="cell body-cell cell-color">
                                <p>Коричневый</p>
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
                            <div class="cell body-cell cell-remove">
                                <a class="remove-item js-item-remove" href="#"></a>
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
                            <div class="cell body-cell cell-color">
                                <p>Коричневый</p>
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
                            <div class="cell body-cell cell-remove"><a class="remove-item js-item-remove" href="#"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cart-footer">
                    <div class="summary-cnt">
                        <p>Стоимость товаров<span><em class="js-cart-sum">150 000</em> руб.</span></p>
                        <p>Скидка на заказ <span><em class="js-cart-discount">2 500</em> руб</span></p>
                        <p class="cart-total">Итого <span><em class="js-cart-discount-sum">147 500</em> руб</span></p>
                    </div>
                </div>
            </div>
            <div class="cart-submit-cnt">
                <a class="btn important" href="#">Оформить заказ</a>
            </div>
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