<div class="outer-content-wrapper favorite-wrapper">
    <div class="content-wrapper">
        <div class="text-content">
            <p class="section-header">Ваши избранные товары</p>
            <div class="cart-cnt js-content-favorites" data-user="<?=$idUser?>">
                <div class="cart-header">
                    <div class="cart-row">
                        <div class="cell header-cell cell-img">&nbsp;</div>
                        <div class="cell header-cell cell-descr">Описание</div>
                        <div class="cell header-cell cell-count">Количество</div>
                        <div class="cell header-cell cell-price">Цена</div>
                        <div class="cell header-cell cell-to-cart">В корзину</div>
                        <?if ($USER->isAuthorized() && in_array(8, $USER->GetUserGroupArray())):?>
                            <div class="cell header-cell cell-to-spec">В спецификацию</div>
                        <?endif?>
                    </div>
                </div>
                <div class="cart-body">
                    <?foreach ($arResultItems as $key => $arItems) :?>
                        <div class="cart-row js-item" data-id="<?=$arItems["ID"]?>">
                            <a href="<?=$arItems["DETAIL_PAGE_URL"]?>">
                                <?
                                    //$waterImage = waterImage($arItems["~PREVIEW_PICTURE"]);
                                    // $waterImage["src"]
                                    $waterImage["src"] = CFIle::GetPath($arItems["~PREVIEW_PICTURE"]);
                                ?>
                                <div class="cell body-cell cell-img">
                                    <div class="img-cnt"><img src="<?=$waterImage["src"]?>" alt="item image"/></div>
                                </div>
                            </a>
                            <div class="cells-cnt">
                                <div class="cell body-cell cell-descr">
                                    <p class="num">Артикул <?=$arItems["PROPERTIES"]["ARTIKUL"]["VALUE"]?></p>
                                    <p><?=$arItems["NAME"]?></p>
                                </div>
                                <div class="cell body-cell cell-count">
                                    <div class="cart-item-count">
                                        <a class="item-dec js-dec" href="#">–</a>
                                        <input class="item-count js-item-count" value="1" type="text" name="item1-count" id="item1-count"/>
                                        <a class="item-inc js-inc" href="#">+</a>
                                    </div>
                                </div>
                                <div class="cell body-cell cell-price">
                                    <p><?=number_format($arItems["PRICES"]["DISCOUNT_VALUE"], 0, 0, " ")?> руб.</p>
                                    <?if ($arItems["PRICES"]["DISCOUNT_VALUE"] < $arItems["PRICES"]["PRICE"]):?>
                                        <p class="item-old-price"><?=number_format($arItems["PRICES"]["PRICE"], 0, 0, " ")?> руб.</p>
                                    <?endif?>
                                </div>
                                <div class="tocart-cnt">
                                    <div class="cell body-cell cell-to-cart">
                                        <a class="js-add-to-cart" href="#"><i class="icon icon-cart"></i><span>В корзину</span></a>
                                    </div>
                                    <?if ($USER->isAuthorized() && in_array(8, $USER->GetUserGroupArray())):?>
                                        <div class="cell body-cell cell-to-spec">
                                            <a class="js-add-to-spec-popup" href="#"><i class="icon icon-spec"></i><span>В спецификацию</span></a>
                                        </div>
                                    <?endif?>
                                </div>
                            </div>
                        </div>
                    <?endforeach?>
                </div>
            </div>
        </div>
    </div>
</div>