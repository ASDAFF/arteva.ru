<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Изменить личную информацию");?>
<?if ($USER->isAuthorized()):?>
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
                <h1>Изменить личную информацию</h1>
                <div class="lk-section lk-section-main">
                    <div class="lk-content">
                        <div class="lk-inner-content">
                        	<?$APPLICATION->IncludeComponent(
    							"bitrix:main.profile",
    							"profile", 
    							Array(
    							"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
    							),
    							false
    						);?>
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
                </div>
            </div>
        </div>
    </div>
<?else:
    LocalRedirect("/auth/");
endif?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>