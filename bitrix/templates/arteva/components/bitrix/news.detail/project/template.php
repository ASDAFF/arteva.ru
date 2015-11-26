<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="outer-content-wrapper nopb">
    <div class="content-wrapper">
        <?
            global $APPLICATION;
            $APPLICATION->AddChainItem($arResult["NAME"], $arResult["DETAIL_PAGE_URL"]);
            echo $APPLICATION->GetNavChain(false, false, false, true);
        ?>
        <h1><?=$arResult["NAME"]?></h1>
        <div class="project-content">
            <aside>
                <div id="project-slider">
                    <?foreach ($arResult["PROPERTIES"]["IMAGES"]["VALUE"] as $key => $imgId) :?>
                        <a class="project-image js-fbx-image" href="<?=CFile::GetPath($arResult["PROPERTIES"]["IMAGES_BIG"]["VALUE"][$key])?>">
                            <img src="<?=CFile::GetPath($imgId)?>" alt=""/>
                        </a>
                    <?endforeach?>
                </div>
            </aside>
            <div class="project-description">
                <div class="designer-info">
                    <?if ($arResult["DESIGNER"]["~PREVIEW_PICTURE"]):?>
                        <aside>
                            <div class="img-cnt">
                                <img src="<?=CFile::GetPath($arResult["DESIGNER"]["~PREVIEW_PICTURE"])?>" alt="avatar"/>
                            </div>
                        </aside>
                    <?endif?>
                    <div class="designer-info-inner">
                        <p class="header">Дизайнер</p>
                        <p class="name"><?=$arResult["DESIGNER"]["NAME"]?></p>
                        <?if ($arResult["DESIGNER"]["PROPERTIES"]["FACEBOOK"]["VALUE"]):?>
                            <div class="socials-cnt">
                                <a class="designer-social fb" target="_blank" rel="nofollow" href="<?=$arResult["DESIGNER"]["PROPERTIES"]["FACEBOOK"]["VALUE"]?>"></a>
                            </div>
                        <?endif?>
                    </div>
                </div>
                <div class="designer-about">
                    <?=$arResult["DESIGNER"]["~PREVIEW_TEXT"]?>
                </div>
                <div class="designer-project-about">
                    <p class="header">О проекте</p>
                    <div class="about">
                        <?=$arResult["~DETAIL_TEXT"]?>
                    </div>
                    <p class="all-projects">
                        <a href="<?=$arResult["DESIGNER"]["~DETAIL_PAGE_URL"]?>">Все проекты дизайнера</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?if ($arResult["ITEMS"]):?>
    <div class="outer-content-wrapper item-cross">
        <div class="content-wrapper">
            <p class="section-header">В проекте использованы</p>
            <div class="item-cards-list-cnt">
                <ul class="item-cards-list js-item-cards-slider">
                    <?foreach ($arResult["ITEMS"] as $key => $arItems) :?>
                        <li class="item-card-item">
                            <a href="<?=$arItems["DETAIL_PAGE_URL"]?>">
                                <?
                                    //$waterImage = waterImage($arItems["~PREVIEW_PICTURE"]);
                                    // $waterImage["src"]
                                    $waterImage["src"] = CFIle::GetPath($arItems["~PREVIEW_PICTURE"]);
                                ?>
                                <div class="img-cnt">
                                    <img src="/img/img_dummy.png" data-src="<?=$waterImage["src"]?>" alt=""/>
                                </div>
                                <div class="item-info">
                                    <p class="item-brand">Артикул <?=$arItems["PROPERTY_ARTIKUL_VALUE"]?></p>
                                    <p class="item-desc"><?=$arItems["NAME"]?></p>
                                    <p class="item-price"><span><?=number_format($arItems["PRICES"]["DISCOUNT_VALUE"], 0, 0, " ")?></span> руб.</p>
                                    <?if ($arItems["PRICES"]["DISCOUNT_VALUE"] < $arItems["PRICES"]["PRICE"]):?>
                                        <p class="old-price"><span><?=number_format($arItems["PRICES"]["PRICE"], 0, 0, " ")?></span> руб.</p>
                                    <?endif?>
                                </div>
                                <?if ($arItems["PROPERTY_HIT_VALUE"]):?>
                                    <div class="item-card-badge hit">Хит продаж</div>
                                <?endif?>
                                <?if ($arItems["PROPERTY_NEW_VALUE"]):?>
                                    <div class="item-card-badge new">Новинка</div>
                                <?endif?>
                                <?
                                    $salePersent = 100-($arItems["PRICES"]["DISCOUNT_VALUE"]*100)/$arItems["PRICES"]["PRICE"];
                                    $salePersent = number_format($salePersent, 0, 0, "");
                                ?>
                                <?if ($salePersent > 0):?>
                                    <div class="item-card-badge sale">скидка <?=$salePersent?>%</div>
                                <?endif?>
                            </a>
                        </li>
                    <?endforeach?>
                </ul>
            </div>
        </div>
    </div>
<?endif?>