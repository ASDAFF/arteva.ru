<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	$contactItem = $arResult["ITEMS"][0];
    $i = 0;
    $count = count($contactItem["PROPERTIES"])-5;
?>
<div class="contacts-map-cnt">
    <div id="contacts-map" data-lat="<?=$contactItem["PROPERTIES"]["LAT"]["VALUE"]?>" data-long="<?=$contactItem["PROPERTIES"]["LONG"]["VALUE"]?>"></div>
</div>

<div class="nav-container">
    <?
        global $APPLICATION;
        echo $APPLICATION->GetNavChain(false, false, false, true);
    ?>
    <h1>Контакты</h1>
</div>
<div class='contacts-info'>
    <p class="header">Контактная информация</p>
    <div class='holder'>
        <p><span>Телефоны:</span></p>
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"phones",
			Array(
				"IBLOCK_TYPE" => "contacts",
				"IBLOCK_ID" => "31",
				"NEWS_COUNT" => "20",
				"SORT_BY1" => "SORT",
				"SORT_ORDER1" => "ASC",
				"SORT_BY2" => "ACTIVE_FROM",
				"SORT_ORDER2" => "DESC",
				"FILTER_NAME" => "",
				"FIELD_CODE" => array("NAME"),
				"PROPERTY_CODE" => array(),
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
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
    <div class='holder'>
        <p><span>Email:</span></p>
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"mails",
			Array(
				"IBLOCK_TYPE" => "contacts",
				"IBLOCK_ID" => "32",
				"NEWS_COUNT" => "20",
				"SORT_BY1" => "SORT",
				"SORT_ORDER1" => "ASC",
				"SORT_BY2" => "ACTIVE_FROM",
				"SORT_ORDER2" => "DESC",
				"FILTER_NAME" => "",
				"FIELD_CODE" => array("NAME", "PREVIEW_TEXT"),
				"PROPERTY_CODE" => array(),
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
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
    <?=$contactItem["PROPERTIES"]["SCHEDULE"]["~VALUE"]["TEXT"]?>

	<p class="header">Обратная связь</p>
	<p class="header small"><span class="small"><?=$contactItem["PROPERTIES"]["NOTICE"]["VALUE"]?></span></p>

	<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "contact_feedback",
		array(
			"WEB_FORM_ID" => "4",
			"IGNORE_CUSTOM_TEMPLATE" => "N",
			"USE_EXTENDED_ERRORS" => "N",
			"SEF_MODE" => "N",
			"SEF_FOLDER" => "/contacts/",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600",
			"LIST_URL" => "",
			"EDIT_URL" => "",
			"SUCCESS_URL" => "/contacts/",
			"CHAIN_ITEM_TEXT" => "",
			"CHAIN_ITEM_LINK" => "",
			"VARIABLE_ALIASES" => array(
				"WEB_FORM_ID" => "WEB_FORM_ID",
				"RESULT_ID" => "RESULT_ID",
			)
		), false
	);?>

</div>
<div class="contacts-wrapper">
    <ul class="contacts-items-list">
        <?foreach ($contactItem["PROPERTIES"] as $key => $value) :?>
            <?if (!in_array($key, array("LAT", "LONG", "SCHEDULE", "NOTICE"))):?>
                <?if ($i > 0 && $i <= $count) echo "-->";?><li class="contacts-item">
                    <p class="header"><?=$value["NAME"]?></p>
                    <p><?=$value["~VALUE"]?></p>
                </li><?if ($i >= 0 && $i < $count) echo "<!--"; $i++;?>
            <?endif?>
        <?endforeach?>
    </ul>
</div>