<?
    $arOrder = getOrderConfirm($ORDER_ID);
    $actionPayedOrder = true;
    foreach ($arOrder["ITEMS"] as $key => $arItems) :
        foreach ($arItems["PROP_ORDER_ITEMS"] as $key => $arPropItemsOrder) :
            if ($arPropItemsOrder["CODE"] == "DEPOSIT" && $arPropItemsOrder["VALUE"] == "N"):
                $actionPayedOrder = false;
            endif;
        endforeach;
    endforeach;
    $idUser = $USER->GetID();
    $favorites = getFavorites($idUser);
    if ($favorites["result"] && $favorites["items"]):
        $arResultItems = getFavoriteProducts($favorites["items"]);
    elseif ($_SESSION["FAVORITES_PRODUCTS"]):
        $arResultItems = getFavoriteProducts($_SESSION["FAVORITES_PRODUCTS"]);
    endif;
?>
<div class="outer-content-wrapper">
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
        <h1>Оформление заказа</h1>
        <div class="checkout-success">
            <p class="header">Ваш заказ успешно оформлен!</p>
            <div class="row">
                <div class="col">
                    <p class="order-num">
                        <span>Номер вашего заказа</span>
                        <span><?=$arOrder["ACCOUNT_NUMBER"]?></span>
                    </p>
                    <p class="order-meta">На указанный Вами e-mail отправлено письмо с параметрами заказа.</p>
                    <a class="btn important js-print-version" href="#">Распечатать заказ</a>
                </div>
                <div class="col">
                    <p>В Вашем <a href="/personal/">Личном кабинете</a> содержатся сведения обо всех Ваших заказах и регистрационные данные.</p>
                    <?if ($arOrder["PAY_SYSTEM_ID"] == 10 && $arOrder["PAYED"] != "Y" && $actionPayedOrder === true):?>
                        <script language="JavaScript">
                            window.open('/personal/order/payment/?ORDER_ID=<?=$arOrder["ID"]?>');
                        </script>
                        <p>Если окно с платежной информацией не открылось автоматически, нажмите на ссылку <a href="/personal/order/payment/?ORDER_ID=<?=$arOrder["ID"]?>">Оплатить заказ</a>.</p>
                    <?elseif ($arOrder["PAY_SYSTEM_ID"] == 10 && $arOrder["PAYED"] != "Y" && $actionPayedOrder === false):?>
                        <p>Вы выбрали оплату PayKeeper, но у вас есть товары со статусом "По запросу", наш менеджер свяжется с Вами.</p>
                    <?endif?>
                </div>
            </div>
        </div>
    </div>
</div>
<?$APPLICATION->IncludeComponent(
    "bitrix:sale.recommended.products",
    "items_checkout",
    Array(
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "17",
        "ID" => "",
        "CODE" => $elementCode,
        "MIN_BUYES" => "1",
        "HIDE_NOT_AVAILABLE" => "N",
        "SHOW_DISCOUNT_PERCENT" => "N",
        "PRODUCT_SUBSCRIPTION" => "N",
        "SHOW_NAME" => "Y",
        "SHOW_IMAGE" => "Y",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "MESS_BTN_SUBSCRIBE" => "Подписаться",
        "PAGE_ELEMENT_COUNT" => "30",
        "LINE_ELEMENT_COUNT" => "3",
        "TEMPLATE_THEME" => "blue",
        "DETAIL_URL" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "86400",
        "SHOW_OLD_PRICE" => "N",
        "PRICE_CODE" => array("BASE"),
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "CONVERT_CURRENCY" => "N",
        "BASKET_URL" => "/personal/basket.php",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "USE_PRODUCT_QUANTITY" => "N",
        "PROPERTY_CODE_17" => array("ID_PROD","CML2_CODE","CML2_SORT","ARTIKUL","PRICE","OPIS","COLOR","TIP_SVETILNIKA","REPLICA","MATERIAL_KORPUSA","TYPE_MOUTING","PLACE_MOUTING","STYLE","SIZE","PLAFON","SVET_MATERIAL","MEBEL_MATERIAL","INTERIER_MATERIAL","BRAND","WAITING","SALE","NEW","DEPOSIT","BALANCE","IMAGES","OLD_PRICE","NOTE","SIMILAR_ITEMS","ITEMS",""),
        "CART_PROPERTIES_17" => array("TIP_SVETILNIKA","MATERIAL_KORPUSA","TYPE_MOUTING","PLACE_MOUTING","STYLE","SIZE","PLAFON","SVET_MATERIAL","MEBEL_MATERIAL","INTERIER_MATERIAL","BRAND","",""),
        "ADDITIONAL_PICT_PROP_17" => "IMAGES",
        "LABEL_PROP_17" => "-"
    )
);?>
<?
if ($arResultItems):
    include($_SERVER["DOCUMENT_ROOT"]."/personal/order/make/wishlist.php");
