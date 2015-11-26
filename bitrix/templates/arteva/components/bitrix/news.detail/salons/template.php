<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="outer-content-wrapper nop salon-page">
    <div class="salon-slider-cnt">
        <ul class="salon-slider">
            <?foreach ($arResult["PROPERTIES"]["IMAGES"]["VALUE"] as $key => $imgId) :?>
                <li class="slide">
                    <a href="<?=CFile::GetPath($imgId)?>" class="js-fbx-image" rel="gallery1">
                        <img class="bgc-image" src="<?=CFile::GetPath($imgId)?>" alt="salon"/>
                    </a>
                </li>
            <?endforeach?>
        </ul>
        <?if (count($arResult["PROPERTIES"]["IMAGES"]["VALUE"]) > 1):?>
            <div class="salon-slider-pager">
                <?$countImg = count($arResult["PROPERTIES"]["IMAGES"]["VALUE"])-1;?>
                <?foreach ($arResult["PROPERTIES"]["IMAGES"]["VALUE"] as $key => $imgId) :?>
                    <?if ($key > 0 && $key <= $countImg): echo "<!--"; endif?>
                    <?if ($key > 0): echo "-->"; endif?>
                    <a data-slide-index="<?=$key?>" href="#">
                        <img src="<?=CFile::GetPath($imgId)?>" />
                    </a>
                <?endforeach?>
            </div>
        <?endif?>
    </div>
    <div class="nav-container">
        <?
            global $APPLICATION;
            $APPLICATION->AddChainItem($arResult["NAME"], $arResult["DETAIL_PAGE_URL"]);
            echo $APPLICATION->GetNavChain(false, false, false, true);
        ?>
        <h1><?=$arResult["NAME"]?></h1>
    </div>
    <div class="salon-contact-info-cnt">
        <aside>
            Контактная информация
        </aside>
        <div class="salon-contact-info">
            <div class="row">
                <div class="info-block">
                    <p class="header">Адрес</p>
                    <p class="block-info"><?=$arResult["PROPERTIES"]["ADRES"]["~VALUE"]?></p>
                </div>
                <div class="info-block">
                    <p class="header">Телефоны</p>
                    <p class="block-info">
                        <?foreach ($arResult["PROPERTIES"]["PHONE"]["~VALUE"] as $key => $phone) :
                            echo $phone."</br>";
                        endforeach?>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="info-block">
                    <p class="header">Email</p>
                    <p class="block-info">
                        <a href="mailto:<?=$arResult["PROPERTIES"]["EMAIL"]["~VALUE"]?>"><?=$arResult["PROPERTIES"]["EMAIL"]["~VALUE"]?></a>
                    </p>
                </div>
                <div class="info-block">
                    <p class="header">Режим работы </p>
                    <p class="block-info"><?=$arResult["PROPERTIES"]["WORK"]["~VALUE"]?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="howto-find-wrapper">
        <p class="find-header">Как нас найти</p>
        <aside>
            <div class="salon-route-cnt">
                <img src="<?=CFile::GetPath($arResult["PROPERTIES"]["WHERE"]["VALUE"])?>" alt=""/>
            </div>
        </aside>
        <div class="salon-route-info">
            <?=$arResult["~DETAIL_TEXT"]?>
            <?if ($arResult["PROPERTIES"]["LAT"]["VALUE"] && $arResult["PROPERTIES"]["LONG"]["VALUE"]):?>
                <p><a class="btn important js-show-on-map" href="#map" onclick="ga('send', 'event', 'show-map', 'open');">Показать на карте</a></p>
                <div class="fbx-content" id="map" data-lat="<?=$arResult["PROPERTIES"]["LAT"]["VALUE"]?>" data-long="<?=$arResult["PROPERTIES"]["LONG"]["VALUE"]?>"></div>
            <?endif?>
        </div>
    </div>
</div>