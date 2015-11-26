<?php
$bodyprefix = '';
$curprefix = '';
    include('header.php');
?>

<div class="outer-content-wrapper checkout-page">
    <ul class="breadcrumbs">
        <li class="bc-item"><a href="/">Главная</a></li>
        <li class="bc-item"><a>Оформление заказа</a></li>
    </ul>
    <h1>Оформление заказа</h1>
    <div class="checkout-wrapper">
        <div class="content-wrapper">
            <div class="steps-indicators">
                <div class="step-indicator">
                    <div class="step-num">1</div>
                    <p class="step-name">Шаг первый</p>
                    <p class="step-info">Авторизация/регистрация</p>
                </div>
                <div class="step-indicator">
                    <div class="step-num">2</div>
                    <p class="step-name">Шаг второй</p>
                    <p class="step-info">Выбор способа доставки и оплаты</p>
                </div>
                <div class="step-indicator active">
                    <div class="step-num">3</div>
                    <p class="step-name">Шаг третий</p>
                    <p class="step-info">Подтверждение заказа</p>
                </div>
            </div>
        </div>
        <div class="step-inner">
            <div class="common-form order-confirm">
                <form action="">
                    <div class="col12">
                        <p class="header">Состав заказа</p>
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
                        <p class="header">Параметры заказа</p>
                        <ul class="checkout-order-params">
                            <li class="checkout-param"><span>Стоимость товаров</span><span>50 000 руб.</span></li>
                            <li class="checkout-param"><span>Со скидкой</span><span>49 000 руб.</span></li>
                            <li class="checkout-param">
                                <span>Доставка</span><span>Курьером по Москве — 500 руб.</span></li>
                            <li class="checkout-param">
                                <span>Адрес доставки</span><span>Ленинский прт, д.67, кв 14 и адрес в две строки </span>
                            </li>
                            <li class="checkout-param"><span>Оплата</span><span>Банковской картой</span></li>
                        </ul>
                        <p class="header"><a href="#" class="checkout-confirm-comment js-checkout-confirm-comment-trigger">Ваш комментарий</a></p>
                        <fieldset class="checkout-confirm-comment-cnt">
                            <textarea name="checkout-confirm-comment" id="checkout-confirm-comment"></textarea>
                        </fieldset>
                        <p class="checkout-confirm-comment-info">При оформлении заказа пользователь может оставить комментарий к заказу... "Сдача с 1000", например. Или другую информацию при желании.</p>
                    </div>
                    <div class="col12">
                        <div class="checkout-total-cnt">
                            <p class="checkout-total"><span><strong>К оплате</strong></span><span><strong>49 500</strong> руб.</span></p>
                            <p class="checkout-economy"><span>Ваша экономия</span><span>1 000 руб.</span></p>
                            <fieldset class="checkout-confirm">
                                <input type="submit" value="Подтвердить заказ" class="important"/>
                            </fieldset>
                            <fieldset class="checkout-confirm">
                                <a class="btn" href="#">Изменить способ доставки/оплаты</a>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    include('footer.php');
?>