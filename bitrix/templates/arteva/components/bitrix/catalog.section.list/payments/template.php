<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<ul class="links-list">
    <?foreach ($arResult["SECTIONS"] as $key => $arSections) :?>
        <li class="link-item">
            <div class="img-cnt">
                <picture>
                    <!--[if IE 9]><video style="display: none;"><![endif]-->
                    <source srcset="<?=CFile::GetPath($arSections["~UF_IMAGE_MOBILE"])?>" media="(max-width: 640px)">
                    <!--[if IE 9]></video><![endif]-->
                    <img srcset="<?=CFile::GetPath($arSections["~PICTURE"])?>" alt="<?=$arSections["NAME"]?>">
                </picture>
            </div>
            <p class="link-header"><?=$arSections["NAME"]?></p>
            <?foreach ($arSections["ITEMS"] as $key => $arItems) :?>
                <p><a href="#<?=$arItems["CODE"]?>"><?=$arItems["NAME"]?></a></p>
            <?endforeach?>
        </li>
    <?endforeach?>
</ul>