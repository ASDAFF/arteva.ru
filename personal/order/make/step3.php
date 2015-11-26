<div class="outer-content-wrapper checkout-page">
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
    <div class="checkout-wrapper">
        <div class="content-wrapper">
            <div class="steps-indicators">
                <div class="step-indicator">
                    <div class="step-num">1</div>
                    <p class="step-name">Шаг первый</p>
                    <p class="step-info">Авторизация/регистрация</p>
                </div>
                <div class="step-indicator">
                    <div class="step-num" onclick="location.href='/personal/order/make/'" style="cursor:pointer;">2</div>
                    <p class="step-name">Шаг второй</p>
                    <p class="step-info">Выбор способа доставки и оплаты</p>
                </div>
                <div class="step-indicator active">
                    <div class="step-num">3</div>
                    <p class="step-name">Шаг третий</p>
                    <p class="step-info">Подтверждение заказа</p>
                </div>
            </div>
        </div>
        <div class="step-inner">
            <div class="common-form order-confirm">
                <form action="/personal/order/make/" enctype="multipart/form-data" method="post">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:sale.basket.basket",
                        "order_cart", 
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
                </form>
            </div>
        </div>
		<script type="text/javascript">
			$(window).load(function(){
				localStorage.userDeliv = <?=$_REQUEST["DELIVERY_ID"]?>;
				if (localStorage.userDeliv == 5){ //курьером по Москве
					localStorage.userDelivAdress1 = "<?=$_REQUEST["ORDER_PROP_7"]?>";
				}
				if (localStorage.userDeliv == 6){ //курьером по МО
					localStorage.userDelivAdress2 = "<?=$_REQUEST["ORDER_PROP_7"]?>";
				}	
				if (localStorage.userDeliv == 7){ //курьером по РФ
					localStorage.userDelivAdress3 = "<?=$_REQUEST["ORDER_PROP_7"]?>";
				}
				//console.log(localStorage.userDelivAdress1);
				localStorage.userPay = <?=$_REQUEST["PAY_SYSTEM_ID"]?>;
				localStorage.userDescr = "<?=$_REQUEST["ORDER_DESCRIPTION"]?>";				
			});
		</script>
    </div>
</div>

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
$PRICE = 0;
while ($arBasketItems = $dbBasketItems->GetNext()){
	$APRT_DATA .= "{ id: " . $arBasketItems["PRODUCT_ID"] . ", name: '" . $arBasketItems["NAME"] . "', price: " . round($arBasketItems["PRICE"]) . ", quantity: " . round($arBasketItems["QUANTITY"]) . " },\r\n";
	$PRICE += round($arBasketItems["PRICE"]) * round($arBasketItems["QUANTITY"]);
}	

?>
<script>
window.APRT_DATA = {
	pageType: 5,
	basketProducts: [
		<?= rtrim($APRT_DATA, ",") ?>
	],
	orderInfo: {
		totalPrice: <?= round( $PRICE )?>,
	}
}
</script>