<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h1><?=$arResult["SECTION"]["NAME"]?></h1>
<div class="item-cards-list-cnt">
    <ul class="item-cards-list matrix categories">
        <?foreach ($arResult["SECTIONS"] as $key => $arSections) :?>
            <li class="item-card-item">
                <a href="<?=$arSections["SECTION_PAGE_URL"]?>">
                    <div class="img-cnt">
                        <img src="/img/img_dummy.png" data-src="<?=CFIle::GetPath($arSections["~PICTURE"])?>" alt=""/></div>
                    <div class="item-info">
                        <p class="category"><?=$arSections["NAME"]?></p>
                    </div>
                </a>
            </li>
        <?endforeach?>
    </ul>
</div>
