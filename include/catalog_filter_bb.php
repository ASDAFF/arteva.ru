<?
    global $APPLICATION;
    $curpage = $APPLICATION->GetCurPage();
    $arLink = explode("/", $curpage);
    $link = $arLink[2];
    // для каждого раздела свой материал и фильтр
	$code_prop = "SVET_MATERIAL";
	$filter_view = "SVET";
// CL($arResult);	
	?>

<div class="catalog-filter">
    <a class="js-reset-filter reset-filter" href="#">Сбросить фильтр</a>
    <form class="common-form inverse" action="">
        <div class="catalog-filter-top" style="    overflow: inherit; height: 69px;">
            <div class="price-slider-cnt" style="display:none;">
                <div class="price-slider" data-min="0" data-max="1000000" data-current-min="<?=($_REQUEST["priceMin"]) ? $_REQUEST["priceMin"] : 0?>" data-current-max="<?=($_REQUEST["priceMax"]) ? $_REQUEST["priceMax"] : 1000000?>"></div>
                <input type="hidden" name="price-min" id="price-min" value="0.00"/>
                <input type="hidden" name="price-max" id="price-max" value="1000000.00"/>
                <div class="price-cnt min">
                    <input class="price-min" type="text"/>
                    <span>a</span>
                </div>
                <div class="price-cnt max">
                    <input class="price-max" type="text"/>
                    <span>a</span>
                </div>
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
			
			                <div class="row" style="    position: relative; width: 770px;  float: right;">
					<div class="col13">
                        <fieldset>
                            <label for="filter-place-mouting">Место установки</label>
                            <select data-name="filter-place-mouting" name="filter-place-mouting" id="filter-place-mouting" multiple data-placeholder="Выберите место установки" class="js-multiple-select">
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
                            <label for="filter-style">Стиль</label>
                            <select data-name="filter-style" name="filter-style" id="filter-style" multiple data-placeholder="Выберите стиль" class="js-multiple-select">
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
          <!--  <div class="more-params-cnt">
                <a class="js-filter-more-params" href="#">
                    <span>Еще параметры</span>
                    <span>Свернуть</span>
                </a>
            </div> -->
        </div>
		
       <!--<div class="catalog-filter-bottom">
            <?if ($filter_view == "SVET"):?>
                <div class="row">
					<div class="col13">
                        <fieldset>
                            <label for="filter-place-mouting">Место установки</label>
                            <select data-name="filter-place-mouting" name="filter-place-mouting" id="filter-place-mouting" multiple data-placeholder="Выберите место установки" class="js-multiple-select">
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
                            <label for="filter-style">Стиль</label>
                            <select data-name="filter-style" name="filter-style" id="filter-style" multiple data-placeholder="Выберите стиль" class="js-multiple-select">
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
        </div> -->
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