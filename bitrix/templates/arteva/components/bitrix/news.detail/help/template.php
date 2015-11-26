<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult["~PREVIEW_PICTURE"]):?>
	<img src="<?=CFile::GetPath($arResult["~PREVIEW_PICTURE"])?>" alt=""/>
<?endif?>
<?=$arResult["~DETAIL_TEXT"]?>