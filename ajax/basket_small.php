<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'):
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    /**
     * $_GET["action"] = ADD2BASKET or DEL2BASKET or UPDATE2BASKET
     * $_GET["QUANTITY"] = count products add on basket
     * $_GET["id"] = id product
     */
    if (CModule::IncludeModule("catalog") && CModule::IncludeModule("sale")):
        $action = $_GET["action"];
        if ($action == "ADD2BASKET"):
            $PRODUCT_ID = intval($_GET["id"]);
            $QUANTITY = intval($_GET["QUANTITY"]);
            if ($action == "ADD2BASKET" && intval($PRODUCT_ID) > 0 && intval($QUANTITY) > 0):
                $arPropItem = getItemCart($arItem["PRODUCT_ID"]);
                $arProps = array();
                $arProps = array(
                    array(
                        "NAME" => "Артикул",
                        "CODE" => "ARTIKUL",
                        "VALUE" => $arPropItem["PROPERTY_ARTIKUL_VALUE"],
                        "SORT" => 100
                        ),
                    array(
                        "NAME" => "Наличие",
                        "CODE" => "DEPOSIT",
                        "VALUE" => ($arPropItem["CATALOG_PROP"]["QUANTITY"] < 2) ? "N" : "Y",
                        "SORT" => 200
                        )
                    );
                if (!Add2BasketByProductID($PRODUCT_ID, $QUANTITY, array(), $arProps)):
                    exit();
                endif;
            endif;
        elseif ($action == "UPDATE2BASKET"):
            if (is_array($_GET["items"])):
                foreach ($_GET["items"] as $key => $arItems) :
                    $PRODUCT_ID = intval($arItems["id"]);
                    $QUANTITY = intval($arItems["count"]);
                    $arFields = array(
                       "QUANTITY" => $QUANTITY,
                    );
                    if (!CSaleBasket::Update($PRODUCT_ID, $arFields)):
                        exit();
                    endif;
                endforeach;
            endif;
        elseif ($action == "DEL2BASKET"):
            $DELETE = intval($_GET["id"]);
            if (!CSaleBasket::Delete($DELETE)):
                exit();
            endif;
        endif;
    endif;
    $APPLICATION->IncludeComponent(
        "bitrix:sale.basket.basket.small",
        "footer_cart",
        Array(
            "PATH_TO_BASKET" => "/personal/cart/",
            "PATH_TO_ORDER" => "/personal/order/make/",
            "SHOW_DELAY" => "Y",
            "SHOW_NOTAVAIL" => "Y",
            "SHOW_SUBSCRIBE" => "Y"
        )
    );
endif;