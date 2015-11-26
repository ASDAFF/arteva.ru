<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Проект");
$APPLICATION->SetPageProperty("keywords", "Проект");
$APPLICATION->SetPageProperty("description", "Проект");
$APPLICATION->SetTitle("Проект");?>
<?
    if (!findElements($_REQUEST["ELEMENT_CODE"], 8)):
        include($_SERVER["DOCUMENT_ROOT"].'/404.php'); die();
    endif;
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:news.detail",
    "project",
    Array(
        "IBLOCK_TYPE" => "projects",
        "IBLOCK_ID" => "8",
        "ELEMENT_ID" => "",
        "ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
        "CHECK_DATES" => "Y",
        "FIELD_CODE" => array("DETAIL_TEXT","DETAIL_PICTURE", "PREVIEW_PICTURE", "PREVIEW_TEXT"),
        "PROPERTY_CODE" => array("DESIGNER", "IMAGES"),
        "IBLOCK_URL" => "",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "N",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "N",
        "META_KEYWORDS" => "-",
        "META_DESCRIPTION" => "-",
        "BROWSER_TITLE" => "-",
        "SET_STATUS_404" => "Y",
        "SET_TITLE" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "Y",
        "ADD_ELEMENT_CHAIN" => "N",
        "ACTIVE_DATE_FORMAT" => "",
        "USE_PERMISSIONS" => "N",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "USE_SHARE" => "N",
        "PAGER_TEMPLATE" => ".default",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "Страница",
        "PAGER_SHOW_ALL" => "N"
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>