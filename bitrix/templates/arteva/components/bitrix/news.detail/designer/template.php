<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="outer-content-wrapper nopb">
    <div class="content-wrapper">
        <?
            global $APPLICATION;
            $APPLICATION->AddChainItem($arResult["NAME"], $arResult["DETAIL_PAGE_URL"]);
            echo $APPLICATION->GetNavChain(false, false, false, true);
        ?>
        <h1>Проекты дизайнера</h1>
        <div class="designer-info designer-project">
            <?if ($arResult["~DETAIL_PICTURE"]):?>
                <aside>
                    <div class="img-cnt">
                        <img src="<?=CFile::GetPath($arResult["~DETAIL_PICTURE"])?>" alt="avatar"/>
                    </div>
                </aside>
            <?endif?>
            <div class="designer-info-inner">
                <p class="header">Дизайнер</p>
                <p class="name"><?=$arResult["NAME"]?></p>
                <?if ($arResult["PROPERTIES"]["FACEBOOK"]["VALUE"]):?>
                    <div class="socials-cnt">
                        <a class="designer-social fb" target="_blank" rel="nofollow" href="<?=$arResult["PROPERTIES"]["FACEBOOK"]["VALUE"]?>"></a>
                    </div>
                <?endif?>
            </div>
            <div class="designer-about">
                <?=$arResult["~PREVIEW_TEXT"]?>
            </div>
        </div>

    </div>
</div>
<div class="outer-content-wrapper">
    <div class="content-wrapper">
        <ul class="designer-projects-list">
            <?foreach ($arResult["ITEMS"] as $key => $arItems) :?>
                <li class="designer-project-item">
                    <a href="<?=$arItems["~DETAIL_PAGE_URL"]?>">
                        <img src="<?=CFile::GetPath($arItems["~PREVIEW_PICTURE"])?>" alt="<?=$arItems["NAME"]?>"/>
                        <div class="caption">
                            <p class="heading">
                                <?=$arItems["NAME"]?>
                            </p>
                        </div>
                    </a>
                </li>
            <?endforeach?>
        </ul>
    </div>
</div>