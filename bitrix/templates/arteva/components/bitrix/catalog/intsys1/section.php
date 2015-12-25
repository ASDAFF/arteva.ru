<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;


//var_dump($arResult);

$this->setFrameMode(true);

if (!isset($arParams['FILTER_VIEW_MODE']) || (string)$arParams['FILTER_VIEW_MODE'] == '')
    $arParams['FILTER_VIEW_MODE'] = 'VERTICAL';
$arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');
$verticalGrid = ('Y' == $arParams['USE_FILTER'] && $arParams["FILTER_VIEW_MODE"] == "VERTICAL");

$section_code = explode("/", $arResult["VARIABLES"]["SECTION_CODE_PATH"])[0];
$subsection_code = explode("/", $arResult["VARIABLES"]["SECTION_CODE_PATH"])[1];
$third_section_code = explode("/", $arResult["VARIABLES"]["SECTION_CODE_PATH"])[2];

$current_section = $section_code;
if ($subsection_code != false)
    $current_section = $subsection_code;


//получаем все значения брендов
$brandFilter = false;
$BRANDS_QUERY = CIBlockPropertyEnum::GetList(
    Array(
        "SORT" => "ASC",
        "VALUE" => "ASC"
    ),
    Array(
        "IBLOCK_ID" => "17",
        "CODE" => "BRAND"
    )
);
$i = 0;
while (($BRAND = $BRANDS_QUERY->Fetch()) != false) {
    $BRANDS[$i] = $BRAND;

//    test_dump(strtolower($BRAND["XML_ID"]) . " != " . strtolower($third_section_code));


    if (strtolower($BRAND["XML_ID"]) == strtolower($third_section_code)) {
        $brandFilter = true;
        $CURRENT_BRAND = $BRAND;
    }

    $i++;
}
//=================================

//test_dump($section_code);
//test_dump($subsection_code);
//test_dump($third_section_code);
//
//test_dump($brandFilter);

if (!findSection($current_section, 17) && $section_code != "new" && $section_code != "sale" && $section_code != "brands") {
    include($_SERVER["DOCUMENT_ROOT"] . "/404.php");
    die();
} elseif (!($third_section_code == false || $brandFilter == true)) {
    include($_SERVER["DOCUMENT_ROOT"] . "/404.php");
    die();
} elseif (($section_code == "new" || $section_code == "sale") && $third_section_code != false) {
    include($_SERVER["DOCUMENT_ROOT"] . "/404.php");
    die();
} elseif (($section_code == "new" || $section_code == "sale") && $subsection_code != false && !findSection($current_section, 17)) {
    include($_SERVER["DOCUMENT_ROOT"] . "/404.php");
    die();
};

$GLOBALS["arrFilterSectionItemsNew"] = array(// "PROPERTY_NEW" => 1
);

if ($brandFilter) {
    $GLOBALS["arrFilterSectionItemsNew"]["filter-brand"] = strtoupper($third_section_code);
//    test_dump($GLOBALS["arrFilterSectionItemsNew"]);
}

