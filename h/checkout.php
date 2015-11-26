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
                <div class="step-indicator active">
                    <div class="step-num">1</div>
                    <p class="step-name">Шаг первый</p>
                    <p class="step-info">Авторизация/регистрация</p>
                </div>
                <div class="step-indicator">
                    <div class="step-num">2</div>
                    <p class="step-name">Шаг второй</p>
                    <p class="step-info">Выбор способа доставки и оплаты</p>
                </div>
                <div class="step-indicator">
                    <div class="step-num">3</div>
                    <p class="step-name">Шаг третий</p>
                    <p class="step-info">Подтверждение заказа</p>
                </div>
            </div>
        </div>
        <div class="step-inner">
            <div class="auth-slider">
                <div class="auth-regular">
                    <div class="col12">
                        <p class="header"><strong>Уже покупали</strong> у нас?</p>
                        <p class="info">Авторизуйтесь, чтобы мы могли Вас узнать</p>
                        <div class="common-form">
                            <form action="">
                                <fieldset>
                                    <label for="auth-email">E-mail</label>
                                    <input type="text" data-parsley-required data-parsley-type="email" name="auth-email" id="auth-email"/>
                                </fieldset>
                                <fieldset>
                                    <label for="auth-pass">Пароль</label>
                                    <input type="text" name="auth-pass" id="auth-pass" data-parsley-required/>
                                </fieldset>
                                <fieldset class="auth-submit-cnt">
                                    <input type="submit" value="Войти"/><a class="forgot-pass" href="#">Забыли пароль?</a>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <div class="col12">
                        <p class="header"><strong>Впервые</strong> в нашем магазине?</p>
                        <p class="info">Создав аккаунт Вы сможете отслеживать свои заказы в Личном кабинете</p>
                        <a class="btn important js-auth-switch" data-rel="auth-first-time" href="#">Я покупаю впервые</a>
                    </div>
                </div>
                <div class="auth-first-time">
                    <p class="header">Введите e-mail и контактную информацию</p>
                    <p class="info">Создайте аккаунт или <a href="#" class="js-auth-switch" data-rel="auth-regular">войдите</a> чтобы продолжить покупки</p>
                    <div class="common-form">
                        <form action="">
                            <div class="row">
                                <div class="col12">
                                    <fieldset>
                                        <label for="register-name">Ваше имя</label><input type="text" name="register-name" id="register-name" data-parsley-required/>
                                    </fieldset>
                                    <fieldset>
                                        <label for="register-phone">Ваш телефон</label><input type="text" name="register-phone" id="register-phone" data-parsley-required class="js-masked" placeholder="+7 927 456-45-78"/>
                                    </fieldset>
                                </div>
                                <div class="col12">
                                    <fieldset>
                                        <label for="register-email">E-mail</label><input type="text" name="register-email" id="register-email" data-parsley-required data-parsley-type="email"/>
                                        <p class="meta">На e-mail будет отправлен пароль для авторизации</p>
                                    </fieldset>
                                </div>
                            </div>
                            <fieldset class="register-submit-cnt">
                                <input type="submit" class="important" value="Выбрать способ доставки и оплаты"/>
                            </fieldset>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
    include('footer.php');
?>