<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");

// PR($_COOKIE["bigbuzzy"], true);

if( isset($_COOKIE["bigbuzzy"]) && $_COOKIE["bigbuzzy"] != "Y" )
{
	CCatalogDiscountCoupon::ClearCoupon();
	// CCatalogDiscountCoupon::SetCoupon("bigbuzzy");
}

?>
<div class="outer-content-wrapper" data-user="<?$USER->GetID()?>">
    <div class="content-wrapper">
        <?$APPLICATION->IncludeComponent(
	        "bitrix:breadcrumb",
	        "bread",
	        Array(
	            "START_FROM" => "0",
	            "PATH" => "",
	            "SITE_ID" => "-"
	        )
	    );?>
        <div class="text-content">
            <h1>Корзина</h1>

            <div class="js-big-cart-wrapper">
            <?$APPLICATION->IncludeComponent(
                "bitrix:sale.basket.basket",
                "cart",
                array(
                "COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
                "COLUMNS_LIST" => array(
                    0 => "NAME",
                    1 => "DISCOUNT",
                    2 => "PRICE",
                    3 => "QUANTITY",
                    4 => "SUM",
                    5 => "PROPS",
                    6 => "DELETE",
                    7 => "DELAY",
                ),
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "PATH_TO_ORDER" => "#SITE_DIR#personal/order/make/",
                "HIDE_COUPON" => "N",
                "QUANTITY_FLOAT" => "N",
                "PRICE_VAT_SHOW_VALUE" => "Y",
                "SET_TITLE" => "Y",
                "AJAX_OPTION_ADDITIONAL" => "",
                "OFFERS_PROPS" => array(
                    0 => "",
                    1 => "",
                    2 => "",
                ),
                ),
                false
            );?>
            </div>
        </div>
    </div>
</div>
<?
    $favorites = getFavorites($USER->GetID());
    if ($favorites["result"] && $favorites["items"]):
        $arResultItems = getFavoriteProducts($favorites["items"]);
    elseif ($_SESSION["FAVORITES_PRODUCTS"]):
        $arResultItems = getFavoriteProducts($_SESSION["FAVORITES_PRODUCTS"]);
    endif;
?>
<?if ($arResultItems):?>
    <div class="outer-content-wrapper favorite-wrapper">
        <div class="content-wrapper">
            <div class="text-content">
                <p class="section-header">Ваши избранные товары</p>
                <div class="cart-cnt js-content-favorites" data-user="<?=$USER->GetId()?>">
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
<?endif?>

<?
CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");

$dbBasketItems = CSaleBasket::GetList(
	array("ID" => "ASC"),
	array(
			"FUSER_ID" => CSaleBasket::GetBasketUserID(),
			"LID" => SITE_ID,
			"ORDER_ID" => "NULL"
		),
	false,
	false,
	array("ID", "PRODUCT_ID", "QUANTITY", "PRICE", "NAME", "DISCOUNT_PRICE")
);	
$APRT_DATA = "";
while ($arBasketItems = $dbBasketItems->GetNext())			
	$APRT_DATA .= "{ id: " . $arBasketItems["PRODUCT_ID"] . ", name: '" . $arBasketItems["NAME"] . "', price: " . round($arBasketItems["PRICE"]) . ", quantity: " . round($arBasketItems["QUANTITY"]) . " },\r\n";

?>
<script>
window.APRT_DATA = {
	pageType: 4,
	basketProducts: [
		<?= rtrim($APRT_DATA, ",") ?>
	],
}
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>