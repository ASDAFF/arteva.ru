<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)die();?>
<?if ($arResult["strProfileError"]):?>
    <?ShowError($arResult["strProfileError"]);?>
<?elseif ($_REQUEST["LOGIN"] && $_REQUEST["EMAIL"] && !$arResult["strProfileError"]):?>
    <p class="lk-success-message">Ваши данные обновлены.</p>
<?endif?>

<div class="common-form" style="min-height:600px;">
    <form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
    	<?=$arResult["BX_SESSION_CHECK"]?>
		<input type="hidden" name="lang" value="<?=LANG?>" />
		<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
		<input type="hidden" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>" id="lk-login">
		<?/* <input type="hidden" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>"> */?>
        <fieldset>
            <label for="lk-name">Ваше имя</label>
            <input type="text" name="NAME" id="lk-name" data-parsley-required value="<?=$arResult["arUser"]["NAME"]?>"/>
        </fieldset>
		<fieldset>
            <label for="lk-mail">E-mail (Логин)</label>
			<input type="text" name="EMAIL" id="lk-mail" data-parsley-required value="<?=$arResult["arUser"]["EMAIL"]?>"/>
        </fieldset>
        <fieldset>
            <label for="lk-phone">Телефон</label>
            <input type="text" name="PERSONAL_PHONE" id="lk-phone" data-parsley-required class="js-masked" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>"/>
        </fieldset>
        <fieldset>
            <label for="lk-address">Адрес</label>
            <textarea name="PERSONAL_STREET" id="lk-address"><?=$arResult["arUser"]["PERSONAL_STREET"]?></textarea>
        </fieldset>
        <fieldset class="form-submit-cnt">
        	<input type="submit" name="save" class="small-btn" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">
        </fieldset>
    </form>
</div>