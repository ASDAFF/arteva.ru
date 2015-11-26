<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!$USER->isAuthorized()):?>
	<?
		ShowMessage($arParams["~AUTH_RESULT"]);
		ShowMessage($arResult['ERROR_MESSAGE']);
	?>
    <form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
        <?if($arResult["BACKURL"] <> ''):?>
            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?endif?>
        <?foreach ($arResult["POST"] as $key => $value):?>
            <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
        <?endforeach?>
        <input type="hidden" name="AUTH_FORM" value="Y" />
        <input type="hidden" name="TYPE" value="AUTH" />
        <fieldset>
            <label for="auth-email">E-mail</label>
            <input type="text" data-parsley-required data-parsley-type="email" name="USER_LOGIN" id="auth-email" value="<?=$arResult["USER_LOGIN"]?>" />
        </fieldset>
        <fieldset>
            <label for="auth-pass">Пароль</label>
            <input type="password" name="USER_PASSWORD" id="auth-pass" data-parsley-required/>
        </fieldset>
        <fieldset class="auth-submit-cnt">
            <input type="submit" name="Login" value="Войти"/>
            <a class="forgot-pass" href="/forgot-password/">Забыли пароль?</a>
        </fieldset>
    </form>
<?endif?>