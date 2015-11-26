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
                <div class="step-indicator active">
                    <div class="step-num">1</div>
                    <p class="step-name">Шаг первый</p>
                    <p class="step-info">Авторизация/регистрация</p>
                </div>
                <div class="step-indicator">
                    <div class="step-num">2</div>
                    <p class="step-name">Шаг второй</p>
                    <p class="step-info">Выбор способа доставки и оплаты</p>
                </div>
                <div class="step-indicator">
                    <div class="step-num">3</div>
                    <p class="step-name">Шаг третий</p>
                    <p class="step-info">Подтверждение заказа</p>
                </div>
            </div>
        </div>
        <div class="step-inner">
	     <?if(empty($arUser['PERSONAL_PHONE']) && $USER->isAuthorized()):?>
		  <div class="auth-slider phone-page">
                        <div class="auth-regular">
                        <p class="header">Пожалуйста, введите свой номер телефона,</p>
			<p class="header">это необходимо для подтверждения Вашего заказа</p>
			 <?$APPLICATION->IncludeComponent(
			    "itech:main.save_phone",
                            "reg_phone",
                            Array(
                                "USER_PROPERTY_NAME" => "",
                                "SEF_MODE" => "Y",
                                "SHOW_FIELDS" => Array(
                                     "PERSONAL_PHONE"
                                    ),
                                "REQUIRED_FIELDS" => Array(
                                    "PERSONAL_PHONE"
                                    ),
                                "AUTH" => "Y",
                                "USE_BACKURL" => "Y",
                                "SUCCESS_PAGE" => "/personal/order/make/",
                                "SET_TITLE" => "Y",
                                "USER_PROPERTY" => Array(
                                    "UF_SUBSCRIBE"
                                    ),
                                "SEF_FOLDER" => "/",
                                "VARIABLE_ALIASES" => Array()
                            )
                        );?>
			</div>
		</div>
	   <?else:?>
            <div class="auth-slider">
                <div class="auth-regular">
                    <div class="col12">
                        <p class="header"><strong>Уже покупали</strong> у нас?</p>
                        <p class="info">Авторизуйтесь, чтобы мы могли Вас узнать</p>
                        <div class="common-form">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:system.auth.form",
                                "auth_checkout",
                                Array(
                                    "REGISTER_URL" => "/registration/",
                                    "FORGOT_PASSWORD_URL" => "/forgot-password/",
                                    "PROFILE_URL" => "/repsonal/",
                                    "SHOW_ERRORS" => "Y" 
                                    )
                            );?>
                        </div>
                    </div>
                    <div class="col12">
                        <p class="header"><strong>Впервые</strong> в нашем магазине?</p>
                        <p class="info">Зарегистрировавшись, Вы сможете отслеживать свои заказы в Личном кабинете</p>
                        <a class="btn important js-auth-switch" data-rel="auth-first-time" href="#">Я покупаю впервые</a>
                    </div>
                </div>
                <div class="auth-first-time">
                    <p class="header">Зарегистрируйтесь или <a href="#" class="js-auth-switch" data-rel="auth-regular">войдите</a>, чтобы продолжить покупки</p>
                    <p class="info">Введите e-mail и контактную информацию</p>
                    <div class="common-form">
                        <?$APPLICATION->IncludeComponent(
                            "itech:main.register",
                            "reg_checkout",
                            Array(
                                "USER_PROPERTY_NAME" => "", 
                                "SEF_MODE" => "Y", 
                                "SHOW_FIELDS" => Array(
                                    "NAME", "PERSONAL_PHONE",
                                    "EMAIL"
                                    ), 
                                "REQUIRED_FIELDS" => Array(
                                    "NAME", "PERSONAL_PHONE",
                                    ),
                                "AUTH" => "Y", 
                                "USE_BACKURL" => "Y", 
                                "SUCCESS_PAGE" => "/personal/order/make/", 
                                "SET_TITLE" => "Y", 
                                "USER_PROPERTY" => Array(
                                    "UF_SUBSCRIBE"
                                    ), 
                                "SEF_FOLDER" => "/", 
                                "VARIABLE_ALIASES" => Array()
                            )
                        );?>
                    </div>
                </div>

            </div>
        </div>
	<?endif;?>
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
