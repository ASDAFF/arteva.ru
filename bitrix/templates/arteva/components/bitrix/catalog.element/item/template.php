<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript">
    rrApiOnReady.push(function() {
  try{ rrApi.view(<?=$arResult["ID"]?>); } catch(e) {}
 })
</script>
<div itemscope itemtype="http://schema.org/Product" class="item-card-inner" data-id="<?=$arResult["ID"]?>" data-user="<?=$USER->GetID();?>">
    <aside class="item-card-gallery">
        <ul class="item-card-photos">
            <?  
                $view = true;
                if ($arResult["PROPERTIES"]["IMAGES"]["VALUE"] == ""):
                    $view = false;
                    $arResult["PROPERTIES"]["IMAGES"]["VALUE"][] = $arResult["~PREVIEW_PICTURE"];
                endif;
            ?>
            <?foreach ($arResult["PROPERTIES"]["IMAGES"]["VALUE"] as $key => $imgId) :?>
                <?
                    $waterImage = waterImage($imgId);
                    // $waterImage["src"]
                ?>
                <li>
                    <a rel="gallery1" class="js-fbx-image js-zoom" href="<?=$waterImage["src"]?>">
                        <img itemprop="image" src="<?=$waterImage["src"]?>" alt=""/>
                    </a>
                </li>
            <?endforeach?>
        </ul>
        <?if ($view === true):?>
            <div class="item-card-photos-pager">
                <?foreach ($arResult["PROPERTIES"]["IMAGES"]["VALUE"] as $key => $imgId) :?>
                    <?
                        $waterImage = waterImage($imgId);
                        // $waterImage["src"]
                    ?>
                    <a data-slide-index="<?=$key?>" href="">
                        <img itemprop="image" src="<?=$waterImage["src"]?>" data-large="<?=$waterImage["src"]?>" alt=""/>
                    </a>
                <?endforeach?>
            </div>
        <?endif?>
    </aside>
    <div class="item-card-info-cnt">
        <div class="item-top-info">
            <aside class="left">
                <?
                    $new_name = $arResult["NAME"];
                    $new_name.= " ".$arResult["PROPERTIES"]["BRAND"]["VALUE"][0];
                ?>
                <h1 itemprop="name" class="num name_tov"><?=$new_name?></h1><br/>
               
                <p class="name"> <span class="subhead21">Артикул</span> <?=$arResult["PROPERTIES"]["ARTIKUL"]["VALUE"]?></p>
            </aside>
            <div class="right">
			<?if(isset($_COOKIE["bigbuzzy"]) && $_COOKIE["bigbuzzy"] == "Y" && $arResult["PROPERTIES"]["SALE"]["VALUE"] != 1) {?>
					<p class="price" itemprop="priceCurrency" ><span itemprop="price" ><?=number_format($arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"] * 0.9, 0, 0, " ")?></span> руб.</p>
					<p class="old-price"><span><?=number_format($arResult["PRICES"]["BASE"]["VALUE"], 0, 0, " ")?></span> руб.</p>
			<?} else {?>
                <p class="price"  itemprop="price"><?=number_format($arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"], 0, 0, " ")?> <span itemprop="priceCurrency">руб.</span></p>
                <?if ($arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"] < $arResult["PRICES"]["BASE"]["VALUE"]):?>
                    <p class="old-price"><?=number_format($arResult["PRICES"]["BASE"]["VALUE"], 0, 0, " ")?> <span>руб.</span></p>
                <?endif?>
			<?}?>
            </div>

            <div class="right"">
                <?
                    $h_domain = $_SERVER['SERVER_NAME'];
                ?>
            <?
                $brand_name = str_replace(" ", "_", $arResult["PROPERTIES"]["BRAND"]["VALUE"][0]);
                //AddMessage2Log($arResult["PROPERTIES"]["BRAND"]["VALUE"][0], '/log/');
                echo '<a href="http://'.$h_domain.'/brands/'.$brand_name.'/">'
                    ."<img  style='width: 100px; height: 80px;' src='{$arResult['BRAND_LOGO']}'/>".
                    '</a>';
            ?>
            </div>
        </div>
        <div class="badge-cnt">
            <?if ($arResult["PROPERTIES"]["HIT"]["VALUE"]):?>
                <div class="item-card-inner-badge hit">Хит продаж</div>
            <?endif?>
            <?if ($arResult["PROPERTIES"]["NEW"]["VALUE"]):?>
                <div class="item-card-inner-badge new">Новинка</div>
            <?endif?>
            <?
                $salePersent = 100-($arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"]*100)/$arResult["PRICES"]["BASE"]["VALUE"];
                $salePersent = number_format($salePersent, 0, 0, "");
            ?>
            <?if ($salePersent > 0 && $salePersent != 100):?>
                <div class="item-card-inner-badge sale">скидка <?=$salePersent?>%</div>
            <?endif?>
            <p class="header">Выберите цвет</p>
            <div class="colors-cnt">
                <ul class="item-colors-list">
                    <?if (!$arResult["SIMILAR_ITEMS"]):?>
                        <li class="active">
                            <a style="background-color: <?=$arResult["PROPERTIES"]["CODE_COLOR"]["VALUE"]?>;" title="<?=implode(", ", $arResult["PROPERTIES"]["COLOR"]["VALUE"])?>"></a>
                        </li>
                    <?else:?>
                        <li class="active">
                            <a style="background-color: <?=$arResult["PROPERTIES"]["CODE_COLOR"]["VALUE"]?>;" href="#" title="<?=implode(", ", $arResult["PROPERTIES"]["COLOR"]["VALUE"])?>"></a>
                        </li>
                        <?foreach ($arResult["SIMILAR_ITEMS"] as $key => $items) :?>
                            <li>
                                <a style="background-color: <?=$items["PROPERTY_CODE_COLOR_VALUE"]?>;" href="<?=$items["DETAIL_PAGE_URL"]?>" title="<?=implode(", ", $items["PROPERTY_COLOR_VALUE"])?>"></a>
                            </li>
                        <?endforeach?>
                    <?endif?>
                </ul>
            </div>
            <div class="cart-item-count">
                <a class="item-dec js-dec" href="#">–</a>
                <input class="item-count js-item-count" value="1" type="text" name="item1-count" id="item1-count"/>
                <a class="item-inc js-inc" href="#">+</a>
                <span class="item-presence <?=($arResult["CATALOG_QUANTITY"] > 1) ? "yes" : "no"?>"><?=($arResult["CATALOG_QUANTITY"] > 1) ? "В наличии" : "По запросу"?></span>
            </div>
            <div class="item-actions-cnt">
                <a class="btn btn2 important js-add-to-cart-inner" href="#" onmousedown="try { rrApi.addToBasket(<?=$arResult["ID"]?>) } catch(e) {}" onclick="ga('send', 'event', 'adtocart', '<?=$arResult["PROPERTIES"]["ARTIKUL"]["VALUE"]?>'); return true;">Купить</a>
                <?if ($arResult["USER_DESIGNER"]):?>
                    <a class="btn js-add-to-spec-popup" href="#">В спецификацию</a>
                <?endif?>
            </div>
        </div>
        <div class="tabs-cnt">
            <ul class="js-panes-control tabs-list item-card-panes-control" data-panes="item-info">
                <li class="js-tab-item active">
                    <a class="js-pane-trigger active" href="#item-chars">Характеристики</a>
                </li>
                <li class="js-tab-item">
                    <a class="js-pane-trigger" href="#item-descr">Описание</a>
                </li>
            </ul>

            <div class="js-panes" id="item-info">
                <div class="js-pane item-tab-pane active" id="item-chars">
                    <div class="item-descr">
                        <p class="item-header print-show">Характеристики</p>
                        <?=$arResult["~DETAIL_TEXT"]?>
                    </div>
                </div>
                <div class="js-pane item-tab-pane" id="item-descr">
                    <div class="item-descr" itemprop="description">
                        <p class="item-header print-show">Описание</p>
                        <?=$arResult["PROPERTIES"]["OPIS"]["~VALUE"]?>
                    </div>
                </div>
            </div>
        </div>
        <?
            $arFavorites = getFavoriteItemsId($USER->GetID());
            $favorite = false;
            if ($arFavorites && in_array($arResult["ID"], $arFavorites)):
                $favorite = true;
            elseif ($_SESSION["FAVORITES_PRODUCTS"] && in_array($arResult["ID"], $_SESSION["FAVORITES_PRODUCTS"])):
                $favorite = true;
            endif;
        ?>
        <div class="item-card-utils">
            <div class="links-cnt">
                <div class="links-item js-share-info-holder" 
                    data-share-title="<?=$arResult["NAME"]?> (<?=$arResult["PROPERTIES"]["ARTIKUL"]["VALUE"]?>)" 
                    data-share-text="<?=htmlspecialchars($arResult["PROPERTIES"]["OPIS"]["~VALUE"])?>" 
                    data-share-img="http://<?=$_SERVER["HTTP_HOST"]?><?=CFile::GetPath($arResult["~PREVIEW_PICTURE"])?>">
                    <a data-share-inner="1" data-social-share="facebook" class="item-social fb" href="#" onclick="ga('send', 'event', 'social', 'fb', '<?=$arResult["PROPERTIES"]["ARTIKUL"]["VALUE"]?>'); return true;"></a>
                    <a data-share-inner="1" data-social-share="odnoklassniki" class="item-social ok" href="#" onclick="ga('send', 'event', 'social', 'odnoklassniki', '<?=$arResult["PROPERTIES"]["ARTIKUL"]["VALUE"]?>'); return true;"></a>
                    <a data-share-inner="1" data-social-share="vkontakte" class="item-social vk" href="#" onclick="ga('send', 'event', 'social', 'vk', '<?=$arResult["PROPERTIES"]["ARTIKUL"]["VALUE"]?>'); return true;"></a>
                </div>
                <div class="links-item">
                    <?if (!$favorite):?>
                        <a href="#" class="js-add-to-fav" onclick="ga('send', 'event', 'favorites', '<?=$arResult["PROPERTIES"]["ARTIKUL"]["VALUE"]?>'); return false;">В избранное</a>
                    <?else:?>
                        <a class="js-add-to-fav">В избранном</a>
                    <?endif?>
                </div>
                <div class="links-item">
                    <a href="#" class="js-print-version">Версия для печати</a>
                </div>
            </div>
        </div>
        <div class="backlink mobile-hide">
            <a href="<?=$arResult["SECTION"]["SECTION_PAGE_URL"]?>" class="btn btn-important" onclick="window.history.go(-1); return false;">Назад</a>
        </div>
    </div>
</div>
<? // CL($arResult["SECTION"]["NAME"]); ?>
<script type="text/javascript">
    // добавляем продукт в таблицу ранее просмотренных товаров
    var viewedCounter = {
        path: '/bitrix/components/bitrix/catalog.element/ajax.php',
        params: {
            AJAX: 'Y',
            SITE_ID: "<?=SITE_ID?>",
            PRODUCT_ID: "<?=$arResult['ID']?>",
            PARENT_ID: "<?=$arResult['ID']?>"
        }
    };
    BX.ready(
        BX.defer(function(){
            BX.ajax.post(
                viewedCounter.path,
                viewedCounter.params
            );
        })
    );
	
	localStorage.detLink = "a[href=\'"+window.location.pathname+"\']";
	
		window.APRT_DATA = {
		pageType: 2,
		currentProduct: {
			id: <?= $arResult['ID']?>,
			name: "<?= $arResult['NAME']?>",
			price: <?= round($arResult['MIN_PRICE']['VALUE'])?>
		},
		currentCategory: {
			id: <?= $arResult['IBLOCK_SECTION_ID']?>,
			name: "<?=$arResult["SECTION"]["NAME"]?>"
		},
	}
</script>