<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if(count($arResult["SEARCH"])>0):?>
    <div class="outer-content-wrapper">
        <div class="content-wrapper">
            <h1>Результаты поиска</h1>
            <div class="search-tools-cnt">
                <div class="search-input-cnt">
                    <div class="search-form-cnt">
                        <form action="?search=all" method="get">
                            <input type="text" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" id="sp-search" class="search-input"/>
                            <input type="submit" class="search-submit" value=""/>
                            <p class="search-results">
                                По вашему запросу <em><?=$arResult["REQUEST"]["QUERY"]?></em> найдено страниц <em><?=$arResult["NAV_RESULT"]->NavPageCount?></em>
                            </p>
                        </form>
                    </div>
                    <div class="search-categories">
                        <div class="links">
                            <a href="?search=products&q=<?=$arResult["REQUEST"]["QUERY"]?>&onthepage=<?=htmlspecialchars($_GET["onthepage"])?>">Каталог</a>
                            <a href="#" class="active">Статьи</a>
                        </div>
                    </div>
                </div>
                <div class="results-count-cnt">
                    <div class="results-count">
                        <select class="js-common-select-nosearch js-search-page" name="results-count" id="results-count">
                            <option value="?search=all&q=<?=$arResult["REQUEST"]["QUERY"]?>&onthepage=6" <?if (htmlspecialchars($_GET["onthepage"]) == 6):?>selected<?endif?>>6</option>
                            <option value="?search=all&q=<?=$arResult["REQUEST"]["QUERY"]?>&onthepage=12" <?if (htmlspecialchars($_GET["onthepage"]) == 12):?>selected<?endif?>>12</option>
                            <option value="?search=all&q=<?=$arResult["REQUEST"]["QUERY"]?>&onthepage=24" <?if (htmlspecialchars($_GET["onthepage"]) == 24):?>selected<?endif?>>24</option>
                        </select>
                    </div>
                    <p class="results-count-text">Результатов <br/> на странице</p>
                </div>
            </div>
            <ul class="search-results-list">
                <?foreach($arResult["SEARCH"] as $arItem):?>
                    <li class="search-item">
                        <p class="header"><a href="<?=$arItem["URL"]?>"><?=$arItem["~TITLE"]?></a></p>
                        <p><?=htmlspecialchars_decode($arItem["~BODY_FORMATED"])?></p>
                    </li>
                <?endforeach?>
            </ul>
            <?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N"):?>
                <?=$arResult["NAV_STRING"]?>
            <?endif?>
        </div>
    </div>
<?else:?>
    <div class="empty-search-wrapper">
        <div class="content-wrapper">
            <h1>Результаты поиска</h1>
            <div class="search-tools-cnt">
                <div class="search-input-cnt">
                    <div class="search-form-cnt">
                        <form action="" method="get">
                            <input type="text" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" id="sp-search" class="search-input"/><input type="submit" class="search-submit" value=""/>
                        </form>
                    </div>
                    <div class="search-categories">
                        <div class="links">
                            <a href="?search=products&q=<?=$arResult["REQUEST"]["QUERY"]?>&onthepage=<?=htmlspecialchars($_GET["onthepage"])?>">Каталог</a>
                            <a href="#" class="active">Статьи</a>
                        </div>
                    </div>
                    <p class="search-results">
                        По вашему запросу <br/> <em><?=$arResult["REQUEST"]["QUERY"]?></em> найдено страниц <em>0</em>
                    </p>
                    <p class="search-meta">попробуйте поиск по другому параметру</p>
                </div>
            </div>
        </div>
    </div>
<?endif?>