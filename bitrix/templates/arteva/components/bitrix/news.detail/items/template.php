<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p class="details-title">
    <?=$arResult["NAME"]?>
</p>

<div class="details-result">
    <div class="left-side">
        <?=$arResult["PROPERTIES"]["DESC_LEFT"]["~VALUE"]["TEXT"]?>
    </div>
    <div class="middle-side">
        <img src="<?=CFile::GetPAth($arResult["~DETAIL_PICTURE"])?>" alt="" />
    </div>
    <div class="right-side">
        <?=$arResult["PROPERTIES"]["DESC_RIGHT"]["~VALUE"]["TEXT"]?>
    </div>
</div>

<div class="details-inform">
    <p class="inform-title">
        Описание
    </p>
    <?=$arResult["~DETAIL_TEXT"]?>
</div>