<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="box-title">
    <?=$arResult["NAME"]?>
</div>

<div class="products-list clearfix">
    <?foreach ($arResult["ITEMS"] as $key => $arItems) :?>
    	<?
            //$waterImage = waterImage($arItems["~PREVIEW_PICTURE"]);
            // $waterImage["src"]
            $waterImage["src"] = CFIle::GetPath($arItems["~PREVIEW_PICTURE"]);
        ?>
        <a href="<?=$arItems["~DETAIL_PAGE_URL"]?>" class="product-item sfx sfx-scale" data-fx="sfx-scale">
            <img style="max-width:175px;max-height:175px;border-radius: 20px;box-shadow: 0px 2px 10px -3px #000;" src="<?=$waterImage["src"]?>" alt="" />
            <div class="product-label">
                <?=$arItems["NAME"]?>
            </div>
        </a>
    <?endforeach?>
</div>