if ($section_code == "brands" && $subsection_code == false) {
?>
<div class="outer-content-wrapper">
    <div class="content-wrapper">
    	<?$APPLICATION->IncludeComponent(
	        "intsys:breadcrumb",
	        "bread",
	        Array(
	            "START_FROM" => "0",
	            "PATH" => $APPLICATION->GetCurPage(),
	            "SITE_ID" => "-"
	        )
	    );?>
        <div class="text-content">
        	<h1>Наши торговые марки</h1>
			<?$APPLICATION->IncludeComponent(
		        "bitrix:news.list",
		        "brands",
		        Array(
		            "IBLOCK_TYPE" => "brands",
		            "IBLOCK_ID" => "6",
		            "NEWS_COUNT" => "999",
		            "SORT_BY1" => "ACTIVE_FROM",
		            "SORT_ORDER1" => "DESC",
		            "SORT_BY2" => "SORT",
		            "SORT_ORDER2" => "ASC",
		            "FILTER_NAME" => "",
		            "FIELD_CODE" => array("NAME","PREVIEW_TEXT","PREVIEW_PICTURE","DETAIL_TEXT","DETAIL_PICTURE","DATE_ACTIVE_FROM",""),
		            "PROPERTY_CODE" => array("LINK"),
		            "CHECK_DATES" => "Y",
		            "DETAIL_URL" => "",
		            "AJAX_MODE" => "N",
		            "AJAX_OPTION_JUMP" => "N",
		            "AJAX_OPTION_STYLE" => "Y",
		            "AJAX_OPTION_HISTORY" => "N",
		            "CACHE_TYPE" => "A",
		            "CACHE_TIME" => "3600",
		            "CACHE_FILTER" => "N",
		            "CACHE_GROUPS" => "Y",
		            "PREVIEW_TRUNCATE_LEN" => "",
		            "ACTIVE_DATE_FORMAT" => "d.M.Y",
		            "SET_STATUS_404" => "Y",
		            "SET_TITLE" => "N",
		            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		            "ADD_SECTIONS_CHAIN" => "Y",
		            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
		            "PARENT_SECTION" => "",
		            "PARENT_SECTION_CODE" => "",
		            "INCLUDE_SUBSECTIONS" => "Y",
		            "DISPLAY_DATE" => "Y",
		            "DISPLAY_NAME" => "Y",
		            "DISPLAY_PICTURE" => "Y",
		            "DISPLAY_PREVIEW_TEXT" => "Y",
		            "PAGER_TEMPLATE" => "page",
		            "DISPLAY_TOP_PAGER" => "N",
		            "DISPLAY_BOTTOM_PAGER" => "Y",
		            "PAGER_TITLE" => "Новости",
		            "PAGER_SHOW_ALWAYS" => "N",
		            "PAGER_DESC_NUMBERING" => "N",
		            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		            "PAGER_SHOW_ALL" => "N"
		        )
		    );?>
		</div>
	</div>
</div>
<?
} elseif ($section_code == "brands" && $subsection_code != false) {
    //Для начала надо проверить, а есть ли такой бренд
    //получаем все значения брендов
    $CURRENT_BRAND1 = GetBrandByXmlId($subsection_code);
    if ($CURRENT_BRAND1 == false) {
        include($_SERVER["DOCUMENT_ROOT"] . "/404.php");
        die();
    }

    $GLOBALS["arrFilterAjaxSection"] = array(
        "PROPERTY_BRAND_VALUE" => array(
            "0" => strtoupper($subsection_code)
        )
    );

    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "section_items_brand",
        Array(
            "IBLOCK_TYPE" => "catalog",
            "IBLOCK_ID" => "17",
            "SECTION_ID" => "",
            "SECTION_CODE" => "",
            "SECTION_USER_FIELDS" => array(""),
            "ELEMENT_SORT_FIELD" => "sort",
            "ELEMENT_SORT_ORDER" => "asc",
            "ELEMENT_SORT_FIELD2" => "id",
            "ELEMENT_SORT_ORDER2" => "desc",
            "FILTER_NAME" => "arrFilterAjaxSection",
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
            "ADD_SECTIONS_CHAIN" => "N",
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
            "PAGER_SHOW_ALL" => "N"
        )
    );

} elseif ($section_code != "new" && $section_code != "sale" && !$brandFilter) {
    if ($subsection_code == false)
        $template = "section_items";
    if ($section_code != false && $subsection_code != false)
        $template = "section_catalog";

    if ($section_code != false)
    {
        // process filter in url
        include_once($_SERVER["DOCUMENT_ROOT"] . "/include/process_filter_in_url.php");
        $filter = UrlFilter::GetFilter($section_code);
        //AddMessage2Log($section_code);
        //AddMessage2Log($filter);
        if ($filter) {
            $GLOBALS["arrFilterSectionItemsNew"][$filter["query-name"]] = $filter["value"];
            //AddMessage2Log($filter["value"]);
        }
    }

    if ($template == "section_catalog") {
        ?>
        <div class="outer-content-wrapper">
        <div class="content-wrapper">
        <?
    }

    $filterName = "arrFilterSectionItemsNew";
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        $template,
        Array(
            "IBLOCK_TYPE" => "catalog",
            "IBLOCK_ID" => "17",
            "SECTION_ID" => "",
            "SECTION_CODE" => $current_section,
            "SECTION_USER_FIELDS" => array(""),
            "ELEMENT_SORT_FIELD" => "sort",
            "ELEMENT_SORT_ORDER" => "asc",
            "ELEMENT_SORT_FIELD2" => "id",
            "ELEMENT_SORT_ORDER2" => "desc",
            "FILTER_NAME" => $filterName,
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
            "ADD_SECTIONS_CHAIN" => "N",
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
            "PAGER_SHOW_ALL" => "N"
        )
    );

    if ($template == "section_catalog") {
        ?>
        </div>
        </div>
        <?
    }
} elseif (!$subsection_code && !$brandFilter) {
    ?>
    <div class="outer-content-wrapper">
        <div class="content-wrapper">
            <?
            $NAMES = Array(
                "new" => "Новинки",
                "sale" => "Распродажа",
            );
            ?>
            <? $APPLICATION->IncludeComponent("intsys:breadcrumb", "bread", Array(
                    "START_FROM" => "0",
                    "PATH" => $APPLICATION->GetCurPage(),
                    "SITE_ID" => "s1"
                )
            ); ?>
            <?
            if ($section_code == "new") {
                $filterName = "arrFilterSectionNew";
                $GLOBALS["arrFilterSectionNew"] = array(
                    ">=catalog_PRICE_1" => $_REQUEST["priceMin"],
                    "<=catalog_PRICE_1" => $_REQUEST["priceMax"],
                    ">=catalog_QUANTITY" => $deposit,
                    "PROPERTY_NEW" => 1
                );
            } elseif ($section_code == "sale") {
                $filterName = "arrFilterSectionSale";
                $GLOBALS["arrFilterSectionSale"] = array(
                    ">=catalog_PRICE_1" => $_REQUEST["priceMin"],
                    "<=catalog_PRICE_1" => $_REQUEST["priceMax"],
                    ">=catalog_QUANTITY" => $deposit,
                    "PROPERTY_SALE" => 1
                );
            }

            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "catalog_new_sale",
                Array(
                    "IBLOCK_TYPE" => "catalog",
                    "IBLOCK_ID" => "17",
                    "SECTION_ID" => "0",
                    "SECTION_CODE" => "",
                    "SECTION_USER_FIELDS" => array(""),
                    "ELEMENT_SORT_FIELD" => $sort1,
                    "ELEMENT_SORT_ORDER" => $typeSort1,
                    "ELEMENT_SORT_FIELD2" => $sort2,
                    "ELEMENT_SORT_ORDER2" => $typeSort2,
                    "FILTER_NAME" => $filterName,
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
            );
            ?>
        </div>
    </div>
    <?
} elseif ($section_code != false && $subsection_code != false && $brandFilter) {
    $GLOBALS["arrFilterAjaxSection"] = array(
        "PROPERTY_BRAND_VALUE" => array(
            "0" => strtoupper($third_section_code)
        )
    );

    $template = "section_catalog_brand";
    ?>
    <div class="outer-content-wrapper">
        <div class="content-wrapper">
            <?

            $filterName = "arrFilterAjaxSection";
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                $template,
                Array(
                    "IBLOCK_TYPE" => "catalog",
                    "IBLOCK_ID" => "17",
                    "SECTION_ID" => "",
                    "SECTION_CODE" => $current_section,
                    "SECTION_USER_FIELDS" => array(0 => $CURRENT_BRAND["VALUE"]),
                    "ELEMENT_SORT_FIELD" => "sort",
                    "ELEMENT_SORT_ORDER" => "asc",
                    "ELEMENT_SORT_FIELD2" => "id",
                    "ELEMENT_SORT_ORDER2" => "desc",
                    "FILTER_NAME" => $filterName,
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
                    "ADD_SECTIONS_CHAIN" => "N",
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
                    "PAGER_SHOW_ALL" => "N"
                )
            );
            ?>
        </div>
    </div>
    <?
} else {
    ?>
    <div class="outer-content-wrapper">
        <div class="content-wrapper">
            <?
            if ($section_code == "new") {
                $filterName = "arrFilterSectionNew";
                $GLOBALS["arrFilterSectionNew"] = array(
                    ">=catalog_PRICE_1" => $_REQUEST["priceMin"],
                    "<=catalog_PRICE_1" => $_REQUEST["priceMax"],
                    ">=catalog_QUANTITY" => $deposit,
                    "PROPERTY_NEW" => 1
                );
            } elseif ($section_code == "sale") {
                $filterName = "arrFilterSectionSale";
                $GLOBALS["arrFilterSectionSale"] = array(
                    ">=catalog_PRICE_1" => $_REQUEST["priceMin"],
                    "<=catalog_PRICE_1" => $_REQUEST["priceMax"],
                    ">=catalog_QUANTITY" => $deposit,
                    "PROPERTY_SALE" => 1
                );
            }

            $APPLICATION->IncludeComponent("intsys:breadcrumb", "bread", Array(
                    "START_FROM" => "0",
                    "PATH" => $APPLICATION->GetCurPage(),
                    "SITE_ID" => "s1"
                )
            );
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "section_catalog_new_sale",
                Array(
                    "IBLOCK_TYPE" => "catalog",
                    "IBLOCK_ID" => "17",
                    "SECTION_ID" => "",
                    "SECTION_CODE" => $subsection_code,
                    "SECTION_USER_FIELDS" => array(""),
                    "ELEMENT_SORT_FIELD" => $sort1,
                    "ELEMENT_SORT_ORDER" => $typeSort1,
                    "ELEMENT_SORT_FIELD2" => $sort2,
                    "ELEMENT_SORT_ORDER2" => $typeSort2,
                    "FILTER_NAME" => $filterName,
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
                    "PAGER_SHOW_ALL" => "N"
                )
            );
            ?>
        </div>
    </div>
    <?
}
?>
