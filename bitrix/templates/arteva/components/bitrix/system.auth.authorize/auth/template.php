<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!$USER->isAuthorized()):?>
	<?
		ShowMessage($arParams["~AUTH_RESULT"]);
		ShowMessage($arResult['ERROR_MESSAGE']);
	?>
	<form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
		<?if (strlen($arResult["BACKURL"]) > 0):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?endif?>
		<?foreach ($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
		<?endforeach?>
        <fieldset>
            <label for="auth-email">E-mail</label>
            <input type="text" name="USER_LOGIN" id="auth-email" data-parsley-required data-parsley-type="email"/>
        </fieldset>
        <fieldset>
            <label for="auth-pass">Пароль</label>
            <input type="password" name="USER_PASSWORD" id="auth-pass" data-parsley-required/>
        </fieldset>
        <fieldset>
            <div class="col12">
                <input type="checkbox" class="css-checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" />
                <label class="cb-label" for="USER_REMEMBER">Запомнить меня</label>
            </div>
            <div class="col12 text-content">
                <p class="aright"><a href="/forgot-password/">Забыли пароль?</a></p>
            </div>
        </fieldset>

        <fieldset class="submit-cnt">
            <a class="btn js-fbx-close" href="#">Отменить</a>
            <input type="submit" name="Login" class="btn btn-important" value="<?=GetMessage("AUTH_AUTHORIZE")?>" />
        </fieldset>
        <div class="first-time-msg text-content">
            <p>Впервые у нас?</p>
            <p><a href="/registration/">Зарегистрируйтесь</a>, чтобы иметь возможность пользоваться функциями Личного кабинета</p>
        </div>
    </form>
<?endif?>