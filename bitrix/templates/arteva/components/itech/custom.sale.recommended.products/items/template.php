<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult["ITEMS"]):?>
    <div class="outer-content-wrapper item-cross item-page-outer-posit" style="float:none; margin-left: auto; margin-right: auto;">
        <div class="content-wrapper">
            <p class="section-header">С этим товаром покупают</p>
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
                                    <?if ($arItems['PRICE_VALUE']['DISCOUNT_PRICE'] < $arItems['PRICE_VALUE']['PRICE']):?>
                                        <p class="item-price"><span><?=number_format($arItems['PRICE_VALUE']['DISCOUNT_PRICE'], 0, 0, " ")?></span> руб.</p>
                                        <p class="old-price"><span><?=number_format($arItems['PRICE_VALUE']['PRICE'], 0, 0, " ")?></span> руб.</p>
                                    <?else:?>
                                        <p class="item-price"><span><?=number_format($arItems['PRICE_VALUE']['PRICE'], 0, 0, " ")?></span> руб.</p>
                                    <?endif?>
                                </div>
                                <?if ($arItems["PROPERTY_HIT_VALUE"]):?>
                                    <div class="item-card-badge hit">Хит продаж</div>
                                <?endif?>
                                <?if ($arItems["PROPERTY_NEW_VALUE"]):?>
                                    <div class="item-card-badge new">Новинка</div>
                                <?endif?>
                                <?
                                    $salePersent = 100-($arItems['PRICE_VALUE']['DISCOUNT_PRICE']*100)/$arItems['PRICE_VALUE']['PRICE'];
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