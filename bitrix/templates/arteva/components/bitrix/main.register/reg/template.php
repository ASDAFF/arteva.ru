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

		ShowError(implode("<br />", $arResult["ERRORS"]));
	endif;?>
	<div class="register-form-cnt common-form">
	    <form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
			<?if($arResult["BACKURL"] <> ''):?>
				<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
			<?endif?>
	        <div class="row">
	            <div class="col12">
	                <fieldset>
	                    <label for="reg-name">Ваше имя</label>
	                    <input type="text" name="REGISTER[NAME]" id="reg-name" data-parsley-required/>
	                </fieldset>
	                <fieldset>
	                	<label for="reg-pass">Пароль</label>
	                	<input type="text" name="REGISTER[PASSWORD]" id="reg-pass" data-parsley-required/>
	                </fieldset>
	                <fieldset>
	                	<label for="reg-pass2">Повторите пароль</label>
	                	<input type="text" name="REGISTER[CONFIRM_PASSWORD]" id="reg-pass2" data-parsley-required data-parsley-equalto="#reg-pass"/>
	                </fieldset>
	            </div>
	            <div class="col12">
	                <fieldset>
	                    <label for="reg-phone">Телефон</label>
	                    <input type="text" name="REGISTER[PERSONAL_PHONE]" id="reg-phone" data-parsley-required class="js-masked"/>
	                </fieldset>
	                <fieldset>
	                    <label for="reg-email">E-mail</label>
	                    <input type="text" name="REGISTER[LOGIN]" id="reg-email" data-parsley-required data-parsley-type="email"/>
	                </fieldset>
                    <p class="subfield">
                        <input type="checkbox" class="css-checkbox" name="reg-subscribe" id="reg-subscribe"/>
                        <label class="cb-label" for="reg-subscribe">Подписаться на новости</label>
                    </p>
	            </div>
	        </div>
	        <div class="form-submit-cnt">
	            <input type="submit" name="register_submit_button" value="Зарегистрироваться" class="important"/>
	            <span class="info">Все поля обязательны для заполнения</span>
	        </div>
	    </form>
	</div>
<?endif?>