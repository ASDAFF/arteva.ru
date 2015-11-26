<?
global $APPLICATION;
$curpage = $APPLICATION->GetCurPage();
$arLink = explode("/", $curpage);
$link = $arLink[2];
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"section_inner_new_sale",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "17",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "Y",
		"TOP_DEPTH" => "1",
		"SECTION_FIELDS" => array("","",""),
		"SECTION_USER_FIELDS" => array("UF_1C_ID","",""),
		"VIEW_MODE" => "LINE",
		"SHOW_PARENT_NAME" => "Y",
		"SECTION_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "",
		"CACHE_GROUPS" => "Y",
		"ADD_SECTIONS_CHAIN" => "N"
	)
);?>
<div class="catalog-filter">
    <form class="common-form inverse" action="">
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
                <input class="css-checkbox js-filter-presence" <?if ($_REQUEST["presence"] == true):?>checked<?endif?> type="checkbox" name="filter-presence" id="filter-presence"/>
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
        </div>
        <?if ($link == "new"):?>
            <input type="hidden" name="new" value="1">
            <input type="hidden" name="sale" value="">
        <?elseif ($link == "sale"):?>
            <input type="hidden" name="new" value="">
            <input type="hidden" name="sale" value="1">
        <?endif?>
        <input type="hidden" name="section_code" value="<?=htmlspecialchars($_REQUEST["SECTION_CODE"])?>">
        <input type="hidden" name="section_id" value="<?=$arResult["ID"]?>">
    </form>
</div>