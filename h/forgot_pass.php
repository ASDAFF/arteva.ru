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
            <h1>Напомнить пароль</h1>
            <div class="forgot-pass-cnt common-form">
                <form action="">
                    <fieldset>
                        <label for="fp-email">E-mail</label>
                        <input type="text" name="fp-email" id="fp-email" data-parsley-required data-parsley-type="email"/>
                        <p class="info">Введите e-mail, указанный при регистрации</p>
                    </fieldset>
                    <fieldset class="form-submit-cnt">
                        <input class="important" type="submit" value="Отправить"/>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    include('footer.php');
?>