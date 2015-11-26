<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "&laquo;Arteva Home&raquo; - SALE");
$APPLICATION->SetPageProperty("keywords", "&laquo;Arteva Home&raquo; SALE");
$APPLICATION->SetPageProperty("description", "SALE. &laquo;Arteva Home&raquo;");
$APPLICATION->SetTitle("SALE");?>
<?
CModule::IncludeModule("catalog");


// $pos = strripos($_SERVER['HTTP_REFERER'], "bigbuzzy.ru");
// if ($pos === false) {
// } else {


if( empty($_COOKIE["bigbuzzy"]) || !isset($_COOKIE["bigbuzzy"]))
{
	setCookie('bigbuzzy', "Y", time() + 60 * 24 * 3600, '/', 'www.arteva.ru');
	CCatalogDiscountCoupon::SetCoupon("bigbuzzy");
	
	?> <script> document.location="http://www.arteva.ru/catalog/salebb/"; </script> <?
	
	// LocalRedirect("http://www.arteva.ru/catalog/salebb/");
}

$GLOBALS["arrFilterSectionSale"] = array(
	// ">=catalog_PRICE_1" => $_REQUEST["priceMin"],
	// "<=catalog_PRICE_1" => $_REQUEST["priceMax"],
	">=catalog_QUANTITY" => 1,
	// "!PROPERTY_SALE" => 1
	// "PROPERTY_ARTIKUL" => "ACH9000/6 PB"
);

?>
<div class="outer-content-wrapper2">
	<img src="skidki_banner2.png" style=""/>
</div>
<div class="outer-content-wrapper2">
	<?
	$ELEMENT_SORT_FIELD = "PROPERTY_SALE";
	$ELEMENT_SORT_ORDER = "desc";
	$SECTION_ID = "664";	
	// фильтр по свойству Тип светильника
	if( !empty($_GET["TIP_SV1"]) && isset($_GET["TIP_SV1"]) )
		$GLOBALS["arrFilterSectionSale"]["PROPERTY_TIP_SVETILNIKA"][] = $_GET["TIP_SV1"];
	if( !empty($_GET["TIP_SV2"]) && isset($_GET["TIP_SV2"]) )
		$GLOBALS["arrFilterSectionSale"]["PROPERTY_TIP_SVETILNIKA"][] = $_GET["TIP_SV2"];
	if( !empty($_GET["TIP_SV4"]) && isset($_GET["TIP_SV4"]) )
		$GLOBALS["arrFilterSectionSale"]["PROPERTY_TIP_SVETILNIKA"][] = $_GET["TIP_SV4"];
	if( !empty($_GET["TIP_SV3"]) && isset($_GET["TIP_SV3"]) )
		foreach(explode(",", $_GET["TIP_SV3"]) as $val )
			$GLOBALS["arrFilterSectionSale"]["PROPERTY_TIP_SVETILNIKA"][] = $val;
	
	// Фильтр по разделам
	if( !empty($_GET["SEC2"]) && isset($_GET["SEC2"]) ){
		$SECTION_ID = "";
		$GLOBALS["arrFilterSectionSale"]["SECTION_ID"][] = $_GET["SEC2"];	
	}
	
	if( !empty($_GET["SEC1"]) && isset($_GET["SEC1"]) ){
		$SECTION_ID = "";
		foreach(explode(",", $_GET["SEC1"]) as $val )
			$GLOBALS["arrFilterSectionSale"]["SECTION_ID"][] = $val;
	}
	
	// Фильтр по свойству Место установки
	if( !empty($_GET["PLACE1"]) && isset($_GET["PLACE1"]) )
		$GLOBALS["arrFilterSectionSale"]["PROPERTY_PLACE_MOUTING"][] = $_GET["PLACE1"];	
	if( !empty($_GET["PLACE2"]) && isset($_GET["PLACE2"]) )
		$GLOBALS["arrFilterSectionSale"]["PROPERTY_PLACE_MOUTING"][] = $_GET["PLACE2"];		
	if( !empty($_GET["PLACE3"]) && isset($_GET["PLACE3"]) )
		$GLOBALS["arrFilterSectionSale"]["PROPERTY_PLACE_MOUTING"][] = $_GET["PLACE3"];		
	if( !empty($_GET["PLACE4"]) && isset($_GET["PLACE4"]) )
		$GLOBALS["arrFilterSectionSale"]["PROPERTY_PLACE_MOUTING"][] = $_GET["PLACE4"];		
	if( !empty($_GET["PLACE5"]) && isset($_GET["PLACE5"]) )
		$GLOBALS["arrFilterSectionSale"]["PROPERTY_PLACE_MOUTING"][] = $_GET["PLACE5"];		

	
	if(isset($_GET["price_sort"])){
		$ELEMENT_SORT_FIELD = "catalog_PRICE_1";
		$ELEMENT_SORT_ORDER = "desc";
	}
	if(isset($_GET["price_sort2"])){
		$ELEMENT_SORT_FIELD = "catalog_PRICE_1";
		$ELEMENT_SORT_ORDER = "asc";
	}
	$PAGE_ELEMENT_COUNT = "24";
	if(isset($_GET["showall"]) && $_GET["showall"] == "Y"){
		$PAGE_ELEMENT_COUNT = "10000";
	}
	
	// PR($GLOBALS["arrFilterSectionSale"]);
	include($_SERVER["DOCUMENT_ROOT"]."/include/catalog_filter_bb_2.php"); // Фильтр отправляет данные на адресс
	?>
</div>
	
	
<div class="outer-content-wrapper">
    <div class="content-wrapper">
        <?
		// $APPLICATION->IncludeComponent(
	        // "bitrix:breadcrumb",
	        // "bread",
	        // Array(
	            // "START_FROM" => "0",
	            // "PATH" => "",
	            // "SITE_ID" => "-"
	        // )
	    // );
        $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "catalog_new_sale_bb",
            Array(
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => "17",
                "SECTION_ID" => $SECTION_ID,
                "SECTION_CODE" => "",
                "SECTION_USER_FIELDS" => array(""),
				"ELEMENT_SORT_FIELD" => $ELEMENT_SORT_FIELD,
				"ELEMENT_SORT_ORDER" => $ELEMENT_SORT_ORDER,
				"ELEMENT_SORT_FIELD2" => "name",
				"ELEMENT_SORT_ORDER2" => "asc",
                "FILTER_NAME" => "arrFilterSectionSale",
                "INCLUDE_SUBSECTIONS" => "Y",
                "SHOW_ALL_WO_SECTION" => "Y",
                "HIDE_NOT_AVAILABLE" => "N",
                "PAGE_ELEMENT_COUNT" => $PAGE_ELEMENT_COUNT,
                "LINE_ELEMENT_COUNT" => "1",
                "PROPERTY_CODE" => array("PRICE", "NEW", "BRAND", "STYLE", "SVET_MATERIAL", "MEBEL_MATERIAL", "INTERIER_MATERIAL", "PLACE_MOUTING", "REPLICA", "COLOR", "", ""),
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
        );?>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>