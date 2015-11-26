<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="swiper-wrapper">
	<?foreach ($arResult["ITEMS"] as $key => $arItems) :?>
	    <div class="swiper-slide">
	        <img class="cover" src="<?=CFile::GetPath($arItems["~PREVIEW_PICTURE"])?>" alt="<?=$arItems["NAME"]?>"/>
	    </div>
	<?endforeach?>
</div>
<div class="swiper-controls">
    <a class="next" href="#"></a>
    <a class="prev" href="#"></a>
</div>