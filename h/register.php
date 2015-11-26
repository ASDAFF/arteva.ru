<?php
$bodyprefix = '';
$curprefix = '';
    include('header.php');
?>

<div class="outer-content-wrapper">
    <div class="content-wrapper">
        <ul class="breadcrumbs">
            <li class="bc-item"><a href="/">Главная</a></li>
            <li class="bc-item"><a>Регистрация</a></li>
        </ul>
        <div class="text-content">
            <h1>Регистрация</h1>
            <div class="register-form-cnt common-form">
                <form action="">
                    <div class="row">
                        <div class="col12">
                            <fieldset>
                                <label for="reg-name">Ваше имя</label><input type="text" name="reg-name" id="reg-name" data-parsley-required/>
                            </fieldset>
                            <fieldset><label for="reg-pass">Пароль</label><input type="text" name="reg-pass" id="reg-pass" data-parsley-required/>
                            </fieldset>
                            <fieldset><label for="reg-pass2">Повторите пароль</label><input type="text" name="reg-pass2" id="reg-pass2" data-parsley-required data-parsley-equalto="#reg-pass"/>
                            </fieldset>
                        </div>
                        <div class="col12">
                            <fieldset>
                                <label for="reg-phone">Телефон</label><input type="text" name="reg-phone" id="reg-phone" data-parsley-required class="js-masked"/>
                            </fieldset>
                            <fieldset>
                                <label for="reg-email">E-mail</label><input type="text" name="reg-email" id="reg-email" data-parsley-required data-parsley-type="email"/>
                            </fieldset>
                            <fieldset class="subfield">
                                <input type="checkbox" class="css-checkbox" name="reg-subscribe" id="reg-subscribe"/><label class="cb-label" for="reg-subscribe">Подписаться на новости</label>
                            </fieldset>
                        </div>
                    </div>
                    <div class="form-submit-cnt">
                        <input type="submit" value="Зарегистрироваться" class="important"/><span class="info">Все поля обязательны для заполнения</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    include('footer.php');
?>