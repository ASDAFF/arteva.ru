<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<ul class="main-slider">
	<?foreach ($arResult["ITEMS"] as $key => $arItems) :?>
    	<li>
    		<a href="<?=$arItems["PROPERTIES"]["LINK"]["VALUE"]?>" class="bg-cover" style="background-image:url('<?=CFile::GetPath($arItems["~PREVIEW_PICTURE"])?>');">
    		</a>
 <?=$arItems["~PREVIEW_TEXT"]?>    	</li>
    <?endforeach?>
</ul>