endif;
include($_SERVER["DOCUMENT_ROOT"]."/personal/order/make/printorder.php");
?>
<script>
    // $(window).load(
        // function(){
			
            ga('require','ecommerce','ecommerce.js');
            ga('ecommerce:addTransaction',{
              'id':'<?=$arOrder["ACCOUNT_NUMBER"]?>', // Transaction ID. Required.
              'affiliation':'Arteva Home', // Affiliation or store name.
              'revenue':'<?=$arOrder["PRICE"]?>', // Grand Total.
              'shipping':'0', // Shipping.
              'tax':'0' // Tax.
            });
            <?foreach ($arOrder["ITEMS"] as $key => $arItems) :?>
                ga('ecommerce:addItem',{
                  'id':'<?=$arOrder["ACCOUNT_NUMBER"]?>',  // Transaction ID. Required.
                  'name':'<?=$arItems["NAME"]?>', // Product name. Required.
                  'category':'<?=$arItems["PRODUCTS"]["SECTION"]["NAME"]?>', // Category or variation.
                  'sku':'<?=$arItems["PRODUCTS"]["PROPERTY_ARTIKUL_VALUE"]?>', // SKU/code.
                  'price':'<?=$arItems["PRICE"]?>', // Unit price.
                  'quantity':'<?=$arItems["QUANTITY"]*1?>' // Quantity.
                });
            <?endforeach?>
            ga('ecommerce:send');
            ga('ecommerce:clear');
        // }
    // )
</script>


<?
CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");

// $arOrder["ID"]

if(isset( $_COOKIE['actionpay'] )){
	$arFields = array(
	"ORDER_ID" => $arOrder["ID"],
	"ORDER_PROPS_ID" => 21,
	"NAME" => "ActionPay",
	"CODE" => "ACTIONPAY",
	"VALUE" => $_COOKIE["actionpay"]
	);
	CSaleOrderPropsValue::Add($arFields);			
}

$dbBasketItems = CSaleBasket::GetList(
	array("ID" => "ASC"),
	array(
			// "FUSER_ID" => CSaleBasket::GetBasketUserID(),
			"LID" => SITE_ID,
			"ORDER_ID" => $arOrder["ID"]
		),
	false,
	false,
	array("ID", "PRODUCT_ID", "QUANTITY", "PRICE", "NAME", "DISCOUNT_PRICE")
);	
$APRT_DATA = "";
$basketString = "";
$PRICE = 0;
$ADMITAD_BASKET = array();
while ($arBasketItems = $dbBasketItems->GetNext()){
	$APRT_DATA .= "{ id: " . $arBasketItems["PRODUCT_ID"] . ", name: '" . $arBasketItems["NAME"] . "', price: " . round($arBasketItems["PRICE"]) . ", quantity: " . round($arBasketItems["QUANTITY"]) . " },\r\n";
	$PRICE += round($arBasketItems["PRICE"]) * round($arBasketItems["QUANTITY"]);
	$ADMITAD_BASKET[] = $arBasketItems;
	
	$basketString .= "{ id:" . $arBasketItems["PRODUCT_ID"] . ", qnt:" . round($arBasketItems["QUANTITY"]) . ", price:" . round($arBasketItems["PRICE"]) . "},";
}
$basketString = rtrim($basketString, ",");

