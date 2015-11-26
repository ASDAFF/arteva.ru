<?php
// меняем ORDER_ID на Номер заказа, при отправки письма о новом заказе
AddEventHandler("sale", "OnOrderNewSendEmail", Array("SaleHandlerNewOrder", "OnOrderNewSendEmailHandler"));
class SaleHandlerNewOrder
{
    // создаем обработчик события "OnOrderNewSendEmailHandler"
    function OnOrderNewSendEmailHandler($ID, &$eventName, &$arFields)
    {
      $arFields['ORDER_ID'] = getNumberOrder($ID);
   }
}
// меняем ORDER_ID на Номер заказа, при смене статусов в письме
AddEventHandler("sale", "OnOrderStatusSendEmail", Array("SaleHandler", "OnOrderStatusSendEmailHandler"));
class SaleHandler
{
    // создаем обработчик события "OnOrderStatusSendEmailHandler"
    function OnOrderStatusSendEmailHandler($ID, &$eventName, &$arFields, $numberStatus)
    {
      $arFields['ORDER_ID'] = getNumberOrder($ID);
   }
}
/**
 * [getNumberOrder description]
 * @param  int $ID
 * @return str or false
 */
function getNumberOrder($ID){
    if (!CModule::IncludeModule('sale') && !CModule::IncludeModule('catalog') && !CModule::IncludeModule('iblock')):
        return false;
    endif;
    $arOrder = CSaleOrder::GetByID($ID);
    if ($arOrder):
        return $arOrder["ACCOUNT_NUMBER"];
    endif;
    return false;
}
/**
 * [getPayAction description]
 * @return bool
 */
function getPayAction(){
    if (!CModule::IncludeModule('sale')):
        return false;
    endif;
    global $USER;
    $arBasketItems = array();
    $dbBasketItems = CSaleBasket::GetList(
        array("NAME" => "ASC", "ID" => "ASC"),
        array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"),
        false,
        false,
        array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "DELAY",
            "CAN_BUY", "PRICE", "WEIGHT", "NAME", "CURRENCY", "CATALOG_XML_ID", "VAT_RATE",
            "NOTES", "DISCOUNT_PRICE", "PRODUCT_PROVIDER_CLASS", "DIMENSIONS", "TYPE", "SET_PARENT_ID", "DETAIL_PAGE_URL"
            )
        );
    while ($arItem = $dbBasketItems->Fetch()){
        $arPropItem = getItemCart($arItem["PRODUCT_ID"]);
        if ($arPropItem["CATALOG_PROP"]["QUANTITY"] < 2):
            return false;
        endif;
    }
    return true;
}
/**
 * [waterImage description]
 * @param  int $imgId
 * @return array
 */
function waterImage($imgId){
    $arFile = CFile::GetFileArray($imgId);
    $arFilters = Array(
        array(
            "name" => "watermark", 
            "position" => "bottomleft", 
            "size" => "real", 
            "alpha_level" => "50",
            "file" => $_SERVER['DOCUMENT_ROOT']."/img/watermark.png"
        ),
    );
    $width = $arFile["WIDTH"];
    $height = $arFile["HEIGHT"];
    $resultImage = CFile::ResizeImageGet(
        $arFile, 
        array('width'=>$width, 'height'=>$height), 
        BX_RESIZE_IMAGE_PROPORTIONAL, 
        true, 
        $arFilters
    );
    return $resultImage;
}
/**
 * [ogItem description]
 * @param  string $el
 * @return array or false
 */
function ogItem($el){
    $arSelect = Array("ID", "CODE", "PREVIEW_PICTURE", "NAME", "PROPERTY_ARTIKUL", "DETAIL_TEXT", "PROPERTY_OPIS");
    $arFilter = Array("IBLOCK_ID" => 17, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "CODE" => $el);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    if($ob = $res->GetNextElement())
    {
        $arItem = $ob->GetFields();
    }
    if (!empty($arItem)):
        return $arItem;
    else:
        return false;
    endif;
}
/**
 * [getSeoProducts description]
 * @param  array $arParams
 * @return array
 */
