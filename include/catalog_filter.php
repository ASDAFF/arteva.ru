<?
    global $APPLICATION;
    $curpage = $APPLICATION->GetCurPage();
    $arLink = explode("/", $curpage);
    $link = $arLink[2];
    $section_code = $arLink[1];
    // для каждого раздела свой материал и фильтр
    //AddMessage2Log($arLink);
    switch ($section_code) {
        case 'svetilniki':
            $code_prop = "SVET_MATERIAL";
            $filter_view = "SVET";
            break;
        case 'mebel':
            $code_prop = "MEBEL_MATERIAL";
            $filter_view = "MEBEL";
            break;
        case 'predmety-interera':
            $code_prop = "INTERIER_MATERIAL";
            $filter_view = "INTERIER";
            break;
    }
?>

<?//$APPLICATION->IncludeComponent(
//	"bitrix:catalog.section.list",
//	"section_inner",
//	Array(
//		"IBLOCK_TYPE" => "catalog",
//		"IBLOCK_ID" => "17",
//		"SECTION_ID" => "",
//		"SECTION_CODE" => $_REQUEST["SUB_SECTION_CODE"],
//		"COUNT_ELEMENTS" => "Y",
//		"TOP_DEPTH" => "1",
//		"SECTION_FIELDS" => array("","",""),
//		"SECTION_USER_FIELDS" => array("UF_1C_ID","",""),
//		"VIEW_MODE" => "LINE",
//		"SHOW_PARENT_NAME" => "Y",
//		"SECTION_URL" => "",
//		"CACHE_TYPE" => "A",
//		"CACHE_TIME" => "",
//		"CACHE_GROUPS" => "Y",
//		"ADD_SECTIONS_CHAIN" => "N"
//	)
//);?>



