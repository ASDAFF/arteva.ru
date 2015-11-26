<div class="js-page" data-page="search"></div>
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
            <input type="hidden" name="onthepage" value="<?=$_REQUEST["onthepage"]?>">
            <input type="hidden" name="q" value="<?=$_REQUEST["q"]?>">
        </div>
    </form>
</div>