function getSeoProducts($arParams){
    global $USER;
    $arSelect = Array();
    $arFilter = Array("IBLOCK_ID"=>22, "ACTIVE"=>"Y", "ID" => $arParams["ID"]);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    if($ob = $res->GetNextElement())
    {
        $seo_items = $ob->GetFields();
        $seo_items["PROPERTIES"] = $ob->GetProperties();
        foreach ($seo_items["PROPERTIES"]["PRODUCTS"]["VALUE"] as $key => $idProd) :
            $arSelectProd = Array("ID", "NAME", "PREVIEW_PICTURE", "PROPERTY_ARTIKUL", "PROPERTY_PRICE", "PROPERTY_OLD_PRICE", "PROPERTY_NEW", "PROPERTY_HIT", "PROPERTY_SALE", "DETAIL_PAGE_URL");
            $arFilterProd = Array("IBLOCK_ID"=>17, "ACTIVE"=>"Y", "ID" => $idProd);
            $resProd = CIBlockElement::GetList(Array(), $arFilterProd, false, false, $arSelectProd);
            while($obProd = $resProd->GetNextElement())
            {
                $arItem = $obProd->GetFields();
                $dbPrice = CPrice::GetList(
                    array("QUANTITY_FROM" => "ASC", "QUANTITY_TO" => "ASC", "SORT" => "ASC"),
                    array("PRODUCT_ID" => $arItem["ID"]),
                    false,
                    false,
                    array("ID", "CATALOG_GROUP_ID", "PRICE", "CURRENCY", "QUANTITY_FROM", "QUANTITY_TO")
                    );
                if($arPrice = $dbPrice->Fetch()):
                    $arDiscounts = CCatalogDiscount::GetDiscountByPrice($arPrice["ID"], $USER->GetUserGroupArray(), "N", SITE_ID);
                    $discountPrice = CCatalogProduct::CountPriceWithDiscount($arPrice["PRICE"], $arPrice["CURRENCY"], $arDiscounts);
                    $arPrice["DISCOUNT_VALUE"] = $discountPrice;
                    $arItem["PRICES"] = $arPrice;
                endif;
                $arProducts[] = $arItem;
            }
        endforeach;
        return $arProducts;
    }
}
/**
 * [findElements description]
 * @param  stirng $el
 * @param  int $ib
 * @return bool
 */
function findElements($el, $ib){
    if ($el && $ib && CModule::IncludeModule('iblock')):
        $arSelect = Array("ID", "CODE");
        $arFilter = Array(
        "IBLOCK_ID" => $ib, 
        "ACTIVE_DATE" => "Y", 
        "ACTIVE" => "Y",
        "CODE" => $el
        );
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        if($ob = $res->GetNextElement())
        {
            $items = $ob->GetFields();
        }
        if (!empty($items)):
            return true;
        else:
            return false;
        endif;
    else:
        return false;
    endif;
}
/**
 * [findSection description]
 * @param  string $section
 * @param  int $ib
 * @return bool
 */
function findSection($section, $ib){
    if ($section && $ib && CModule::IncludeModule('iblock')):
        $arFilter = Array(
            'IBLOCK_ID' => $ib,
            'GLOBAL_ACTIVE'=>'Y',
            'CODE' => $section
            );
        $db_list = CIBlockSection::GetList(Array(), $arFilter, true);
        if($ar_result = $db_list->GetNext())
        {
            $secItems = $ar_result;
        }
        if (!empty($secItems)):
            return true;
        else:
            return false;
        endif;
    else:
        return false;
    endif;
}
/**
 * [getItemCart description]
 * @param  int $id id products
 * @return array
 */
