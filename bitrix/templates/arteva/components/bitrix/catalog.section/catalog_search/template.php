<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"])>0):?>
    <div class="outer-content-wrapper">
        <div class="content-wrapper">
            <h1>Результаты поиска</h1>
            <div class="search-tools-cnt">
                <div class="search-input-cnt">
                    <div class="search-form-cnt">
                        <form action="" method="get">
                            <input type="hidden" name="search" value="products">
                            <input type="text" name="q" value="<?=$_GET["q"]?>" id="sp-search" class="search-input"/>
                            <input type="submit" class="search-submit" value=""/>
                            <p class="search-results">
                                По вашему запросу <em><?=$_GET["q"]?></em> найдено страниц <em><?=$arResult["NAV_RESULT"]->NavPageCount?></em>
                            </p>
                        </form>
                    </div>
                    <div class="search-categories">
                        <div class="links">
                            <a href="#" class="active">Каталог</a>
                            <a href="?search=all&q=<?=$_GET["q"]?>&onthepage=<?=$_GET["onthepage"]?>">Статьи</a>
                        </div>
                    </div>
                </div>
                <div class="results-count-cnt">
                    <div class="results-count">
                        <select class="js-common-select-nosearch js-search-page" name="results-count" id="results-count">
                            <option value="?search=products&q=<?=$_GET["q"]?>&onthepage=6" <?if ($_GET["onthepage"] == 6):?>selected<?endif?>>6</option>
                            <option value="?search=products&q=<?=$_GET["q"]?>&onthepage=12" <?if ($_GET["onthepage"] == 12):?>selected<?endif?>>12</option>
                            <option value="?search=products&q=<?=$_GET["q"]?>&onthepage=24" <?if ($_GET["onthepage"] == 24):?>selected<?endif?>>24</option>
                        </select>
                    </div>
                    <p class="results-count-text">Результатов <br/> на странице</p>
                </div>
            </div>
            <br/>
            <?
                include_once($_SERVER["DOCUMENT_ROOT"]."/include/search_filter.php");
            ?>
            <div class="item-cards-list-cnt">
                <ul class="item-cards-list matrix">
                	<?foreach ($arResult["ITEMS"] as $key => $arItems) :?>
            	        <li class="item-card-item">
            	            <a href="<?=$arItems["DETAIL_PAGE_URL"]?>">
                                <?
                                    //$waterImage = waterImage($arItems["~PREVIEW_PICTURE"]);
                                    // $waterImage["src"]
                                    $waterImage["src"] = CFIle::GetPath($arItems["~PREVIEW_PICTURE"]);
                                ?>
            	                <div class="img-cnt">
                                    <img src="/img/img_dummy.png" data-src="<?=$waterImage["src"]?>" alt=""/>
                                </div>
                                <div class="item-info">
                                    <p class="item-brand">Артикул <?=$arItems["PROPERTIES"]["ARTIKUL"]["VALUE"]?></p>
                                    <p class="item-desc"><?=$arItems["NAME"]?></p>
                                    <p class="item-price"><span><?=number_format($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"], 0, 0, " ")?></span> руб.</p>
                                    <?if ($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"] < $arItems["PRICES"]["BASE"]["VALUE"]):?>
                                        <p class="old-price"><span><?=number_format($arItems["PRICES"]["BASE"]["VALUE"], 0, 0, " ")?></span> руб.</p>
                                    <?endif?>
                                </div>
                                <?if ($arItems["PROPERTIES"]["HIT"]["VALUE"]):?>
                                    <div class="item-card-badge hit">Хит продаж</div>
                                <?endif?>
                                <?if ($arItems["PROPERTIES"]["NEW"]["VALUE"]):?>
                                    <div class="item-card-badge new">Новинка</div>
                                <?endif?>
                                <?
                                    $salePersent = 100-($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"]*100)/$arItems["PRICES"]["BASE"]["VALUE"];
                                    $salePersent = number_format($salePersent, 0, 0, "");
                                ?>
                                <?if ($salePersent > 0):?>
                                    <div class="item-card-badge sale">скидка <?=$salePersent?>%</div>
                                <?endif?>
            	            </a>
            	        </li>
            	    <?endforeach?>
                </ul>
                <?if ($arResult["NAV_RESULT"]->NavPageCount > 1):?>
                    <div class="show-all-items-cnt aright">
                        <a class="btn important js-show-all-items-2" href="?search=products&q=<?=$_GET["q"]?>&onthepage=all">Показать все</a>
                    </div>
                <?endif?>
                <div class="preload-overlay"><i></i></div>
            </div>
            <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
            	<?=$arResult["NAV_STRING"]?>
            <?endif;?>
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
                            <input type="hidden" name="search" value="products">
                            <input type="text" name="q" value="<?=$_GET["q"]?>" id="sp-search" class="search-input"/>
                            <input type="submit" class="search-submit" value=""/>
                        </form>
                    </div>
                    <div class="search-categories">
                        <div class="links">
                            <a href="#" class="active">Каталог</a>
                            <a href="?search=all&q=<?=$_GET["q"]?>&onthepage=<?=$_GET["onthepage"]?>">Статьи</a>
                        </div>
                    </div>
                    <p class="search-results">
                        По вашему запросу <br/> <em><?=$_GET["q"]?></em> найдено страниц <em>0</em>
                    </p>
                    <p class="search-meta">попробуйте поиск по другому параметру</p>
                </div>
            </div>
        </div>
    </div>
<?endif?>