<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Помощь");?>
<?if ($USER->isAuthorized()):?>
	<?
		if (in_array(8, $USER->GetUserGroupArray())):
			$typeHelp = "designers";
		else:
			$typeHelp = "all";
		endif;
	?>
	<div class="outer-content-wrapper lk-page">
        <div class="content-wrapper">
        	<a class="lk-sidebar-trigger js-lk-side-trigger mobile" href="#">Личный кабинет</a>
            <?
                include($_SERVER["DOCUMENT_ROOT"]."/include/menu_personal.php");
            ?>
            <div class="lk-inner">
                <?$APPLICATION->IncludeComponent(
			        "bitrix:breadcrumb",
			        "bread",
			        Array(
			            "START_FROM" => "0",
			            "PATH" => "",
			            "SITE_ID" => "-"
			        )
			    );?>
                <h1>Помощь</h1>
                <div class="lk-section lk-section-main">
                    <div class="lk-content">
                        <div class="text-content">
                        	<?$APPLICATION->IncludeComponent(
				                "bitrix:news.detail",
				                "help",
				                Array(
				                    "IBLOCK_TYPE" => "personal",
				                    "IBLOCK_ID" => "20",
				                    "ELEMENT_ID" => "",
				                    "ELEMENT_CODE" => $typeHelp,
				                    "CHECK_DATES" => "Y",
				                    "FIELD_CODE" => array("DETAIL_TEXT", "DETAIL_PICTURE", "PREVIEW_PICTURE"),
				                    "PROPERTY_CODE" => array(),
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?else:
    LocalRedirect("/auth/");
endif?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>