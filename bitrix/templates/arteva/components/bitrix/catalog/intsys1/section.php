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

//test_dump($section_code);
//test_dump($subsection_code);

if (!findSection($arResult["VARIABLES"]["SECTION_CODE"], 17) && $section_code != "new" && $section_code != "sale"):
    include($_SERVER["DOCUMENT_ROOT"] . "/404.php");
    die();
endif;

$GLOBALS["arrFilterSectionItemsNew"] = array(
    "PROPERTY_NEW" => 1
);

if ($section_code != "new" && $section_code != "sale") {
    $length = count(explode("/", $arResult["VARIABLES"]["SECTION_CODE_PATH"]));
    $template = $length > 1 ? "section_catalog" : "section_items";
    ?>
    <div class="outer-content-wrapper">
        <div class="content-wrapper">
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                $template,
                Array(
                    "IBLOCK_TYPE" => "catalog",
                    "IBLOCK_ID" => "17",
                    "SECTION_ID" => "",
                    "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                    "SECTION_USER_FIELDS" => array(""),
                    "ELEMENT_SORT_FIELD" => "sort",
                    "ELEMENT_SORT_ORDER" => "asc",
                    "ELEMENT_SORT_FIELD2" => "id",
                    "ELEMENT_SORT_ORDER2" => "desc",
                    "FILTER_NAME" => "arrFilterSectionItemsNew",
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
} elseif (!$subsection_code) {
    ?>
    <div class="outer-content-wrapper">
        <div class="content-wrapper">
            <?
            $NAMES = Array(
                "new" => "Новинки",
                "sale" => "Распродажа",
            );
            ?>
            <ul class="breadcrumbs">
                <li class="bc-item">
                    <a href="/" title="Главная">Главная</a>
                </li>
                <li class="bc-item">
                    <a><?= $NAMES[$section_code] ?></a>
                </li>
            </ul>
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
