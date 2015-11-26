<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
ShowMessage($arParams["~AUTH_RESULT"]);
$viewInput = true;
?>
<div class="forgot-pass-cnt common-form">
    <?if ($APPLICATION->arAuthResult):?>
    	<?if ($APPLICATION->arAuthResult["TYPE"] == "ERROR"):?>
    		<p class="lk-error-message">Пользователя с таким Email не существует</p>
    	<?elseif ($APPLICATION->arAuthResult["TYPE"] == "OK"):?>
            <?
                $viewInput = false;
            ?>
    		<p class="lk-success-message"><?=$APPLICATION->arAuthResult["MESSAGE"]?></p>
    	<?endif?>
    <?endif?>
    <?if ($viewInput === true):?>
        <form name="bform" method="post" action="/forgot-password/">
        	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        	<input type="hidden" name="AUTH_FORM" value="Y">
    		<input type="hidden" name="TYPE" value="SEND_PWD">
            <fieldset>
                <label for="fp-email">E-mail</label>
                <input type="text" name="USER_EMAIL" id="fp-email" data-parsley-required data-parsley-type="email"/>
                <p class="info">Введите e-mail, указанный при регистрации</p>
            </fieldset>
            <fieldset class="form-submit-cnt">
                <input class="important" type="submit" name="send_account_info" value="Отправить"/>
            </fieldset>
        </form>
    <?endif?>
</div>