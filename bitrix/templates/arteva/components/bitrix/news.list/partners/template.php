<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult["ITEMS"]):?>
	<?foreach ($arResult["ITEMS"] as $key => $arItems) :?>
		<? if ($arItems["PREVIEW_TEXT"]) {?>
		<a href="<?=$arItems["PREVIEW_TEXT"]?>" target="_blank" class="partner_link">
			<img src="<?=$arItems["PREVIEW_PICTURE"]["SRC"]?>" class="partner_img">
		</a>
		<?} else {?>
			<img src="<?=$arItems["~PREVIEW_PICTURE"]["SRC"]?>" class="partner_img">
		<?}?>
	<?endforeach?>
<?endif?>