function getItemCart($id){
    if (!CModule::IncludeModule('iblock')):
        return false;
    endif;
    $arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "PROPERTY_ARTIKUL", "DETAIL_PAGE_URL", "PROPERTY_COLOR", "PROPERTY_OLD_PRICE", "PROPERTY_PRICE", "IBLOCK_SECTION_ID");
    $arFilter = Array("IBLOCK_ID" => 17, "ACTIVE" => "Y", "ID" => $id);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    if($ob = $res->GetNextElement())
    {
        $arItem = $ob->GetFields();
        $ar_res = CCatalogProduct::GetByID($arItem["ID"]);
        $arItem["SECTION"] = get_first_level_section($arItem["IBLOCK_SECTION_ID"]);
        $arItem["CATALOG_PROP"] = $ar_res; 
        return $arItem;
    }
    return false;
}
/**
 * [getPropOnBasket description]
 * @param  int $id
 * @return array or false
 */
function getPropOnBasket($id){
    if (!CModule::IncludeModule('iblock')):
        return false;
    endif;
    $arSelect = Array("ID", "NAME", "PROPERTY_ARTIKUL", "PROPERTY_ID_PROD");
    $arFilter = Array("IBLOCK_ID" => 17, "ACTIVE" => "Y", "ID" => $id);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    if($ob = $res->GetNextElement())
    {
        return $ob->GetFields();
    }
    return false;
}
/**
 * [getPaySystemName description]
 * @param  int $PAY_SYSTEM_ID
 * @return str
 */
function getPaySystemName($PAY_SYSTEM_ID){
    if (CModule::IncludeModule('sale')):
        $arPaySys = CSalePaySystem::GetByID($PAY_SYSTEM_ID);
        return $arPaySys["NAME"];
    endif;
}
/**
 * [getBasketOrder description]
 * @return bool
 */
function getBasketOrder(){
    $arBasketItems = array();
    $dbBasketItems = CSaleBasket::GetList(
        array("ID" => "ASC"),
        array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"),
        false,
        false,
        array("ID")
        );
    if($arItems = $dbBasketItems->Fetch())
    {
        return true;
    }
    return false;
}
/**
 * [getOrder description]
 * @param  int $ORDER_ID
 * @return array or false
 */
function getOrder($ORDER_ID){
    if (!CModule::IncludeModule('sale')):
        return false;
    endif;
    return CSaleOrder::GetByID($ORDER_ID);
}
/**
 * [updateBasketPreOrder description]
 * @return true
 */
function updateBasketPreOrder(){
    if (!CModule::IncludeModule('sale')):
        return false;
    endif;
    global $USER;
    $arBasketItems = array();
    $dbBasketItems = CSaleBasket::GetList(
        array("NAME" => "ASC", "ID" => "ASC"),
        array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"),
        false,
        false,
        array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "DELAY",
            "CAN_BUY", "PRICE", "WEIGHT", "NAME", "CURRENCY", "CATALOG_XML_ID", "VAT_RATE",
            "NOTES", "DISCOUNT_PRICE", "PRODUCT_PROVIDER_CLASS", "DIMENSIONS", "TYPE", "SET_PARENT_ID", "DETAIL_PAGE_URL"
            )
        );
    while ($arItem = $dbBasketItems->Fetch()){
        $arPropItem = getItemCart($arItem["PRODUCT_ID"]);
        $arFields = array();
        $arFields = array(
            "PROPS" => array(
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
                )
            );
        CSaleBasket::Update($arItem["ID"], $arFields);
    }
    return true;
}
/**
 * [addOrder функция добавления заказа]
 * @param array $arParams
 * @return array or false
 */
