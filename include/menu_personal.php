<?
    $dis = (in_array(8, $USER->GetUserGroupArray())) ? true : false;
?>
<aside class="lk-sidebar">
    <div class="sb-menu-category">
        <p class="header">Личная информация</p>
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "left_personal",
            Array(
                "ROOT_MENU_TYPE" => "left-personal",
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "left-personal",
                "USE_EXT" => "N",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "N",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "",
                "MENU_CACHE_USE_GROUPS" => "N",
                "MENU_CACHE_GET_VARS" => array()
            )
        );?>
    </div>
    <div class="sb-menu-category">
        <p class="header">Заказы и товары</p>
        <?
            $menu_type = ($dis === true) ? "left-personal-sub-dis" : "left-personal-sub";
        ?>
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "left_personal",
            Array(
                "ROOT_MENU_TYPE" => $menu_type,
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => $menu_type,
                "USE_EXT" => "N",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "N",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "",
                "MENU_CACHE_USE_GROUPS" => "N",
                "MENU_CACHE_GET_VARS" => array()
            )
        );?>
    </div>
    <?
        CModule::IncludeModule("subscribe");
        $resSubscribe = CSubscription::GetUserSubscription();
        //echo "<pre>";print_r($resSubscribe);echo "</pre>";
    ?>
    <?if ($resSubscribe["ID"] <= 0 || $resSubscribe["ACTIVE"] == "N"):?>
        <p class="news-feed-header">Новостная рассылка</p>
        <a class="btn important js-subscribe-trigger" href="#" data-email="<?=CUser::GetEmail()?>" data-action="add">Подписаться</a>
    <?else:?>
        <p class="news-feed-header">Новостная рассылка</p>
        <a class="btn important js-subscribe-trigger" href="#" data-email="<?=CUser::GetEmail()?>" data-action="remove">Отписаться</a>
    <?endif?>
    <?if ($dis === false):?>
        <div class="lk-designer-invitation text-content">
            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "text_menu_lk",
                Array(
                    "IBLOCK_TYPE" => "perosnal",
                    "IBLOCK_ID" => "24",
                    "NEWS_COUNT" => "1",
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
    <?endif?>
</aside>