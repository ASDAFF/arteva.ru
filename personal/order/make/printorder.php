<div class="outer-content-wrapper print-show">
    <div class="content-wrapper">
        <div class="js-print-cnt">
            <?
                $allSumOrder = "";
                foreach ($arOrder["ITEMS"] as $key => $arItems) :
                    $allSumOrder += ($arItems["PRICE"]+$arItems["DISCOUNT_PRICE"])*$arItems["QUANTITY"];
                endforeach;
            ?>
            <div class="lk-order">
                <p class="last-order-info big">Заказ №<?=$arOrder["ACCOUNT_NUMBER"]?><span><?=$arOrder["DATE_INSERT"]?></span></p>
                <div class="order-params">
                    <div class="col12">
                        <div class="lk-toc-row">
                            <span>Стоимость товаров</span>
                            <span><?=number_format($allSumOrder, 0, 0, " ")?> руб.</span>
                        </div>
                        <div class="lk-toc-row">
                            <span>Со скидкой</span>
                            <span><?=number_format($arOrder["PRICE"]-$arOrder["PRICE_DELIVERY"]-$arOrder["DISCOUNT_VALUE"], 0, 0, " ")?> руб.</span>
                        </div>
                        <div class="lk-toc-row">
                            <span>Стоимость доставки</span>
                            <span><?=($arOrder["PRICE_DELIVERY"]) ? number_format($arOrder["PRICE_DELIVERY"], 0, 0, " ") : "бесплатно"?></span>
                        </div>
                    </div>
                    <div class="col12">
                        <div class="lk-toc-row">
                            <span>Ваша экономия</span>
                            <span><?=number_format(($allSumOrder+$arOrder["PRICE_DELIVERY"])-$arOrder["PRICE"], 0, 0, " ")?> руб.</span>
                        </div>
                        <div class="lk-toc-row">
                            <span><strong>ИТОГО</strong></span>
                            <span><strong><?=number_format($arOrder["PRICE"], 0, 0, " ")?> руб.</strong></span>
                        </div>
                        <?
                            switch ($arOrder["STATUS_ID"]) {
                                case 'N':
                                    $msgStatus = "Принят, ожидается оплата";
                                    break;
                                case 'P':
                                    $msgStatus = "Оплачен, формируется к отправке";
                                    break;
                                case 'F':
                                    $msgStatus = "Выполнен";
                                    break;
                            }
                        ?>
                        <p class="lk-payment-info"><?=$msgStatus?></p>
                    </div>
                </div>
                <h3>Состав заказа</h3>
                <div class="lk-order-contents-wrapper">
                    <ul class="checkout-order-list">
                        <?foreach ($arOrder["ITEMS"] as $key => $arItems) :?>
                            <?if ($key > 0):echo "-->";endif;?><li class="checkout-order-item">
                                <?if ($arItems["PRODUCTS"]["~PREVIEW_PICTURE"]):?>
                                    <?
                                        //$waterImage = waterImage($arItems["PRODUCTS"]["~PREVIEW_PICTURE"]);
                                        // $waterImage["src"]
                                        $waterImage["src"] = CFIle::GetPath($arItems["PRODUCTS"]["~PREVIEW_PICTURE"]);
                                    ?>
                                    <aside>
                                        <div class="img-cnt">
                                            <img src="<?=$waterImage["src"]?>" alt="item"/>
                                        </div>
                                    </aside>
                                <?endif?>
                                <div class="order-item-info">
                                    <?if ($arItems["PRODUCTS"]["PROPERTY_ARTIKUL_VALUE"]):?>
                                        <p class="item-num">Артикул <?=$arItems["PRODUCTS"]["PROPERTY_ARTIKUL_VALUE"]?></p>
                                    <?endif?>
                                    <?if ($arItems["PRODUCTS"]["DETAIL_PAGE_URL"]):?>
                                        <p class="item-descr">
                                            <a href="<?=$arItems["PRODUCTS"]["DETAIL_PAGE_URL"]?>">
                                                <?=$arItems["NAME"]?>
                                            </a>
                                        </p>
                                    <?else:?>
                                        <p class="item-descr"><?=$arItems["NAME"]?></p>
                                    <?endif?>
                                    <p>
                                        <span class="item-count">x <?=$arItems["QUANTITY"]*1?> шт.</span><span class="item-sum">на сумму <?=number_format($arItems["PRICE"]*$arItems["QUANTITY"], 0, 0, " ")?> руб.</span>
                                    </p>
                                </div>
                            </li><?if ($key < count($arOrder["ITEMS"])-1):echo "<!--";endif;?>
                        <?endforeach?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>