function addOrder($arParams){
    if (!CModule::IncludeModule('sale')):
        return false;
    endif;
    global $USER; global $DB;
    $addCommentsOrder = false;
    $commentForManager = "";
    updateBasketPreOrder(); // обновляем корзину
    $arBasketItems = array();
    $dbBasketItems = CSaleBasket::GetList(
        array("NAME" => "ASC", "ID" => "ASC"),
        array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"),
        false,
        false,
        array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "DELAY",
            "CAN_BUY", "PRICE", "WEIGHT", "NAME", "CURRENCY", "CATALOG_XML_ID", "VAT_RATE",
            "NOTES", "DISCOUNT_PRICE", "PRODUCT_PROVIDER_CLASS", "DIMENSIONS", "TYPE", "SET_PARENT_ID", "DETAIL_PAGE_URL"
            )
        );
    while ($arItem = $dbBasketItems->Fetch())
    {
        $arPropItem = getItemCart($arItem["PRODUCT_ID"]);
        $db_res = CSaleBasket::GetPropsList(
            array("SORT" => "ASC", "NAME" => "ASC"), 
            array("BASKET_ID" => $arItem['ID']), 
            false, 
            array()
            ); 
        while($ar_res = $db_res->Fetch()){ 
            if ($ar_res["CODE"] == "DEPOSIT" && $ar_res["VALUE"] == "N"):
                $addCommentsOrder = true;
            endif;
        }
        $arBasketItems[] = $arItem;
        $arItem["ARTIKUL"] = $arPropItem["PROPERTY_ARTIKUL_VALUE"];
        $strOrderList .= '<a href="http://'.$_SERVER["HTTP_HOST"].$arItem["DETAIL_PAGE_URL"].'">'.$arItem["ARTIKUL"].'</a> '.$arItem["NAME"].' - '.($arItem["QUANTITY"]*1).' шт. x '.SaleFormatCurrency($arItem["PRICE"], $arItem["CURRENCY"]);
        $strOrderList .= "<br />";
        $allDiscountItems += $arItem["DISCOUNT_PRICE"];
    }
    if (!$arBasketItems):
        return false;
    endif;
    $arOrderDat = CSaleOrder::DoCalculateOrder(
        SITE_ID,
        $USER->GetID(),
        $arBasketItems,
        1,
        $arUserResult["ORDER_PROP"],
        $arParams["DELIVERY_ID"],
        $arParams["PAY_SYSTEM_ID"],
        array(),
        $arErrors,
        $arWarnings
    );
    $arOrderDat["ORDER_PROP"][20] = $arParams["ORDER_PROP_20"];
    $arOrderDat["ORDER_PROP"][7] = $arParams["ORDER_PROP_7"];
    $arOrderDat["ORDER_PROP"][3] = $arParams["ORDER_PROP_3"];
    //echo "<pre>";print_r($PRICE);echo "</pre>";die();
    //echo "<pre>";print_r($arOrderDat);echo "</pre>";die();
    //echo "<pre>";print_r($arParams);echo "</pre>";die();
    $arFields = array(
       "LID" => SITE_ID,
       "PERSON_TYPE_ID" => 1,
       "PAYED" => "N",
       "CANCELED" => "N",
       "STATUS_ID" => "N",
       "PRICE" => $arOrderDat["ORDER_PRICE"],
       "CURRENCY" => $arOrderDat["CURRENCY"],
       "USER_ID" => IntVal($USER->GetID()),
       "PAY_SYSTEM_ID" => $arOrderDat["PAY_SYSTEM_ID"],
       "PRICE_DELIVERY" => $arOrderDat["PRICE_DELIVERY"],
       "DELIVERY_ID" => $arOrderDat["DELIVERY_ID"],
       "DISCOUNT_VALUE" => $arOrderDat["DISCOUNT_VALUE"],
       "TAX_VALUE" => $arOrderDat["TAX_VALUE"],
       "DELIVERY_LOCATION" => $arOrderDat["DELIVERY_LOCATION"],
       "USER_DESCRIPTION" => $arParams["ORDER_DESCRIPTION"],
       "COMMENTS" => $commentForManager
    );
    $ORDER_ID = (int)CSaleOrder::DoSaveOrder($arOrderDat, $arFields, 0, $arResult["ERROR"]);
    if ($ORDER_ID > 0):
        $arOrder = getOrder($ORDER_ID);
        // для менеджера
        if ($addCommentsOrder === true && $arParams["PAY_SYSTEM_ID"] == 10): // сообщение для менеджера
            $commentForManager .= 'Выбран способ оплаты PayKeeper, но в заказе есть товары "По запросу".';
            $commentForManager .= "\n";
            $commentForManager .= "Ссылка для оплаты: http://".$_SERVER["HTTP_HOST"]."/personal/order/payment/?ORDER_ID=".$ORDER_ID;
            $arFields = array(
                "COMMENTS" => $commentForManager
                );
            CSaleOrder::Update($ORDER_ID, $arFields);
        endif;
        // отправляем письмо
        $arFieldsEvent = array(
            //"ORDER_ID" => $ORDER_ID,
            "ORDER_ID" => getNumberOrder($ORDER_ID),
            "ORDER_DATE" => Date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT", SITE_ID))),
            "ORDER_USER" => $USER->GetFormattedName(false),
            "PRICE" => SaleFormatCurrency($arOrderDat["ORDER_PRICE"], $arOrderDat["CURRENCY"]),
            "BCC" => COption::GetOptionString("sale", "order_email", "order@".$SERVER_NAME),
            "EMAIL" => (strlen($arUserResult["USER_EMAIL"])>0 ? $arUserResult["USER_EMAIL"] : $USER->GetEmail()),
            "ORDER_LIST" => $strOrderList,
            "SALE_EMAIL" => COption::GetOptionString("sale", "order_email", "order@".$SERVER_NAME),
            "DISCOUNT" => $allDiscountItems." руб.",
            "DELIVERY_PRICE" => "",
            "DELIVERY_TYPE" => getDeliveryName($arOrderDat["DELIVERY_ID"]),
            "ADDRESS" => (strlen($arParams["ORDER_PROP_7"])>0) ? $arParams["ORDER_PROP_7"] : "Адрес не указан",
            "COMMENT" => (strlen($arParams["ORDER_DESCRIPTION"])>0) ? $arParams["ORDER_DESCRIPTION"] : "Нет комментария"
        );
        //Формируем писмо для отправки менеджеру
        switch ($arParams["PAY_SYSTEM_ID"]) 
        {
            case 10:
                $price_method = 'Оплата банковской картой VISA, MASTERCARD, MAESTRO';
                break;
            case 8:
                $price_method = 'Безналичный расчет';
                break;
            case 1:
                $price_method = 'Наличными при получении';
                break;                                
        }
        $rsGroups = CGroup::GetList($by = "c_sort", $order = "asc", array("ID" => implode('|',$USER->GetUserGroupArray())));
        $groups = array();
        if(intval($rsGroups->SelectedRowsCount()) > 0)
        {
           while($arGroups = $rsGroups->Fetch())
           {
                if ((int)$arGroups['ID'] != 2 && (int)$arGroups['ID'] != 3 && (int)$arGroups['ID'] != 4)
                {
                    $groups[] = $arGroups['NAME'];
                }
                    
           }
        } 
        $arFieldsManager = array(
            //'NUMBER' => $ORDER_ID,
            'NUMBER' => getNumberOrder($ORDER_ID),
            'DATE' => Date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT", SITE_ID))),
            'SELLER_TYPE' => implode(',', $groups),
            'FIO' => $USER->GetFormattedName(false),
            'PHONE' => (strlen($arParams["ORDER_PROP_3"])>0) ? $arParams["ORDER_PROP_3"] : "Телефон не указан",
            'EMAIL' => $USER->GetEmail(),
            'ADRESS' =>(strlen($arParams["ORDER_PROP_7"])>0) ? $arParams["ORDER_PROP_7"] : "Адрес не указан",
            'DOSTAVKA' => getDeliveryName($arOrderDat["DELIVERY_ID"]),
            'PRICE_METHOD' => $price_method,
            'ORDERS' => $strOrderList.'<br />Итого: '.$arOrderDat["ORDER_PRICE"],
            'DISCOUNT' => $allDiscountItems." руб.",
            'COMMENT' => (strlen($arParams["ORDER_DESCRIPTION"])>0) ? $arParams["ORDER_DESCRIPTION"] : "Нет комментария"
            );
        $eventName = "SALE_NEW_ORDER";
        $eventNameManager = "FORM_FILLING_NEW_ORDER";
        $bSend = true;
        foreach(GetModuleEvents("sale", "OnOrderNewSendEmail", true) as $arEvent)
            if (ExecuteModuleEventEx($arEvent, Array($arResult["ORDER_ID"], &$eventName, &$arFields))===false)
                $bSend = false;

        if($bSend):
            $event = new CEvent;
            $event->Send($eventName, SITE_ID, $arFieldsEvent, "N");
            $event->Send($eventNameManager, SITE_ID, $arFieldsManager, "N");
        endif;
        return $ORDER_ID;
    endif;
    return false;
}
/**
 * [getPaySystem description]
 * @return array or false
 */