<div class="catalog-filter">

    <a class="js-reset-filter reset-filter" href="#">Сбросить фильтр</a>
    <form class="common-form inverse" action="">
        <input type="hidden" id="section_code" name="section_code" value="<?=$section_code?>">
        <div class="catalog-filter-top">
            <div class="price-slider-cnt">
                <div class="price-slider" data-min="0" data-max="1000000" data-current-min="<?=($_REQUEST["priceMin"]) ? $_REQUEST["priceMin"] : 0?>" data-current-max="<?=($_REQUEST["priceMax"]) ? $_REQUEST["priceMax"] : 1000000?>"></div>
                <input type="hidden" name="price-min" id="price-min"/>
                <input type="hidden" name="price-max" id="price-max"/>
                <div class="price-cnt min">
                    <input class="price-min" type="text"/>
                    <span>a</span>
                </div>
                <div class="price-cnt max">
                    <input class="price-max" type="text"/>
                    <span>a</span>
                </div>
            </div>
            <div class="presence-cb-cnt">
                <input class="css-checkbox js-filter-presence" <?if ($_REQUEST["presence"] == "true"):?>checked<?endif?> type="checkbox" name="filter-presence" id="filter-presence"/>
                <label class="cb-label" for="filter-presence">В наличии</label>
            </div>
            <div class="sort-cnt">
                <?switch ($_REQUEST["sortPopular"]) {
                    case '1':
                        $typeSort = "asc";
                        break;
                    case '0':
                        $typeSort = "desc";
                        break;
                    default:
                        $typeSort = "none";
                        break;
                }?>
                <a class="js-sort sort-<?=$typeSort?>" data-state="<?=$typeSort?>" data-field="sortPopular" href="#">По популярности</a>
            </div>
            <div class="sort-cnt">
                <?switch ($_REQUEST["sortPrice"]) {
                    case '1':
                        $typeSort = "asc";
                        break;
                    case '0':
                        $typeSort = "desc";
                        break;
                    default:
                        $typeSort = "none";
                        break;
                }?>
                <a class="js-sort sort-<?=$typeSort?>" data-state="<?=$typeSort?>" data-field="sortPrice" href="#">По цене</a>
            </div>
            <div class="more-params-cnt">
                <a class="js-filter-more-params" href="#">
                    <span>Еще параметры</span>
                    <span>Свернуть</span>
                </a>
            </div>
        </div>


        <div class="catalog-filter-bottom">
            <?if ($filter_view == "SVET"):?>
                <div class="row">
                    <div class="col13">
                        <fieldset>
                            <label for="filter-brand">Бренд</label>
                            <select data-prop="BRAND" data-name="filter-brand" name="filter-brand" id="filter-brand" multiple data-placeholder="Выберите бренд" class="js-multiple-select">
                                <option value="" class="mobile-hide"></option>
                                <?foreach ($arResult["PROPERTIES_IBLOCK"]["BRAND"]["ENUM_LIST"] as $key => $arProp) :?>
                                    <?if (in_array($arProp["VALUE"], $_REQUEST["filter-brand"])):?>
                                        <option value="<?=$arProp["VALUE"]?>" selected><?=$arProp["VALUE"]?></option>
                                    <?else:?>
                                        <option value="<?=$arProp["VALUE"]?>"><?=$arProp["VALUE"]?></option>
                                    <?endif?>
                                <?endforeach?>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col13">
                        <fieldset>
                            <label for="filter-style">Стиль</label>
                            <select data-prop="STYLE" data-name="filter-style" name="filter-style" id="filter-style" multiple data-placeholder="Выберите стиль" class="js-multiple-select">
                                <option value="" class="mobile-hide"></option>
                                <?foreach ($arResult["PROPERTIES_IBLOCK"]["STYLE"]["ENUM_LIST"] as $key => $arProp) :?>
                                    <?if (in_array($arProp["VALUE"], $_REQUEST["filter-style"])):?>
                                        <option value="<?=$arProp["VALUE"]?>" selected><?=$arProp["VALUE"]?></option>
                                    <?else:?>
                                        <option value="<?=$arProp["VALUE"]?>"><?=$arProp["VALUE"]?></option>
                                    <?endif?>
                                <?endforeach?>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col13">
                        <fieldset>
                            <label for="filter-material">Материал</label>
                            <select data-prop="<?=$code_prop?>" data-name="filter-material" name="filter-material" id="filter-material" multiple data-placeholder="Выберите материал" class="js-multiple-select">
                                <option value="" class="mobile-hide"></option>
                                <?foreach ($arResult["PROPERTIES_IBLOCK"][$code_prop]["ENUM_LIST"] as $key => $arProp) :?>
                                    <?if (in_array($arProp["VALUE"], $_REQUEST["filter-material"])):?>
                                        <option value="<?=$arProp["VALUE"]?>" selected><?=$arProp["VALUE"]?></option>
                                    <?else:?>
                                        <option value="<?=$arProp["VALUE"]?>"><?=$arProp["VALUE"]?></option>
                                    <?endif?>
                                <?endforeach?>
                            </select>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col13">
                        <fieldset>
                            <label for="filter-place-mouting">Место установки</label>
                            <select data-prop="PLACE_MOUTING" data-name="filter-place-mouting" name="filter-place-mouting" id="filter-place-mouting" multiple data-placeholder="Выберите место установки" class="js-multiple-select">
                                <option value="" class="mobile-hide"></option>
                                <?foreach ($arResult["PROPERTIES_IBLOCK"]["PLACE_MOUTING"]["ENUM_LIST"] as $key => $arProp) :?>
                                    <?if (in_array($arProp["VALUE"], $_REQUEST["filter-place-mouting"])):?>
                                        <option value="<?=$arProp["VALUE"]?>" selected><?=$arProp["VALUE"]?></option>
                                    <?else:?>
                                        <option value="<?=$arProp["VALUE"]?>"><?=$arProp["VALUE"]?></option>
                                    <?endif?>
                                <?endforeach?>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col13">
                        <fieldset>
                            <label for="filter-replica">Реплика</label>
                            <select data-prop="REPLICA" data-name="filter-replica" name="filter-replica" id="filter-replica" multiple data-placeholder="Выберите значение" class="js-multiple-select">
                                <option value="" class="mobile-hide"></option>
                                <?foreach ($arResult["PROPERTIES_IBLOCK"]["REPLICA"]["ENUM_LIST"] as $key => $arProp) :?>
                                    <?if (in_array($arProp["VALUE"], $_REQUEST["filter-replica"])):?>
                                        <option value="<?=$arProp["VALUE"]?>" selected><?=$arProp["VALUE"]?></option>
                                    <?else:?>
                                        <option value="<?=$arProp["VALUE"]?>"><?=$arProp["VALUE"]?></option>
                                    <?endif?>
                                <?endforeach?>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col13">
                        <fieldset>
                            <label for="filter-color">Цвет абажура</label>
                            <select data-prop="COLOR" data-name="filter-color" name="filter-color" id="filter-color" multiple data-placeholder="Выберите цвет" class="js-multiple-select">
                                <option value="" class="mobile-hide"></option>
                                <?foreach ($arResult["PROPERTIES_IBLOCK"]["COLOR"]["ENUM_LIST"] as $key => $arProp) :?>
                                    <?if (in_array($arProp["VALUE"], $_REQUEST["filter-color"])):?>
                                        <option value="<?=$arProp["VALUE"]?>" selected><?=$arProp["VALUE"]?></option>
                                    <?else:?>
                                        <option value="<?=$arProp["VALUE"]?>"><?=$arProp["VALUE"]?></option>
                                    <?endif?>
                                <?endforeach?>
                            </select>
                        </fieldset>
                    </div>
				</div>
				<div class="row">
					<div class="col13">
                        <fieldset>
							<div style="display:none;"><?=print_r($arResult);?></div>
                            <label for="filter-color-base">Цвет основания</label>
                            <select data-prop="COLOR_BASE" data-name="filter-color-base" name="filter-color-base" id="filter-color-base" multiple data-placeholder="Выберите цвет" class="js-multiple-select">
                                <option value="" class="mobile-hide"></option>
                                <?foreach ($arResult["PROPERTIES_IBLOCK"]["COLOR_BASE"]["ENUM_LIST"] as $key => $arProp) :?>
                                    <?if (in_array($arProp["VALUE"], $_REQUEST["filter-color-base"])):?>
                                        <option value="<?=$arProp["VALUE"]?>" selected><?=$arProp["VALUE"]?></option>
                                    <?else:?>
                                        <option value="<?=$arProp["VALUE"]?>"><?=$arProp["VALUE"]?></option>
                                    <?endif?>
                                <?endforeach?>
                            </select>
                        </fieldset>
                    </div>
                </div>
            <?elseif ($filter_view == "MEBEL" || $filter_view == "INTERIER"):?>
                <div class="row">
                    <div class="col13">
                        <fieldset>
                            <label for="filter-brand">Бренд</label>
                            <select data-prop="BRAND" data-name="filter-brand" name="filter-brand" id="filter-brand" multiple data-placeholder="Выберите бренд" class="js-multiple-select">
                                <option value="" class="mobile-hide"></option>
                                <?foreach ($arResult["PROPERTIES_IBLOCK"]["BRAND"]["ENUM_LIST"] as $key => $arProp) :?>
                                    <?if (in_array($arProp["VALUE"], $_REQUEST["filter-brand"])):?>
                                        <option value="<?=$arProp["VALUE"]?>" selected><?=$arProp["VALUE"]?></option>
                                    <?else:?>
                                        <option value="<?=$arProp["VALUE"]?>"><?=$arProp["VALUE"]?></option>
                                    <?endif?>
                                <?endforeach?>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col13">
                        <fieldset>
                            <label for="filter-material">Материал</label>
                            <select data-prop="<?=$code_prop?>" data-name="filter-material" name="filter-material" id="filter-material" multiple data-placeholder="Выберите материал" class="js-multiple-select">
                                <option value="" class="mobile-hide"></option>
                                <?foreach ($arResult["PROPERTIES_IBLOCK"][$code_prop]["ENUM_LIST"] as $key => $arProp) :?>
                                    <?if (in_array($arProp["VALUE"], $_REQUEST["filter-material"])):?>
                                        <option value="<?=$arProp["VALUE"]?>" selected><?=$arProp["VALUE"]?></option>
                                    <?else:?>
                                        <option value="<?=$arProp["VALUE"]?>"><?=$arProp["VALUE"]?></option>
                                    <?endif?>
                                <?endforeach?>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col13">
                        <fieldset>
                            <label for="filter-color">Цвет отделки</label>
                            <select data-prop="COLOR" data-name="filter-color" name="filter-color" id="filter-color" multiple data-placeholder="Выберите цвет" class="js-multiple-select">
                                <option value="" class="mobile-hide"></option>
                                <?foreach ($arResult["PROPERTIES_IBLOCK"]["COLOR"]["ENUM_LIST"] as $key => $arProp) :?>
                                    <?if (in_array($arProp["VALUE"], $_REQUEST["filter-color"])):?>
                                        <option value="<?=$arProp["VALUE"]?>" selected><?=$arProp["VALUE"]?></option>
                                    <?else:?>
                                        <option value="<?=$arProp["VALUE"]?>"><?=$arProp["VALUE"]?></option>
                                    <?endif?>
                                <?endforeach?>
                            </select>
                        </fieldset>
                    </div>
                </div>
				<div class="row">
					<div class="col13">
                        <fieldset>
                            <label for="filter-style">Стиль</label>
                            <select data-prop="STYLE" data-name="filter-style" name="filter-style" id="filter-style" multiple data-placeholder="Выберите стиль" class="js-multiple-select">
                                <option value="" class="mobile-hide"></option>
                                <?foreach ($arResult["PROPERTIES_IBLOCK"]["STYLE"]["ENUM_LIST"] as $key => $arProp) :?>
                                    <?if (in_array($arProp["VALUE"], $_REQUEST["filter-style"])):?>
                                        <option value="<?=$arProp["VALUE"]?>" selected><?=$arProp["VALUE"]?></option>
                                    <?else:?>
                                        <option value="<?=$arProp["VALUE"]?>"><?=$arProp["VALUE"]?></option>
                                    <?endif?>
                                <?endforeach?>
                            </select>
                        </fieldset>
                    </div>
				</div>
            <?endif?>
        </div>

        <?if ($link == "new"):?>
            <input type="hidden" name="new" value="1"><input type="hidden" name="sale" value="">
        <?elseif ($link == "sale"):?>
            <input type="hidden" name="new" value=""><input type="hidden" name="sale" value="1">
        <?else:?>
            <input type="hidden" name="new" value=""><input type="hidden" name="sale" value="">
        <?endif?>        
        <input type="hidden" name="section_code" value="<?=htmlspecialchars($_REQUEST["SECTION_CODE"])?>">
        <input type="hidden" name="section_id" value="<?=$arResult["ID"]?>">
    </form>
</div>