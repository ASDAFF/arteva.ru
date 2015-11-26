<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "&laquo;Arteva Home&raquo; - SALE");
$APPLICATION->SetPageProperty("keywords", "&laquo;Arteva Home&raquo; SALE");
$APPLICATION->SetPageProperty("description", "SALE. &laquo;Arteva Home&raquo;");
$APPLICATION->SetTitle("SALE");?>
<?
CModule::IncludeModule("catalog");


$pos = strripos($_SERVER['HTTP_REFERER'], "bigbuzzy.ru");
if ($pos === false) {
    // echo "0";
} else {
    echo "1";
	setCookie('bigbuzzy', "Y", time() + 60 * 24 * 3600, '/', 'www.arteva.ru');
	CCatalogDiscountCoupon::SetCoupon("bigbuzzy");
	?>
	<script>
		document.location="http://www.arteva.ru/catalog/salebb/";
	</script>
	<?
	// LocalRedirect("http://www.arteva.ru/catalog/salebb/");
}
// PR($_COOKIE["bigbuzzy"]);

$GLOBALS["arrFilterSectionSale"] = array(
	// ">=catalog_PRICE_1" => $_REQUEST["priceMin"],
	// "<=catalog_PRICE_1" => $_REQUEST["priceMax"],
	">=catalog_QUANTITY" => 1,
	// "PROPERTY_SALE" => 1
);

	
?>
<div class="outer-content-wrapper">
    <div class="content-wrapper">
        <?
		$APPLICATION->IncludeComponent(
	        "bitrix:breadcrumb",
	        "bread",
	        Array(
	            "START_FROM" => "0",
	            "PATH" => "",
	            "SITE_ID" => "-"
	        )
	    );
        $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "catalog_new_sale_bb",
            Array(
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => "17",
                "SECTION_ID" => "664",
                "SECTION_CODE" => "",
                "SECTION_USER_FIELDS" => array(""),
				"ELEMENT_SORT_FIELD" => "sort",
				"ELEMENT_SORT_ORDER" => "asc",
				"ELEMENT_SORT_FIELD2" => "name",
				"ELEMENT_SORT_ORDER2" => "asc",
                "FILTER_NAME" => "arrFilterSectionSale",
                "INCLUDE_SUBSECTIONS" => "Y",
                "SHOW_ALL_WO_SECTION" => "Y",
                "HIDE_NOT_AVAILABLE" => "N",
                "PAGE_ELEMENT_COUNT" => "24",
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
        );?>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>