function getPaySystem(){
    if (CModule::IncludeModule('sale')):
        $db_ptype = CSalePaySystem::GetList(
            Array("SORT"=>"ASC", "ID"=>"ASC"), 
            Array("ACTIVE" => "Y")
            );
        while($ptype = $db_ptype->Fetch())
        {
           $arPaySystem[] = $ptype;
        }
        return $arPaySystem;
    endif;
    return false;
}
/**
 * [getDeliveryName description]
 * @param  int $DELIVERY_ID
 * @return string or false
 */
function getDeliveryName($DELIVERY_ID){
    if (CModule::IncludeModule('sale')):
        $db_dtype = CSaleDelivery::GetList(
            array("SORT" => "ASC", "ID" => "ASC"),
            array("LID" => SITE_ID, "ACTIVE" => "Y", "ID" => $DELIVERY_ID),
            false,
            false,
            array()
            );
        if($ar_dtype = $db_dtype->Fetch())
        {
            $arDelivery = $ar_dtype; 
        }
        return $arDelivery["NAME"];
    endif;
    return false;
}
/**
 * [getDelivery description]
 * @return array or false
 */
function getDelivery(){
    if (CModule::IncludeModule('sale')):
        $db_dtype = CSaleDelivery::GetList(
            array("SORT" => "ASC", "ID" => "ASC"),
            array("LID" => SITE_ID, "ACTIVE" => "Y"),
            false,
            false,
            array()
            );
        while($ar_dtype = $db_dtype->Fetch())
        {
            $arDelivery[] = $ar_dtype; 
        }
        return $arDelivery;
    endif;
    return false;
}
function getOrderConfirm($ORDER_ID){
    CModule::IncludeModule('iblock');
    CModule::IncludeModule('sale');
    $ar_sales = CSaleOrder::GetByID($ORDER_ID);
    if ($ar_sales):
        $db_props = CSaleOrderPropsValue::GetOrderProps($ar_sales["ID"]);
        $arPropsAll = array();
        while ($arProps = $db_props->Fetch())
        {
            $ar_sales["PROPERTIES"][] = $arProps;
        }
        $arFields = array();
        $dbBasketItems = CSaleBasket::GetList(
            array("NAME" => "ASC", "ID" => "ASC"),
            array("LID" => SITE_ID, "ORDER_ID" => $ar_sales["ID"]),
            false,
            false,
            array()
            );
        while ($arItems = $dbBasketItems->Fetch())
        {
            $db_res = CSaleBasket::GetPropsList(
                array("SORT" => "ASC", "NAME" => "ASC"), 
                array("BASKET_ID" => $arItems['ID']), 
                false, 
                array()
                ); 
            while($ar_res = $db_res->Fetch()){ 
                $arPropOrderItems[] = $ar_res;
            }
            $arProducts = getItemCart($arItems["PRODUCT_ID"]);
            $arItems["PRODUCTS"] = $arProducts;
            $arItems["PROP_ORDER_ITEMS"] = $arPropOrderItems;
            $arItems["SECTION_NAME"] = "";
            $ar_sales["ITEMS"][] = $arItems;
        }
    endif;
    return $ar_sales;
}
/**
 * [getAllOredersUser description]
 * @param  int $idUser
 * @return array or false
 */
