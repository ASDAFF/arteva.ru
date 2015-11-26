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
        <?
            global $USER;
            $arDelivery = getDelivery();
            $arPaySystem = getPaySystem();
            $addressUser = getAddressUser($USER->GetID());
            $actionPay = getPayAction();
        ?>
        <div class="content-wrapper">
            <div class="steps-indicators">
                <div class="step-indicator">
                    <div class="step-num">1</div>
                    <p class="step-name">Шаг первый</p>
                    <p class="step-info">Авторизация/регистрация</p>
                </div>
                <div class="step-indicator active">
                    <div class="step-num">2</div>
                    <p class="step-name">Шаг второй</p>
                    <p class="step-info">Выбор способа доставки и оплаты</p>
                </div>
                <div class="step-indicator">
                    <div class="step-num" id="third_step_icon" style="cursor:pointer;">3</div>
                    <p class="step-name">Шаг третий</p>
                    <p class="step-info">Подтверждение заказа</p>
                </div>
            </div>
        </div>
        <div class="step-inner">
            <div class="content-wrapper">
                <div class="common-form delivery-type">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="col12">
                            <p class="header">Выберите способ доставки</p>
                            <ul class="delivery-list">
                                <?foreach ($arDelivery as $key => $delivery) :?>
                                    <li class="delivery-list-item">
                                        <fieldset>
                                            <input type="radio" class="css-checkbox" <?if ($key == 0):?>checked<?endif?> name="DELIVERY_ID" id="delivery<?=$key?>" value="<?=$delivery["ID"]?>" <?if ($delivery["ID"] != 4 || $delivery["NAME"] != "Самовывоз"):?>data-toggle="1"<?endif?>/>
                                            <label class="cb-label" for="delivery<?=$key?>"><em><?=$delivery["NAME"]?></em></label>
                                            <p class="delivery-meta"></p>
                                        </fieldset>
                                        <span><?=$delivery["DESCRIPTION"]?></span>
                                    </li>
                                    <?if ($delivery["ID"] != 4 || $delivery["NAME"] != "Самовывоз"):?>
                                        <li class="js-toggle toggled">
                                            <fieldset>
                                                <label for="daddress<?=$key?>">Адрес</label>
                                                <textarea name="ORDER_PROP_7" id="daddress<?=$key?>" data-parsley-required disabled><?=$addressUser?></textarea>
                                            </fieldset>
                                        </li>
                                    <?endif?>
                                <?endforeach?>
                            </ul>
                            <a class="more-about-delivery" href="/payment-and-shipping/" target="__blank">Подробнее о доставке и оплате</a>
                        </div>
                        <div class="col12">
                            <p class="header">Выберите способ оплаты</p>
							<!--p class="checkout-confirm-comment-info" style="margin-bottom: 10px; color:#ff0000;">По техническим причинам онлайн-оплата временно не работает, приносим свои извинения</p-->
                            <?foreach ($arPaySystem as $key => $pay) :?>
                                <fieldset>
                                    <input type="radio" class="css-checkbox" <?if ($key == 0):?>checked<?endif?> name="PAY_SYSTEM_ID" id="payment<?=$key?>" <?if ($pay["ID"] == 8):?>rel="requisits"<?elseif ($pay["ID"] == 10):?>rel="warning"<?endif?> value="<?=$pay["ID"]?>"/>
                                    <label class="cb-label" for="payment<?=$key?>"><?=$pay["NAME"]?></label>
                                    <p class="delivery-meta"><?=$pay["DESCRIPTION"]?>
                                        <?if ($pay["ID"] == 10):?>
                                        <br/><img src="/img/img_pay_inner.png" height="20"/>
                                        <?endif;?>
                                    </p>
                                </fieldset>
                                <?if ($pay["ID"] == 8):?>
                                    <fieldset style="display: none;">
                                        <label for="requisits">Загрузите файл с вашими реквизитам</label>
                                        <input type="file" name="requisits" id="requisits" data-parsley-required disabled/>
                                    </fieldset>
                                <?elseif ($pay["ID"] == 10 && $actionPay === false):?>
                                    <fieldset style="display: none;">
                                        <p class="delivery-meta" id="warning"><strong>Внимание!</strong> <br/> В вашем заказе есть товар категории «по запросу». В данном случае оплата онлайн будет возможна после подтверждения заказа оператором. При условии наличия этого товара на ваш e-mail будет отправлено письмо, содержащее ссылку на страницу банка для последующей оплаты, в противном случае оператор с вами свяжется.</p>
                                    </fieldset>
                                <?endif?>
                            <?endforeach?>
                            <p class="header">
                                <a href="#" class="checkout-confirm-comment js-payment-comment-trigger">Ваш комментарий</a>
                            </p>
                            <fieldset>
                                <textarea name="ORDER_DESCRIPTION" id="payment-comment"></textarea>
                            </fieldset>
                        </div>
                        <div class="step2-submit-cnt aright">
                            <input type="hidden" name="step" value="3">
                            <input id="third_step_btn" class="important" name="next_step" type="submit" value="Перейти к подтверждению заказа" onclick="ga('send', 'event', 'order', 'confirmation'); return true;"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(window).load(function(){
		if	(localStorage.userDeliv != 0){
			$('input[name=DELIVERY_ID][value='+localStorage.userDeliv+']').click();
			localStorage.userDeliv = 0;
		};
		if	(localStorage.userDelivAdress1 != "full"){
			$('#daddress0').val(localStorage.userDelivAdress1);
			localStorage.userDelivAdress1="full";
		};
		if	(localStorage.userDelivAdress2 != "full"){
			$('#daddress1').val(localStorage.userDelivAdress2);
			localStorage.userDelivAdress2="full";
		};
		if	(localStorage.userDelivAdress3 != "full"){
			$('#daddress3').val(localStorage.userDelivAdress3);
			localStorage.userDelivAdress3="full";
		};
		if	(localStorage.userPay != 0){
			$('input[name=PAY_SYSTEM_ID][value='+localStorage.userPay+']').click();
			localStorage.userPay=0;
		};
		if	(localStorage.userDescr != "full"){
			$('#payment-comment').val(localStorage.userDescr);
			localStorage.userDescr="full";
		};
	});
</script>
<?
//echo "<pre>";print_r($arDelivery);echo "</pre>";
//echo "<pre>";print_r($arPaySystem);echo "</pre>";  
?>
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