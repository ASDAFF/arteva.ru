<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");?>
<?if ($USER->isAuthorized()):?>
    <?
        $arOrders = getAllOredersUser($USER->GetId());
    ?>
    <div class="outer-content-wrapper lk-page">
        <div class="content-wrapper">
            <a class="lk-sidebar-trigger js-lk-side-trigger mobile" href="#">Личный кабинет</a>
            <?
                include($_SERVER["DOCUMENT_ROOT"]."/include/menu_personal.php");
            ?>
            <div class="lk-inner">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "bread",
                    Array(
                        "START_FROM" => "0",
                        "PATH" => "",
                        "SITE_ID" => "-"
                    )
                );?>
                <h1>Мои заказы</h1>
                <div class="lk-section lk-section-orders">
                    <div class="lk-content">
                        <div class="lk-orders">
                            <?if ($arOrders):?>
                                <?foreach ($arOrders as $key => $arOrder) :?>
                                    <?foreach ($arOrder["ITEMS"] as $key => $arItems) :
                                        $arOrder["DISCOUNT_VALUE"] += $arItems["DISCOUNT_PRICE"]*$arItems["QUANTITY"];
                                    endforeach;?>
                                    <div class="lk-order">
                                        <p class="last-order-info big">Заказ №<?=$arOrder["ACCOUNT_NUMBER"]?><span><?=$arOrder["DATE_INSERT"]?></span></p>
                                        <div class="order-params">
                                            <div class="col12">
                                                <div class="lk-toc-row">
                                                    <span>Стоимость товаров</span>
                                                    <span><?=number_format(($arOrder["PRICE"]+$arOrder["DISCOUNT_VALUE"])-$arOrder["PRICE_DELIVERY"], 0, 0, " ")?> руб.</span>
                                                </div>
                                                <div class="lk-toc-row">
                                                    <span>Со скидкой</span>
                                                    <span><?=number_format($arOrder["PRICE"]-$arOrder["PRICE_DELIVERY"], 0, 0, " ")?> руб.</span>
                                                </div>
                                                <div class="lk-toc-row">
                                                    <span>Способ доставки</span>
                                                    <span><?=getDeliveryName($arOrder["DELIVERY_ID"])?></span>
                                                </div>
                                            </div>
                                            <div class="col12">
                                                <div class="lk-toc-row">
                                                    <span>Ваша экономия</span>
                                                    <span><?=number_format($arOrder["PRICE"] - ($arOrder["PRICE"]-$arOrder["DISCOUNT_VALUE"]), 0, 0, " ")?> руб.</span>
                                                </div>
                                                <div class="lk-toc-row">
                                                    <span><strong>ИТОГО</strong></span>
                                                    <span><strong><?=number_format($arOrder["PRICE"], 0, 0, " ")?> руб.</strong></span>
                                                </div>
                                                <?
                                                    switch ($arOrder["STATUS_ID"]) {
                                                        case 'A':
                                                            $msgStatus = "Внесены изменения, подтвержден";
                                                            break;
                                                        case 'C':
                                                            $msgStatus = "Подтвержден";
                                                            break;
                                                        case 'S':
                                                            $msgStatus = "Отгружен";
                                                            break;
                                                        case 'N':
                                                            $msgStatus = "Принят";
                                                            break;
                                                        case 'P':
                                                            $msgStatus = "Оплачен";
                                                            break;
                                                        case 'F':
                                                            $msgStatus = "Выполнен";
                                                            break;
                                                        case 'D':
                                                            $msgStatus = "Отменен";
                                                            break;
                                                    }
                                                ?>
                                                <p class="lk-payment-info">Статус: <?=$msgStatus?></p>
                                            </div>
                                        </div>
                                        <a class="btn small-btn js-order-contents-trigger" href="#">Состав заказа</a>
                                        <div class="lk-order-contents-wrapper">
                                            <ul class="checkout-order-list">
                                                <?foreach ($arOrder["ITEMS"] as $key => $arItems) :?>
                                                    <?if ($key > 0):echo "-->";endif;?><li class="checkout-order-item">
                                                        <?if ($arItems["PRODUCTS"]["~PREVIEW_PICTURE"]):?>
                                                            <aside>
                                                                <?
                                                                    //$waterImage = waterImage($arItems["PRODUCTS"]["~PREVIEW_PICTURE"]);
                                                                    // $waterImage["src"]
                                                                    $waterImage["src"] = CFIle::GetPath($arItems["PRODUCTS"]["~PREVIEW_PICTURE"]);
                                                                ?>
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
                                                                <span class="item-count">x <?=$arItems["QUANTITY"]*1?> шт.</span><span class="item-sum">на сумму <?=number_format(($arItems["PRICE"]+$arItems["DISCOUNT_PRICE"])*$arItems["QUANTITY"], 0, 0, " ")?> руб.</span>
                                                            </p>
                                                        </div>
                                                    </li><?if ($key < count($arOrder["ITEMS"])-1):echo "<!--";endif;?>
                                                <?endforeach?>
                                            </ul>
                                        </div>
                                    </div>
                                <?endforeach?>
                            <?else:?>
                                <div class="lk-order">
                                    <p class="last-order-info big">У Вас нет заказов...</p>
                                </div>
                            <?endif?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?else:
    LocalRedirect("/auth/");
endif?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>