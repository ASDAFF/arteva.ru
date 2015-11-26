<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Изменить пароль");
$APPLICATION->SetPageProperty("keywords", "Изменить пароль");
$APPLICATION->SetPageProperty("description", "Изменить пароль");
$APPLICATION->SetTitle("Изменить пароль");?>
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
                <h1>Изменить пароль</h1>
                <div class="lk-section lk-section-main">
                    <div class="lk-content">
                        <div class="lk-inner-content">
                            <div class="common-form">
                                <?
                                    $viewInput = true;
                                    if ($_REQUEST["USER_PASSWORD"] && $_REQUEST["USER_CONFIRM_PASSWORD"] && strlen($_REQUEST["change_pwd"]) > 0):
                                        $arParams = array(
                                            "USER_PASSWORD" => $_REQUEST["USER_PASSWORD"],
                                            "USER_CONFIRM_PASSWORD" => $_REQUEST["USER_CONFIRM_PASSWORD"]
                                            );
                                        if (upPass($arParams)):
                                            $viewInput = false;
                                            echo '<p class="lk-success-message">Пароль изменен.</p>';
                                        else:
                                            echo '<p class="lk-error-message">Не удалось изменить пароль. Попробуйте позже.</p>';
                                        endif;
                                    endif;
                                ?>
                                <?if ($viewInput === true):?>
                                    <form method="post" action="" name="">
                                        <fieldset>
                                            <label for="lk-new-pass">Новый пароль</label>
                                            <input type="password" name="USER_PASSWORD" id="lk-new-pass" data-parsley-required />
                                        </fieldset>
                                        <fieldset>
                                            <label for="lk-new-pass2">Подтверждение</label>
                                            <input type="password" name="USER_CONFIRM_PASSWORD" id="lk-new-pass2" data-parsley-required data-parsley-equalto="#lk-new-pass"/>
                                        </fieldset>
                                        <fieldset class="form-submit-cnt">
                                            <input type="submit" class="small-btn" name="change_pwd" value="Изменить пароль" />
                                        </fieldset>
                                    </form>
                                <?endif?>
                            </div>
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