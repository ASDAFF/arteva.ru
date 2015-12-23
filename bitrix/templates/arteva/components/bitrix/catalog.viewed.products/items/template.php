<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult["ITEMS"]):?>
    <style>
        @media screen and (min-width: 1900px) {
            .item-page-outer-posit {
                width: 1518px !important;
            }
        }
    </style>
    <div class="outer-content-wrapper item-recent-viewed item-page-outer-posit" style="float:none;">
        <div class="content-wrapper">
            <p class="section-header">Вы недавно смотрели</p>
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
                                    <p class="item-brand">Артикул <?=$arItems["PROPERTIES"]["ARTIKUL"]["VALUE"]?></p>
                                    <p class="item-desc"><?=$arItems["NAME"]?></p>
                                    <p class="item-price"><span><?=number_format($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"], 0, 0, " ")?></span> руб.</p>
                                    <?if ($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"] < $arItems["PRICES"]["BASE"]["VALUE"]):?>
                                        <p class="old-price"><span><?=number_format($arItems["PRICES"]["BASE"]["VALUE"], 0, 0, " ")?></span> руб.</p>
                                    <?endif?>
                                </div>
                                <?if ($arItems["PROPERTIES"]["HIT"]["VALUE"]):?>
                                    <div class="item-card-badge hit">Хит продаж</div>
                                <?endif?>
                                <?if ($arItems["PROPERTIES"]["NEW"]["VALUE"]):?>
                                    <div class="item-card-badge new">Новинка</div>
                                <?endif?>
                                <?
                                    $salePersent = 100-($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"]*100)/$arItems["PRICES"]["BASE"]["VALUE"];
                                    $salePersent = number_format($salePersent, 0, 0, "");
                                ?>
                                <?if ($salePersent > 0):?>
                                    <div class="item-card-badge sale">скидка <?=$salePersent?>%</div>
                                <?endif?>
                            </a>
                        </li>
                    <?endforeach?>
                </ul>
                <div class="item-cards-list-controls"></div>
            </div>
        </div>
    </div>
<?endif?>