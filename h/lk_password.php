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
                    <li class="sb-menu-item"><a href="#">Изменить личную информацию</a></li>
                    <li class="sb-menu-item"><a class="active">Изменить пароль</a></li>
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
            <h1>Изменить пароль</h1>
            <div class="lk-section lk-section-main">
                <div class="lk-content">
                    <div class="lk-inner-content">
                        <div class="common-form">
                            <form action="">
                                <fieldset>
                                    <label for="lk-old-pass">Старый пароль</label>
                                    <input type="text" name="lk-old-pass" id="lk-old-pass" data-parsley-required/>
                                </fieldset>
                                <fieldset>
                                    <label for="lk-new-pass">Новый пароль</label>
                                    <input type="text" name="lk-new-pass" id="lk-new-pass" data-parsley-required />
                                </fieldset>
                                <fieldset>
                                    <label for="lk-new-pass2">Подтверждение</label>
                                    <input type="text" name="lk-new-pass2" id="lk-new-pass2" data-parsley-required data-parsley-equalto="#lk-new-pass"/>
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