<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div>
	<?=$arResult["FORM_HEADER"]?>
	<div class="hold-in">
		<p class="label">Ваше имя*</p>
		<input name="form_text_14" placeholder="Имя*" type="text" value="<?=$arResult["arrVALUES"]["form_text_14"] ? $arResult["arrVALUES"]["form_text_14"] : ""?>" />
	</div>
	<div class="hold-in">
		<p class="label">Телефон</p>
		<input class="js-masked" name="form_text_15" type="text" value="<?=$arResult["arrVALUES"]["form_text_15"] ? $arResult["arrVALUES"]["form_text_15"] : ""?>" />
	</div>
	<div class="hold-in">
		<p class="label">E-mail*</p>
		<input name="form_text_16" placeholder="E-mail" type="text" value="<?=$arResult["arrVALUES"]["form_text_16"] ? $arResult["arrVALUES"]["form_text_16"] : ""?>" />
	</div>
	<div class="hold-in">
		<p class="label">Сообщение*</p>
		<textarea name="form_textarea_17" placeholder="Введите текст" value="<?=$arResult["arrVALUES"]["form_textarea_17"] ? $arResult["arrVALUES"]["form_textarea_17"] : ""?>" ></textarea>
	</div>
	<div class='line'></div>
	<div class="hold-in">
		<div class='btn'>
			<input name="web_form_submit" class="Submit" type="submit" value="Отправить">
		</div>
		<p class="header small"><span class="small italic">Поля, отмеченные звездочкой, обязательны для заполнения</span></p>
		<?=$arResult["FORM_NOTE"]?>
		<?if ($arResult["isFormErrors"] == "Y"){?>
			<?=$arResult["FORM_ERRORS_TEXT"];?>
		<?}?>
	</div>
</div>
  
