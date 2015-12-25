<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'):
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    // поключаем фильтр request
    include_once($_SERVER["DOCUMENT_ROOT"]."/include/request_filter.php");

    if (CModule::IncludeModule('iblock')) {
        $arFilter = Array(
            'IBLOCK_ID'=> 17,
            'ID'=> $_REQUEST['section_id'],
        );

        $db_list = CIBlockSection::GetList(Array(), $arFilter, true);

        if($ar_result = $db_list->GetNext())
        {
            
            $GLOBALS['CATEGORY_CODE'] = $ar_result['CODE'];
            
        }
    }

    $GLOBALS["MATERIAL_PROP_CODE"] = $code_prop;

    $GLOBALS["arrFilterAjaxSection"] = array(
        ">=catalog_PRICE_1" => $_REQUEST["priceMin"],
        "<=catalog_PRICE_1" => $_REQUEST["priceMax"],
        ">=catalog_QUANTITY" => $deposit,
        "PROPERTY_".$code_prop."_VALUE" => $_REQUEST["filter-material"],
        "PROPERTY_BRAND_VALUE" => $_REQUEST["filter-brand"],
        "PROPERTY_STYLE_VALUE" => $_REQUEST["filter-style"],
        "PROPERTY_REPLICA_VALUE" => $_REQUEST["filter-replica"],
        "PROPERTY_COLOR_VALUE" => $_REQUEST["filter-color"],
        "PROPERTY_COLOR_BASE_VALUE" => $_REQUEST["filter-color-base"],
        "PROPERTY_PLACE_MOUTING_VALUE" => $_REQUEST["filter-place-mouting"],
        "PROPERTY_NEW" => $new,
        "PROPERTY_SALE" => $sale,
    );

	
	// if( $_REQUEST["sale_bb"] == 1 ) 
		// $template = "catalog_new_sale_bb"; 
	// else
		// $template = "section_catalog_filter"; 
	
	if($_REQUEST["sale_bb"] == 1){
		$sort1 = "PROPERTY_SALE";
	    $typeSort1 = "desc";
	}
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "section_catalog_filter",
        Array(
            "IBLOCK_TYPE" => "catalog",
            "IBLOCK_ID" => "17",
            "SECTION_ID" => $_REQUEST["section_id"],
            "SECTION_CODE" => "",
            "SECTION_USER_FIELDS" => array(""),
            "ELEMENT_SORT_FIELD" => $sort1,
            "ELEMENT_SORT_ORDER" => $typeSort1,
            "ELEMENT_SORT_FIELD2" => $sort2,
            "ELEMENT_SORT_ORDER2" => $typeSort2,
            "FILTER_NAME" => "arrFilterAjaxSection",
            "INCLUDE_SUBSECTIONS" => "Y",
            "SHOW_ALL_WO_SECTION" => "Y",
            "HIDE_NOT_AVAILABLE" => "N",
            "PAGE_ELEMENT_COUNT" => "20",
            "LINE_ELEMENT_COUNT" => "1",
            "PROPERTY_CODE" => array("PRICE", "NEW", "SALE"),
            "OFFERS_LIMIT" => "5",
            "TEMPLATE_THEME" => "",
            "PRODUCT_SUBSCRIPTION" => "N",
            "SHOW_DISCOUNT_PERCENT" => "N",
            "SHOW_OLD_PRICE" => "N",
            "SHOW_CLOSE_POPUP" => "N",
            "MESS_BTN_BUY" => "Купить",
            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
            "MESS_BTN_SUBSCRIBE" => "Подписаться",
            "MESS_BTN_DETAIL" => "Подробнее",
            "MESS_NOT_AVAILABLE" => "Нет в наличии",
            "SECTION_URL" => "",
            "DETAIL_URL" => "",
            "SECTION_ID_VARIABLE" => "SECTION_ID",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "N",
            "AJAX_OPTION_HISTORY" => "N",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_GROUPS" => "Y",
            "SET_TITLE" => "Y",
            "SET_BROWSER_TITLE" => "Y",
            "BROWSER_TITLE" => "-",
            "SET_META_KEYWORDS" => "Y",
            "META_KEYWORDS" => "-",
            "SET_META_DESCRIPTION" => "Y",
            "META_DESCRIPTION" => "-",
            "ADD_SECTIONS_CHAIN" => "Y",
            "SET_STATUS_404" => "N",
            "CACHE_FILTER" => "N",
            "ACTION_VARIABLE" => "action",
            "PRODUCT_ID_VARIABLE" => "id",
            "PRICE_CODE" => array("BASE"),
            "USE_PRICE_COUNT" => "N",
            "SHOW_PRICE_COUNT" => "1",
            "PRICE_VAT_INCLUDE" => "Y",
            "CONVERT_CURRENCY" => "N",
            "BASKET_URL" => "/personal/cart/",
            "USE_PRODUCT_QUANTITY" => "N",
            "ADD_PROPERTIES_TO_BASKET" => "Y",
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "PARTIAL_PRODUCT_PROPERTIES" => "N",
            "PRODUCT_PROPERTIES" => array(),
            "ADD_TO_BASKET_ACTION" => "ADD",
            "DISPLAY_COMPARE" => "N",
            "PAGER_TEMPLATE" => "page",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "Товары",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "Y"
        )
    );
endif;


?>