<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");?>
<?if ($USER->isAuthorized()):?>
    <div class="outer-content-wrapper lk-page" data-user="<?$USER->GetID()?>">
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
                <h1>Личный кабинет</h1>
                <div class="lk-section lk-section-main">
                    <div class="lk-content">
                        <p class="lk-username"><?=$USER->GetFullName()?></p>
                        <p class="lk-sale"><?=getSaleUser($USER->GetID())?></p>
                        <div class="lk-orders">
                        	<?$arOrder = getOrederLk($USER->GetID());?>
                            <p class="header">Мой последний заказ</p>
                            <?if ($arOrder):?>
                                <?foreach ($arOrder["ITEMS"] as $key => $arItems) :
                                    $arOrder["DISCOUNT_VALUE"] += $arItems["DISCOUNT_PRICE"]*$arItems["QUANTITY"];
                                endforeach;?>
                                <p class="last-order-info">Заказ №<?=$arOrder["ACCOUNT_NUMBER"]?><span><?=$arOrder["DATE_INSERT"]?></span></p>
                                <div class="last-order-params">
                                    <div class="lk-toc-row">
                                    	<span>Стоимость товаров</span>
                                    	<span><?=number_format(($arOrder["PRICE"]+$arOrder["DISCOUNT_VALUE"])-$arOrder["PRICE_DELIVERY"], 0, 0, " ")?> руб.</span>
                                    </div>
                                    <div class="lk-toc-row">
                                    	<span>Со скидкой</span>
                                    	<span><?=number_format($arOrder["PRICE"]-$arOrder["PRICE_DELIVERY"], 0, 0, " ")?> руб.</span>
                                    </div>
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
                                    <p class="lk-payment-info">Способ доставки: <?=getDeliveryName($arOrder["DELIVERY_ID"])?></p>
                                    <p class="lk-payment-info">Статус: <?=$msgStatus?></p>
                                </div>
                                <a class="btn small-btn js-order-contents-trigger" href="#">Состав заказа</a>
                                <div class="lk-order-contents-wrapper">
                                    <ul class="checkout-order-list">
                                        <?foreach ($arOrder["ITEMS"] as $key => $arItems) :?>
                                            <li class="checkout-order-item">
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
                                                <div class="order-item-info">
                                                    <p class="item-num">Артикул <?=$arItems["PRODUCTS"]["PROPERTY_ARTIKUL_VALUE"]?></p>
                                                    <p class="item-descr"><?=$arItems["NAME"]?></p>
                                                    <p>
                                                        <span class="item-count">x <?=$arItems["QUANTITY"]*1?> шт.</span><span class="item-sum">на сумму <?=number_format($arItems["PRICE"]*$arItems["QUANTITY"], 0, 0, " ")?> руб.</span>
                                                    </p>
                                                </div>
                                            </li>
                                        <?endforeach?>
                                    </ul>
                                </div>
                            <?else:?>
                                <p class="last-order-info">У Вас нет заказов...</p>
                            <?endif?>
                        </div>
                        <div class="lk-cart-side">
                            <div class="lk-cart-side-wrapper">
                                <p class="header">Моя корзина</p>
                                <?$APPLICATION->IncludeComponent(
    		                        "bitrix:sale.basket.basket.small",
    		                        "lk_cart",
    		                        Array(
    		                            "PATH_TO_BASKET" => "/personal/cart/",
    		                            "PATH_TO_ORDER" => "/personal/order/make/",
    		                            "SHOW_DELAY" => "Y",
    		                            "SHOW_NOTAVAIL" => "Y",
    		                            "SHOW_SUBSCRIBE" => "Y"
    		                        )
    		                    );?>
                            </div>
                        </div>
                    </div>
                    <?
    				    $idUser = $USER->GetID();
                        $favorites = getFavorites($idUser);
                        if ($favorites["result"] && $favorites["items"]):
                            $arResultItems = getFavoriteProducts($favorites["items"]);
                        elseif ($_SESSION["FAVORITES_PRODUCTS"]):
                            $arResultItems = getFavoriteProducts($_SESSION["FAVORITES_PRODUCTS"]);
                        endif;
    				?>
    				<?if ($arResultItems):?>
    	                <div class="text-content js-content-favorites" data-user="<?=$USER->GetId()?>">
    	                    <p class="section-header">Ваши избранные товары</p>
    	                    <div class="cart-cnt">
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
    		                                    <div class="cell body-cell cell-img">
                                                    <?
                                                        //$waterImage = waterImage($arItems["~PREVIEW_PICTURE"]);
                                                        // $waterImage["src"]
                                                        $waterImage["src"] = CFIle::GetPath($arItems["~PREVIEW_PICTURE"]);
                                                    ?>
    		                                        <div class="img-cnt">
                                                        <img src="<?=$waterImage["src"]?>" alt="item image"/>
                                                    </div>
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
    	            <?endif?>
                </div>
            </div>
        </div>
    </div>
<?else:
    LocalRedirect("/auth/");
endif?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>