<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Поиск");
$APPLICATION->SetPageProperty("keywords", "Поиск");
$APPLICATION->SetPageProperty("description", "Поиск");
$APPLICATION->SetTitle("Поиск");?>
<?
if ($_GET["onthepage"]):
    $pageCount = $_GET["onthepage"];
else:
    $pageCount = 6;
endif;
if ($_GET["search"] == "all"):
    $APPLICATION->IncludeComponent(
        "bitrix:search.page",
        "search_all",
        Array(
            "USE_SUGGEST" => "N",
            "PATH_TO_USER_PROFILE" => "",
            "AJAX_MODE" => "N",
            "RESTART" => "Y",
            "NO_WORD_LOGIC" => "N",
            "USE_LANGUAGE_GUESS" => "Y",
            "CHECK_DATES" => "N",
            "USE_TITLE_RANK" => "N",
            "DEFAULT_SORT" => "rank",
            "FILTER_NAME" => "",
            "SHOW_WHERE" => "N",
            "SHOW_WHEN" => "N",
            "PAGE_RESULT_COUNT" => $pageCount,
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "PAGER_TITLE" => "Результаты поиска",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "page",
            "arrFILTER" => array(
                "iblock_about",
                "iblock_brands",
                "iblock_contacts",
                "iblock_designers",
                "iblock_news",
                "iblock_pay",
                "iblock_projects",
                "iblock_salons"/*,
                "iblock_catalog"*/
                ),
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "SHOW_RATING" => "",
            "RATING_TYPE" => ""
        )
    );
elseif ($_GET["search"] == "" || $_GET["search"] == "products"):
    if ($_GET["onthepage"] == "all"):
        $pageCount = 9999999999;
    endif;
    /*$GLOBALS["arrFilterSearchCatalog"] = array(
        "PROPERTY_ARTIKUL" => "%".$_GET["q"]."%"
    );*/
	$GLOBALS["arrFilterSearchCatalog"] = array(
		array(
			"LOGIC" => "OR",
			"PROPERTY_ARTIKUL" => "%".$_GET["q"]."%",
			"NAME" => "%".$_GET["q"]."%",
			"DETAIL_TEXT" => "%".$_GET["q"]."%"
		),
	);
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "catalog_search",
        Array(
            "IBLOCK_TYPE" => "catalog",
            "IBLOCK_ID" => "17",
            "SECTION_ID" => "0",
            "SECTION_CODE" => "",
            "SECTION_USER_FIELDS" => array(""),
            "ELEMENT_SORT_FIELD" => "ACTIVE_FROM",
            "ELEMENT_SORT_ORDER" => "DESC",
            "ELEMENT_SORT_FIELD2" => "SORT",
            "ELEMENT_SORT_ORDER2" => "ASC",
            "FILTER_NAME" => "arrFilterSearchCatalog",
            "INCLUDE_SUBSECTIONS" => "Y",
            "SHOW_ALL_WO_SECTION" => "Y",
            "HIDE_NOT_AVAILABLE" => "N",
            "PAGE_ELEMENT_COUNT" => $pageCount,
            "LINE_ELEMENT_COUNT" => "1",
            "PROPERTY_CODE" => array("PRICE", "NEW"),
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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>