function getAllOredersUser($idUser){
    CModule::IncludeModule('iblock');
    CModule::IncludeModule('sale');
    $arFilter = Array("USER_ID" => $idUser);
    $db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "DESC"), $arFilter);
    while($ar_sales = $db_sales->Fetch()):
        $db_props = CSaleOrderPropsValue::GetOrderProps($ar_sales["ID"]);
        $arPropsAll = array();
        while ($arProps = $db_props->Fetch())
        {
            $ar_sales["PROPERTIES"][] = $arProps;
        }
        $arFields = array();
        $dbBasketItems = CSaleBasket::GetList(
            array("NAME" => "ASC", "ID" => "ASC"),
            array("LID" => SITE_ID, "ORDER_ID" => $ar_sales["ID"]),
            false,
            false,
            array()
            );
        while ($arItems = $dbBasketItems->Fetch())
        {
            $db_res = CSaleBasket::GetPropsList(
                array("SORT" => "ASC", "NAME" => "ASC"), 
                array("BASKET_ID" => $arItems['ID']), 
                false, 
                array()
                ); 
            while($ar_res = $db_res->Fetch()){ 
                $arPropOrderItems[] = $ar_res;
            }
            $arProducts = getItemCart($arItems["PRODUCT_ID"]);
            $arItems["PRODUCTS"] = $arProducts;
            $arItems["PROP_ORDER_ITEMS"] = $arPropOrderItems;
            $ar_sales["ITEMS"][] = $arItems;
        }
        if ($ar_sales):
            $arOreders[] = $ar_sales;
        endif;
    endwhile;
    return $arOreders;
}
/**
 * [getOrederLk description]
 * @param  int $idUser
 * @return array
 */
