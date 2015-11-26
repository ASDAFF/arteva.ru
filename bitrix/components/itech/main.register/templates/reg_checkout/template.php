<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if($USER->IsAuthorized()):?>
	<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>
<?else:?>
	<?if (count($arResult["ERRORS"]) > 0):
		foreach ($arResult["ERRORS"] as $key => $error)
			if (intval($key) == 0 && $key !== 0) 
				$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);
        //echo "<pre>";print_r($arResult["ERRORS"]);echo "</pre>";
		//ShowError(implode("<br />", $arResult["ERRORS"]));
        echo '<p class="lk-error-message">'.implode("<br/>", $arResult["ERRORS"]);
	endif;?>
    <form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data" class="<?if (count($arResult["ERRORS"]) > 0):?>error-reg-form<?endif?>">
		<?if($arResult["BACKURL"] <> ''):?>
			<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?endif?>
		<div class="row">
            <div class="col12">
                <fieldset>
                    <label for="register-name">Ваше имя</label>
                    <input type="text" name="REGISTER[NAME]" id="register-name" data-parsley-required/>
                </fieldset>
                <fieldset>
                    <label for="register-phone">Ваш телефон</label>
                    <input type="text" name="REGISTER[PERSONAL_PHONE]" id="register-phone" data-parsley-required class="js-masked"/>
                </fieldset>
            </div>
            <div class="col12">
                <fieldset>
                    <label for="register-email">E-mail</label>
                    <input type="text" name="REGISTER[LOGIN]" id="register-email" data-parsley-required data-parsley-type="email"/>
                    <p class="meta">На e-mail будет отправлено письмо c регистрационными данными.</p>
                </fieldset>
            </div>
        </div>
        <input type="hidden" name="REGISTER[PASSWORD]"/>
        <input type="hidden" name="REGISTER[CONFIRM_PASSWORD]"/>
        <input type="hidden" name="REGISTER[CHECKOUT]" value="Y" />
        <fieldset class="register-submit-cnt">
            <input type="submit" name="register_submit_button" class="important" value="Выбрать способ доставки и оплаты"/>
        </fieldset>
    </form>
<?endif?>