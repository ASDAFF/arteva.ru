<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Спецификации");?>
<?if ($USER->isAuthorized() && in_array(8, $USER->GetUserGroupArray())):?>
	<?
		$arSpecifications = getSpecificationsList($USER->GetID());
        //echo "<pre>";print_r($arSpecifications);echo "</pre>";
	?>
	<div class="outer-content-wrapper lk-page" data-user="<?=$USER->GetID()?>">
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
                <h1>Мои спецификации</h1>
                <div class="lk-section lk-section-orders specifications">
                    <div class="lk-content">
                        <div class="lk-orders">
                            <?foreach ($arSpecifications as $key => $arSpec) :?>
                                <?
                                    unset($allSumSpec); unset($totalPrice);
                                    unset($allDisSpec); unset($allSumminDisSpec);
                                    foreach ($arSpec["ITEMS"] as $key => $arItems) :
                                        $allSumSpec += $arItems["DISCOUNT"]["PRICE"]*$arItems["PROPERTY_COUNT_VALUE"];
                                        $totalPrice += $arItems["DISCOUNT"]["DISCOUNT_PRICE"]*$arItems["PROPERTY_COUNT_VALUE"];
                                        $allDisSpec += $arItems["DISCOUNT"]["PRICE"]-$arItems["DISCOUNT"]["DISCOUNT_PRICE"];
                                        $allSumminDisSpec += $arItems["DISCOUNT"]["DISCOUNT_PRICE"]*$arItems["PROPERTY_COUNT_VALUE"];
                                    endforeach;
                                ?>
                                <div class="lk-order js-lk-spec" data-spec="<?=$arSpec["ID"]?>">
                                    <p class="last-order-info big"><?=$arSpec["NAME"]?><span><?=$arSpec["TIMESTAMP_X"]?></span></p>
                                    <div class="row-h">
                                        <div class="col12">
                                            <div class="lk-toc-row">
                                                <span>Стоимость товаров</span>
                                                <span><?=number_format($allSumSpec, 0, 0, " ")?> руб.</span>
                                            </div>
                                            <div class="lk-toc-row">
                                                <span>Со скидкой</span>
                                                <span><?=number_format($allSumminDisSpec, 0, 0, " ")?> руб.</span>
                                            </div>
                                        </div>
                                        <div class="col12">
                                            <div class="lk-toc-row">
                                                <span>Ваша экономия</span>
                                                <span><?=number_format($allDisSpec, 0, 0, " ")?> руб.</span>
                                            </div>
                                            <div class="lk-toc-row">
                                                <span><strong>ИТОГО</strong></span>
                                                <span><strong><?=number_format($totalPrice, 0, 0, " ")?> руб.</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?if ($arSpec["ITEMS"]):?>
                                        <a class="btn small-btn js-order-contents-trigger" href="#">Состав</a>
                                    <?endif?>
                                    <a class="btn small-btn js-lk-spec-remove" href="#">Удалить</a>
                                    <div class="lk-order-contents-wrapper">
                                        <ul class="checkout-order-list">
                                            <?foreach ($arSpec["ITEMS"] as $key => $arItems) :?>
                                                <?if ($key > 0):echo "-->";endif;?><li class="checkout-order-item js-lk-spec-item lk-spec-item" data-id="<?=$arItems["ID"]?>">
                                                    <?if ($arItems["PRODUCT"]["~PREVIEW_PICTURE"]):?>
                                                        <?
                                                            //$waterImage = waterImage($arItems["PRODUCT"]["~PREVIEW_PICTURE"]);
                                                            // $waterImage["src"]
                                                            $waterImage["src"] = CFIle::GetPath($arItems["PRODUCT"]["~PREVIEW_PICTURE"]);
                                                        ?>
                                                        <aside>
                                                            <div class="img-cnt">
                                                                <img src="<?=$waterImage["src"]?>" alt="item"/>
                                                            </div>
                                                        </aside>
                                                    <?endif?>
                                                    <div class="order-item-info">
                                                        <?if ($arItems["PRODUCT"]["PROPERTY_ARTIKUL_VALUE"]):?>
                                                            <p class="item-num">Артикул <?=$arItems["PRODUCT"]["PROPERTY_ARTIKUL_VALUE"]?></p>
                                                        <?endif?>
                                                        <?if ($arItems["PRODUCT"]["DETAIL_PAGE_URL"]):?>
                                                            <p class="item-descr">
                                                                <a href="<?=$arItems["PRODUCT"]["DETAIL_PAGE_URL"]?>">
                                                                    <?=$arItems["PRODUCT"]["NAME"]?>
                                                                </a>
                                                            </p>
                                                        <?else:?>
                                                            <p class="item-descr"><?=$arItems["PRODUCT"]["NAME"]?></p>
                                                        <?endif?>
                                                        <p>
                                                            <span class="item-count">x <?=$arItems["PROPERTY_COUNT_VALUE"]*1?> шт.</span>
                                                            <span class="item-sum">на сумму <?=number_format($arItems["DISCOUNT"]["DISCOUNT_PRICE"]*$arItems["PROPERTY_COUNT_VALUE"], 0, 0, " ")?> руб.</span>
                                                        </p>
                                                    </div>
                                                    <a class="js-lk-spec-item-remove lk-item-remove" href="#"></a>
                                                </li><?if ($key < count($arSpec["ITEMS"])-1):echo "<!--";endif;?>
                                            <?endforeach?>
                                        </ul>
                                        <a class="btn small-btn js-print-spec" href="#">Распечатать</a>
                                        <a class="btn small-btn js-save-spec" href="#">Создать PDF</a>
                                        <a class="btn small-btn fancy-popup" href="#manager-form" onclick="$('#SPEC_ID').val(<?=$arSpec["ID"]?>)">Отправить менеджеру</a>
                                    </div>
                                </div>
                            <?endforeach?>
                        </div>
                    </div>
                    <div class="mobile-wrapper">
                        <a class="btn fancy-popup" href="#add-to-spec-form">Добавить спецификацию</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="outer-content-wrapper print-show">
        <div class="content-wrapper">
            <div class="js-print-cnt">
            </div>
        </div>
    </div>
    <div class="fbx-content add-to-spec-form-cnt" id="add-to-spec-form">
        <p class="popup-header">Добавить спецификацию</p>
        <form class="common-form add-to-spec-form" action="">
            <div class="row">
                <div class="col12">
                    <fieldset>
                        <label>Создать новую спецификацию</label>
                    </fieldset>
                </div>
                <div class="col12">
                    <fieldset>
                        <input type="text" name="NEW_SPECIFICATION" id="new-spec-name"/>
                    </fieldset>
                </div>
            </div>
            <div class="spec-submit-cnt acenter">
                <a class="btn important js-submit-spec" href="#">Добавить</a>
            </div>
            <div class="preload-overlay"><i></i></div>
        </form>
    </div>
    <div class="fbx-content callback-form-cnt common-form" id="manager-form">
        <?$APPLICATION->IncludeComponent(
            "bitrix:form.result.new",
            "manager",
            Array(
                "SEF_MODE" => "N",
                "WEB_FORM_ID" => "2",
                "LIST_URL" => "",
                "EDIT_URL" => "",
                "SUCCESS_URL" => "",
                "CHAIN_ITEM_TEXT" => "",
                "CHAIN_ITEM_LINK" => "",
                "IGNORE_CUSTOM_TEMPLATE" => "N",
                "USE_EXTENDED_ERRORS" => "Y",
                "CACHE_TYPE" => "N",
                "CACHE_TIME" => "0",
                "VARIABLE_ALIASES" => Array(
                )
            ),
            false
        );?>
    </div>
<?else:
    LocalRedirect("/auth/");
endif?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>