function getOrederLk($idUser){
    CModule::IncludeModule('iblock');
    CModule::IncludeModule('sale');
    $arFilter = Array("USER_ID" => $idUser);
    $db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "DESC"), $arFilter);
    if($ar_sales = $db_sales->Fetch()):
        $db_props = CSaleOrderPropsValue::GetOrderProps($ar_sales["ID"]);
        $arPropsAll = array();
        while ($arProps = $db_props->Fetch())
        {
            $ar_sales["PROPERTIES"][] = $arProps;
        }
        $arFields = array();
        $dbBasketItems = CSaleBasket::GetList(
            array("NAME" => "ASC", "ID" => "ASC"),
            array("LID" => SITE_ID, "ORDER_ID" => $ar_sales["ID"]),
            false,
            false,
            array()
            );
        while ($arItems = $dbBasketItems->Fetch())
        {
            $db_res = CSaleBasket::GetPropsList(
                array("SORT" => "ASC", "NAME" => "ASC"), 
                array("BASKET_ID" => $arItems['ID']), 
                false, 
                array()
                ); 
            while($ar_res = $db_res->Fetch()){ 
                $arPropOrderItems[] = $ar_res;
            }
            $arProducts = getItemCart($arItems["PRODUCT_ID"]);
            $arItems["PRODUCTS"] = $arProducts;
            $arItems["PROP_ORDER_ITEMS"] = $arPropOrderItems;
            $ar_sales["ITEMS"][] = $arItems;
        }
        return $ar_sales;
    endif;
}
/**
 * [get_first_level_section description]
 * @param int $sectionID
 * @return array
 */
function get_first_level_section($sectionID) {
    $dbResult = CIBlockSection::GetList(
        array(),
        array('ACTIVE' => 'Y', 'ID' => $sectionID),
        false
    );
    $section = $dbResult->Fetch();
    if ($section['DEPTH_LEVEL'] == 1) {
        return $section;
    } else {
        $dbResult = CIBlockSection::GetNavChain(17, $section['ID']);
        return $dbResult->Fetch();
    }
}
?>