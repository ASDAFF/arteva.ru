<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach ($arResult["SECTIONS"] as $key => $arSections) :?>
    <?if ($arSections["DEPTH_LEVEL"] == 1):?>
        <div class="sitemap-section">
            <div class="sitemap-header">
                <?=$arSections["NAME"]?>
            </div>
            <?if ($arSections["SECTIONS"]):?>
                <ul class="sitemap-links-list">
                    <?foreach ($arSections["SECTIONS"] as $key => $arSec) :?>
                        <li>
                            <a  href="<?=$arSec["SECTION_PAGE_URL"]?>"><?=$arSec["NAME"]?></a>
                            <?if ($arSec["SECTIONS"]):?>
                                <ul class="sitemap-links-sublist">
                                    <?foreach ($arSec["SECTIONS"] as $key => $arSubSec) :?>
                                        <li><a href="<?=$arSubSec["SECTION_PAGE_URL"]?>"><?=$arSubSec["NAME"]?></a></li>
                                    <?endforeach?>
                                </ul>
                            <?endif?>
                        </li>
                    <?endforeach?>
                </ul>
            <?endif?>
        </div>
    <?endif?>
<?endforeach?>