if(!isset($_COOKIE["order_" . $arOrder['ACCOUNT_NUMBER']]))
{
	setcookie("order_" . $arOrder['ACCOUNT_NUMBER'], "Y", time() + 3600*24*10, "/");
	?>
	<img src="//apypxl.com/ok/8029.png?actionpay=<?=$_COOKIE["actionpay"]?>&apid=<?=$arOrder['ACCOUNT_NUMBER']?>&price=<?=round($arOrder["PRICE"])?>" height="1" width="1" />
	
<script type="text/javascript">
(function (d, w) {
	w._admitadPixel = {
		response_type: 'img',
		action_code: '1',
		campaign_code: '86bcd07266'
	};
	w._admitadPositions = w._admitadPositions || [];
	<? $j = 1;?>
	<? foreach($ADMITAD_BASKET as $item_admitad){?>
	w._admitadPositions.push({
		uid: '<?=$_COOKIE["admitad_uid"]?>',
		order_id: '<?=$arOrder["ACCOUNT_NUMBER"]?>',
		position_id: '<?=$j;?>',
		client_id: '<?=$USER->GetID()?>',
		tariff_code: '1',
		currency_code: '',
		position_count: '<?=count($ADMITAD_BASKET)?>',
		price: '<?=$item_admitad['PRICE']?>',
		quantity: '<?=round($item_admitad['QUANTITY'])?>',
		product_id: '<?=$item_admitad['PRODUCT_ID']?>',
		screen: '',
		tracking: '',
		old_customer: '',
		coupon: '',
		payment_type: 'sale'
	});
	<?
		$j++;
	}?>
		

	var id = '_admitad-pixel';
	if (d.getElementById(id)) { return; }
	var s = d.createElement('script');
	s.id = id;
	var r = (new Date).getTime();
	var protocol = (d.location.protocol === 'https:' ? 'https:' : 'http:');
	s.src = protocol + '//cdn.asbmit.com/static/js/pixel.min.js?r=' + r;
	d.head.appendChild(s);
	
})(document, window)
</script>
<noscript>
	<? $j = 1;?>
	<? foreach($ADMITAD_BASKET as $item_admitad){?>	
	<img src="//ad.admitad.com/r?campaign_code=86bcd07266&action_code=1&response_type=img&uid=<?=$_COOKIE["admitad_uid"]?>&order_id=<?=$arOrder["ACCOUNT_NUMBER"]?>&position_id=<?=$j?>&tariff_code=1&currency_code=&position_count=<?=count($ADMITAD_BASKET)?>&price=<?=$item_admitad['PRICE']?>&quantity=<?=round($item_admitad['QUANTITY'])?>&product_id=<?=$item_admitad['PRODUCT_ID']?>&coupon=&payment_type=sale" width="1" height="1" alt="">
	<? 	$j++;
	}?>
</noscript>	


<script type="text/javascript">
rrApiOnReady.push(function() {
    try {
        rrApi.order({
            transaction: <?=$arOrder["ACCOUNT_NUMBER"]?>,
            items: [
                <?=$basketString?>
            ]
        });
    } catch(e) {}
})
</script>


<?
}
?>


<script>
	window.APRT_DATA = {
		pageType: 6,
		purchasedProducts: [
			<?= rtrim($APRT_DATA, ",") ?>
		],
		orderInfo: {
			id: <?=$arOrder["ACCOUNT_NUMBER"]?>,
			totalPrice: <?=$arOrder["PRICE"]?>,
		}
	}

	console.log(window.APRT_DATA);
</script>
<?
	// PR($arOrder);
?>