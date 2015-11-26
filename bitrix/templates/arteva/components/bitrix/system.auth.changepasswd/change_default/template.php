<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
ShowMessage($arParams["~AUTH_RESULT"]);
$viewInput = true;
?>
<?if (!$_GET["USER_CHECKWORD"] || !$_GET["change_password"] || !$_GET["USER_LOGIN"]) LocalRedirect("/");?>
<?if ($APPLICATION->arAuthResult["TYPE"] == "ERROR" && !$APPLICATION->arAuthResult["ERROR_TYPE"]):?>
	<p class="lk-error-message"><?=$APPLICATION->arAuthResult["MESSAGE"]?></p>
<?elseif ($APPLICATION->arAuthResult["TYPE"] == "OK"):?>
    <?
        $viewInput = false;
    ?>
	<p class="lk-success-message"><?=$APPLICATION->arAuthResult["MESSAGE"]?></p>
<?endif?>
<?if ($viewInput === true):?>
    <form method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform">
    	<?if (strlen($arResult["BACKURL"]) > 0): ?>
    	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
    	<? endif ?>
    	<input type="hidden" name="AUTH_FORM" value="Y">
    	<input type="hidden" name="TYPE" value="CHANGE_PWD">

    	<input type="hidden" name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>" />
    	<input type="hidden" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" />
        <fieldset>
            <label for="lk-new-pass">Новый пароль</label>
            <input type="password" name="USER_PASSWORD" id="lk-new-pass" data-parsley-required />
        </fieldset>
        <fieldset>
            <label for="lk-new-pass2">Подтверждение</label>
            <input type="password" name="USER_CONFIRM_PASSWORD" id="lk-new-pass2" data-parsley-required data-parsley-equalto="#lk-new-pass"/>
        </fieldset>
        <fieldset class="form-submit-cnt">
            <input type="submit" class="btn important" name="change_pwd" value="<?=GetMessage("AUTH_CHANGE")?>" />
        </fieldset>
    </form>
<?endif?>