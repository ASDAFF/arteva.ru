<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="capabilities-list clearfix">
    <?foreach ($arResult["SECTIONS"] as $key => $arSections) :?>
        <a href="<?=$arSections["SECTION_PAGE_URL"]?>" class="cap-item sfx sfx-scale" data-fx="sfx-scale">
            <p class="cap-title js-fix-height">
                <?=$arSections["NAME"]?>
            </p>
            <div class="cap-img" style="height:295px;">
                <img style="w" src="<?=CFile::GetPath($arSections["~PICTURE"])?>" alt="">
            </div>
        </a>
    <?endforeach?>
</div>