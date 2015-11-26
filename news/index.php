<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "&laquo;Arteva Home&raquo; - Новости");
$APPLICATION->SetPageProperty("keywords", "&laquo;Arteva Home&raquo; Новости");
$APPLICATION->SetPageProperty("description", "Новости. &laquo;Arteva Home&raquo;");
$APPLICATION->SetTitle("Новости");?>
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
        <h1>Новости</h1>
        <?$APPLICATION->IncludeComponent(
	        "bitrix:news.list",
	        "news",
	        Array(
	            "IBLOCK_TYPE" => "news",
	            "IBLOCK_ID" => "9",
	            "NEWS_COUNT" => "6",
	            "SORT_BY1" => "ACTIVE_FROM",
	            "SORT_ORDER1" => "DESC",
	            "SORT_BY2" => "SORT",
	            "SORT_ORDER2" => "ASC",
	            "FILTER_NAME" => "",
	            "FIELD_CODE" => array("NAME","PREVIEW_TEXT","PREVIEW_PICTURE","DETAIL_TEXT","DETAIL_PICTURE","DATE_ACTIVE_FROM",""),
	            "PROPERTY_CODE" => array(""),
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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>