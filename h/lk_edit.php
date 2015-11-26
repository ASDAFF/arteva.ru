<?php
$bodyprefix = '';
$curprefix = '';
    include('header.php');
?>

<div class="outer-content-wrapper lk-page">
    <div class="content-wrapper">
        <aside class="lk-sidebar">
            <div class="sb-menu-category">
                <p class="header">Личная информация</p>
                <ul class="sb-menu">
                    <li class="sb-menu-item"><a class="active">Изменить личную информацию</a></li>
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
                <li class="bc-item"><a>Личный кабинет</a></li>
            </ul>
            <h1>Изменить личную информацию</h1>
            <div class="lk-section lk-section-main">
                <div class="lk-content">
                    <div class="lk-inner-content">
                        <div class="common-form">
                            <form action="">
                                <fieldset>
                                    <label for="lk-name">Ваше имя</label>
                                    <input type="text" name="lk-name" id="lk-name" data-parsley-required/>
                                </fieldset>
                                <fieldset>
                                    <label for="lk-phone">Телефон</label>
                                    <input type="text" name="lk-phone" id="lk-phone" data-parsley-required class="js-masked" />
                                </fieldset>
                                <p class="header">Адрес доставки</p>
                                <fieldset>
                                    <label for="lk-city">Город</label>
                                    <select class="js-common-select mobile-hide" name="lk-city" id="lk-city" data-placeholder="Начните вводить название">
                                        <option value=""></option>
                                        <option value="1">Москва</option>
                                        <option value="2">Ульяновск</option>
                                        <option value="3">Краснодар</option>
                                    </select>
                                    <div class="mobile mobile-select-cnt">
                                        <select class="mobile" name="lk-city" id="lk-city-mobile">
                                            <option value="1">Москва</option>
                                            <option value="2">Ульяновск</option>
                                            <option value="3">Краснодар</option>
                                        </select>
                                        <i class="mobile-select-arrow"></i>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <label for="lk-address">Адрес</label><textarea name="lk-address" id="lk-address"></textarea>
                                </fieldset>
                                <fieldset class="form-submit-cnt">
                                    <input type="submit" class="small-btn" value="Сохранить"/>
                                </fieldset>
                            </form>
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
            </div>
        </div>
    </div>
</div>

<?php
    include('footer.php');
?>