<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult["ITEMS"]):?>
	<?if ($arResult["ITEMS"][0]["~PREVIEW_PICTURE"]):?>
		<img src="<?=CFile::GetPath($arResult["ITEMS"][0]["~PREVIEW_PICTURE"])?>" alt=""/>
	<?endif?>
	<?=$arResult["ITEMS"][0]["~DETAIL_TEXT"]?>
<?endif?>