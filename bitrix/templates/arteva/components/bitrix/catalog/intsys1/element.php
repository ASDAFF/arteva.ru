<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

if ($arResult["VARIABLES"]["ELEMENT_CODE"]):
	$res = "element";
	$elementCode = $arResult["VARIABLES"]["ELEMENT_CODE"];
	$sectionCode = $_REQUEST["CODE"];
elseif ($_REQUEST["CODE"]):
	if (findSection($_REQUEST["CODE"], 17)):
		$res = "section";
	elseif (findElements($_REQUEST["CODE"], 17)):
		$res = "element";
		$elementCode = $_REQUEST["CODE"];
		$sectionCode = $_REQUEST["SUB_SECTION_CODE"];
	else:
		include($_SERVER["DOCUMENT_ROOT"]."/404.php");
	endif;
endif;
?>
<?if ($res == "section"):?>
	<?
	// поключаем фильтр request
	include_once($_SERVER["DOCUMENT_ROOT"]."/include/request_filter.php");
	$GLOBALS["arrFilterSection"] = array(
			">=catalog_PRICE_1" => $_REQUEST["priceMin"],
			"<=catalog_PRICE_1" => $_REQUEST["priceMax"],
			">=catalog_QUANTITY" => $deposit,
			"PROPERTY_".$code_prop."_VALUE" => $_REQUEST["filter-material"],
			"PROPERTY_BRAND_VALUE" => $_REQUEST["filter-brand"],
			"PROPERTY_STYLE_VALUE" => $_REQUEST["filter-style"],
			"PROPERTY_COLOR_VALUE" => $_REQUEST["filter-color"],
			"PROPERTY_PLACE_MOUTING_VALUE" => $_REQUEST["filter-place-mouting"],
			"PROPERTY_REPLICA_VALUE" => $_REQUEST["filter-replica"]
	);
	?>
	<div class="outer-content-wrapper">
		<div class="content-wrapper">
			<?$APPLICATION->IncludeComponent(
					"bitrix:breadcrumb",
					"bread",
					Array(
							"START_FROM" => "0",
							"PATH" => "",
							"SITE_ID" => "-"
					)
			);?>
			<?$APPLICATION->IncludeComponent(
					"bitrix:catalog.section",
					"section_catalog",
					Array(
							"IBLOCK_TYPE" => "catalog",
							"IBLOCK_ID" => "17",
							"SECTION_ID" => "",
							"SECTION_CODE" => $_REQUEST["CODE"],
							"SECTION_USER_FIELDS" => array(""),
							"ELEMENT_SORT_FIELD" => "sort",
							"ELEMENT_SORT_ORDER" => "asc",
							"ELEMENT_SORT_FIELD2" => "id",
							"ELEMENT_SORT_ORDER2" => "desc",
							"FILTER_NAME" => "arrFilterSection",
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
<?elseif ($res == "element"):?>
	<div class="item-page-outer" style="width: 100%;">
		<div class="outer-content-wrapper item-card-wrapper" style="float: none;">
			<div class="content-wrapper">
				<?$APPLICATION->IncludeComponent(
						"bitrix:breadcrumb",
						"bread",
						Array(
								"START_FROM" => "0",
								"PATH" => "",
								"SITE_ID" => SITE_ID
						)
				);?>
				<?$APPLICATION->IncludeComponent(
						"bitrix:catalog.element",
						"item",
						Array(
								"IBLOCK_TYPE" => "catalog",
								"IBLOCK_ID" => "17",
								"ELEMENT_ID" => "",
								"ELEMENT_CODE" => $elementCode,
								"SECTION_ID" => "",
								"SECTION_CODE" => $sectionCode,
								"HIDE_NOT_AVAILABLE" => "N",
								"PROPERTY_CODE" => array("ID_PROD","CML2_CODE","CML2_SORT","ARTIKUL","PRICE","OPIS","COLOR","TIP_SVETILNIKA","REPLICA","MATERIAL_KORPUSA","TYPE_MOUTING","PLACE_MOUTING","STYLE","SIZE","PLAFON","SVET_MATERIAL","MEBEL_MATERIAL","INTERIER_MATERIAL","BRAND","WAITING","SALE","NEW","DEPOSIT","BALANCE","OLD_PRICE","NOTE","SIMILAR_ITEMS","ITEMS",""),
								"OFFERS_LIMIT" => "0",
								"TEMPLATE_THEME" => "blue",
								"DISPLAY_NAME" => "Y",
								"DETAIL_PICTURE_MODE" => "IMG",
								"ADD_DETAIL_TO_SLIDER" => "N",
								"DISPLAY_PREVIEW_TEXT_MODE" => "E",
								"PRODUCT_SUBSCRIPTION" => "N",
								"SHOW_DISCOUNT_PERCENT" => "N",
								"SHOW_OLD_PRICE" => "N",
								"SHOW_MAX_QUANTITY" => "N",
								"SHOW_CLOSE_POPUP" => "N",
								"MESS_BTN_BUY" => "Купить",
								"MESS_BTN_ADD_TO_BASKET" => "В корзину",
								"MESS_BTN_SUBSCRIBE" => "Подписаться",
								"MESS_NOT_AVAILABLE" => "Нет в наличии",
								"USE_VOTE_RATING" => "N",
								"USE_COMMENTS" => "N",
								"BRAND_USE" => "N",
								"SECTION_URL" => "",
								"DETAIL_URL" => "",
								"SECTION_ID_VARIABLE" => "SECTION_ID",
								"CHECK_SECTION_ID_VARIABLE" => "N",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "360000",
								"CACHE_GROUPS" => "Y",
								"SET_TITLE" => "Y",
								"SET_BROWSER_TITLE" => "Y",
								"BROWSER_TITLE" => "-",
								"SET_META_KEYWORDS" => "Y",
								"META_KEYWORDS" => "-",
								"SET_META_DESCRIPTION" => "Y",
								"META_DESCRIPTION" => "-",
								"SET_STATUS_404" => "N",
								"ADD_SECTIONS_CHAIN" => "Y",
								"ADD_ELEMENT_CHAIN" => "N",
								"USE_ELEMENT_COUNTER" => "Y",
								"ACTION_VARIABLE" => "action",
								"PRODUCT_ID_VARIABLE" => "id",
								"DISPLAY_COMPARE" => "N",
								"PRICE_CODE" => array("BASE"),
								"USE_PRICE_COUNT" => "N",
								"SHOW_PRICE_COUNT" => "1",
								"PRICE_VAT_INCLUDE" => "Y",
								"PRICE_VAT_SHOW_VALUE" => "N",
								"CONVERT_CURRENCY" => "N",
								"BASKET_URL" => "/personal/basket.php",
								"USE_PRODUCT_QUANTITY" => "N",
								"ADD_PROPERTIES_TO_BASKET" => "Y",
								"PRODUCT_PROPS_VARIABLE" => "prop",
								"PARTIAL_PRODUCT_PROPERTIES" => "N",
								"PRODUCT_PROPERTIES" => array("TIP_SVETILNIKA","MATERIAL_KORPUSA","TYPE_MOUTING","PLACE_MOUTING","STYLE","SIZE","PLAFON","SVET_MATERIAL","MEBEL_MATERIAL","INTERIER_MATERIAL","BRAND"),
								"ADD_TO_BASKET_ACTION" => array("ADD"),
								"LINK_IBLOCK_TYPE" => "catalog",
								"LINK_IBLOCK_ID" => "17",
								"LINK_PROPERTY_SID" => "undefined",
								"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
								"ADD_PICT_PROP" => "-",
								"LABEL_PROP" => "-",
								"MESS_BTN_COMPARE" => "Сравнить"
						)
				);?>
			</div>
		</div>
		<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.element",
				"item_in_projects",
				Array(
						"IBLOCK_TYPE" => "catalog",
						"IBLOCK_ID" => "17",
						"ELEMENT_ID" => "",
						"ELEMENT_CODE" => $elementCode,
						"SECTION_ID" => "",
						"SECTION_CODE" => $sectionCode,
						"HIDE_NOT_AVAILABLE" => "N",
						"PROPERTY_CODE" => array(),
						"OFFERS_LIMIT" => "0",
						"TEMPLATE_THEME" => "blue",
						"DISPLAY_NAME" => "Y",
						"DETAIL_PICTURE_MODE" => "IMG",
						"ADD_DETAIL_TO_SLIDER" => "N",
						"DISPLAY_PREVIEW_TEXT_MODE" => "E",
						"PRODUCT_SUBSCRIPTION" => "N",
						"SHOW_DISCOUNT_PERCENT" => "N",
						"SHOW_OLD_PRICE" => "N",
						"SHOW_MAX_QUANTITY" => "N",
						"SHOW_CLOSE_POPUP" => "N",
						"MESS_BTN_BUY" => "Купить",
						"MESS_BTN_ADD_TO_BASKET" => "В корзину",
						"MESS_BTN_SUBSCRIBE" => "Подписаться",
						"MESS_NOT_AVAILABLE" => "Нет в наличии",
						"USE_VOTE_RATING" => "N",
						"USE_COMMENTS" => "N",
						"BRAND_USE" => "N",
						"SECTION_URL" => "",
						"DETAIL_URL" => "",
						"SECTION_ID_VARIABLE" => "SECTION_ID",
						"CHECK_SECTION_ID_VARIABLE" => "N",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "36000000",
						"CACHE_GROUPS" => "Y",
						"SET_TITLE" => "N",
						"SET_BROWSER_TITLE" => "N",
						"BROWSER_TITLE" => "-",
						"SET_META_KEYWORDS" => "N",
						"META_KEYWORDS" => "-",
						"SET_META_DESCRIPTION" => "N",
						"META_DESCRIPTION" => "-",
						"SET_STATUS_404" => "N",
						"ADD_SECTIONS_CHAIN" => "N",
						"ADD_ELEMENT_CHAIN" => "N",
						"USE_ELEMENT_COUNTER" => "N",
						"ACTION_VARIABLE" => "action",
						"PRODUCT_ID_VARIABLE" => "id",
						"DISPLAY_COMPARE" => "N",
						"PRICE_CODE" => array(),
						"USE_PRICE_COUNT" => "N",
						"SHOW_PRICE_COUNT" => "1",
						"PRICE_VAT_INCLUDE" => "Y",
						"PRICE_VAT_SHOW_VALUE" => "N",
						"CONVERT_CURRENCY" => "N",
						"BASKET_URL" => "",
						"USE_PRODUCT_QUANTITY" => "N",
						"ADD_PROPERTIES_TO_BASKET" => "Y",
						"PRODUCT_PROPS_VARIABLE" => "prop",
						"PARTIAL_PRODUCT_PROPERTIES" => "N",
						"PRODUCT_PROPERTIES" => array(),
						"ADD_TO_BASKET_ACTION" => array(),
						"LINK_IBLOCK_TYPE" => "catalog",
						"LINK_IBLOCK_ID" => "17",
						"LINK_PROPERTY_SID" => "undefined",
						"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
						"ADD_PICT_PROP" => "-",
						"LABEL_PROP" => "-",
						"MESS_BTN_COMPARE" => "Сравнить"
				)
		);?>
		<?
		$APPLICATION->IncludeComponent(
				"itech:custom.sale.recommended.products",
				"items",
				Array(
						"IBLOCK_TYPE" => "catalog",
						"IBLOCK_ID" => "17",
						"ID" => "",
						"CODE" => $elementCode,
						"PROPERTY_LINK" => "ITEMS",
						"PROPERTY_CODE" => array("PROPERTY_ARTIKUL", "PROPERTY_HIT", "PROPERTY_NEW", "PROPERTY_ITEMS"),
						"PRICE_CODE" => array("BASE",),
				)
		);
		?>
		<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.viewed.products",
				"items",
				Array(
						"IBLOCK_TYPE" => "catalog",
						"IBLOCK_ID" => "17",
						"SHOW_FROM_SECTION" => "N",
						"HIDE_NOT_AVAILABLE" => "N",
						"SHOW_DISCOUNT_PERCENT" => "Y",
						"PRODUCT_SUBSCRIPTION" => "N",
						"SHOW_NAME" => "Y",
						"SHOW_IMAGE" => "Y",
						"MESS_BTN_BUY" => "Купить",
						"MESS_BTN_DETAIL" => "Подробнее",
						"MESS_BTN_SUBSCRIBE" => "Подписаться",
						"PAGE_ELEMENT_COUNT" => "9999",
						"LINE_ELEMENT_COUNT" => "1",
						"TEMPLATE_THEME" => "",
						"DETAIL_URL" => "",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "36000000",
						"CACHE_GROUPS" => "Y",
						"SHOW_OLD_PRICE" => "N",
						"PRICE_CODE" => array("BASE"),
						"SHOW_PRICE_COUNT" => "1",
						"PRICE_VAT_INCLUDE" => "Y",
						"CONVERT_CURRENCY" => "N",
						"BASKET_URL" => "/personal/cart/",
						"ACTION_VARIABLE" => "action",
						"PRODUCT_ID_VARIABLE" => "id",
						"ADD_PROPERTIES_TO_BASKET" => "Y",
						"PRODUCT_PROPS_VARIABLE" => "prop",
						"PARTIAL_PRODUCT_PROPERTIES" => "N",
						"USE_PRODUCT_QUANTITY" => "N",
						"SHOW_PRODUCTS_17" => "Y"
				)
		);?>
	</div>
<?endif;?>