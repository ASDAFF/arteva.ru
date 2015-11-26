<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	// Получаем все родительские разделы текущего раздела
	$SecParants1 = GetAllParantsSection($arResult['ID']); 

	$APRT_DATA = "";
	if( count($SecParants1) > 1)
	{
		$APRT_DATA = "parentCategories: [";
		foreach($SecParants1 as $k => $SecPar)
			if($k != 0)	$APRT_DATA .= "{id: " . $SecPar["ID"] . ", name: '" . $SecPar["NAME"] . "'},";
		
		$APRT_DATA .= "]";
	}
?>
<script type="text/javascript">
	// Интеграция с retailrocket.ru
    rrApiOnReady.push(function() {
		try { rrApi.categoryView(<?= $arResult['ID']?>); } catch(e) {}
	})

	window.ad_category = "<?= $arResult['ID']?>";

	window.APRT_DATA = {
		pageType: 3,
		currentCategory: {
			id: <?= $arResult['ID']?>,
			name: "<?=$arResult["NAME"]?>"
		},
		<?=$APRT_DATA ?>
	}
</script>

<?if ($arResult["SEO_PRODUCTS"] && in_array($_REQUEST["page"], $arResult["SEO_PAGE_CODE"])):?>
    	<?if($GLOBALS['CAT_TITLE']){?>
		<h1><?=$GLOBALS['CAT_TITLE']?></h1>
	<?}else{?>
		<h1><?=$arResult["CUR_SEO_PAGE"]["NAME"]?></h1>
	<?}?>
	
    <div class="text-content">
        <?if ($arResult["CUR_SEO_PAGE"]["~PREVIEW_PICTURE"]):?>
            <img src="<?=CFile::GetPath($arResult["CUR_SEO_PAGE"]["~PREVIEW_PICTURE"])?>" alt=""/>
        <?endif?>
        <?=$arResult["CUR_SEO_PAGE"]["~PREVIEW_TEXT"]?>
    </div>
    <div class="item-cards-list-cnt">
        <ul class="item-cards-list matrix">
            <?foreach ($arResult["SEO_PRODUCTS"] as $key => $arItems) :?>
                <li class="item-card-item js-item" data-id="<?=$arItems["ID"]?>">
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
                            <p class="item-brand"><?=$arItems["NAME"]?></p>                            
                            <p class="item-desc">Артикул <?=$arItems["PROPERTY_ARTIKUL_VALUE"]?></p>
                            <?if ($arItems["PRICES"]["DISCOUNT_VALUE"] < $arItems["PRICES"]["PRICE"]){?>
								<div class="item-price">
									<div class="twoline"><span><?=number_format($arItems["PRICES"]["DISCOUNT_VALUE"], 0, 0, " ")?></span> <span class="rub">a</span> | </div>
									<div class="old-price twoline"><span><?=number_format($arItems["PRICES"]["PRICE"], 0, 0, " ")?></span> <span class="rub">a</span></div>
								</div>	
                            <?} elseif(isset($_COOKIE["bigbuzzy"]) && $_COOKIE["bigbuzzy"] == "Y" && $arItems["PROPERTIES"]["SALE"]["VALUE"] != 1) {?>
								<div class="item-price">
									<div class="twoline"><span><?=number_format($arItems["PRICES"]["DISCOUNT_VALUE"] * 0.9, 0, 0, " ")?></span> <span class="rub">a</span> | </div>
									<div class="old-price twoline"><span><?=number_format($arItems["PRICES"]["VALUE"], 0, 0, " ")?></span> <span class="rub">a</span></div>
								</div>
							<?} else {?>
								<div class="item-price"><span><?=number_format($arItems["PRICES"]["DISCOUNT_VALUE"], 0, 0, " ")?></span> <span class="rub">a</span></div>
							<?}?>							
							<input class="item-count js-item-count" value="1" type="text" name="item1-count" id="item1-count" style="display:none;" />							
							<div class="item-actions-cnt common_list">
								<a 
									class="btn important js-add-to-cart" 
									href="#" 
									onclick="ga('send', 'event', 'adtocart', '<?=$arItems["PROPERTIES"]["ARTIKUL"]["VALUE"]?>'); return true;"
									data-id="<?=$arItems["ID"]?>"
									data-name="<?=$arItems["NAME"]?>"
									data-price="<?=$arItems["PRICES"]["DISCOUNT_VALUE"]?>"
									onmousedown="try { rrApi.addToBasket(<?=$arItems["ID"]?>) } catch(e) {}"
									>Купить</a>
							</div>
                        </div>
                        <?if ($arItems["PROPERTY_HIT_VALUE"]):?>
                            <div class="item-card-badge hit">Хит продаж</div>
                        <?endif?>
                        <?if ($arItems["PROPERTY_NEW_VALUE"]):?>
                            <div class="item-card-badge new">Новинка</div>
                        <?endif?>
                        <?
                            $salePersent = 100-($arItems["PRICES"]["DISCOUNT_VALUE"]*100)/$arItems["PRICES"]["PRICE"];
                            $salePersent = number_format($salePersent, 0, 0, "");
							
							$bb = false;
							if( $arItems["PRICES"]["DISCOUNT_VALUE"] == $arItems["PRICES"]["PRICE"] ) $bb = true;
                        ?>
                        <?if ($salePersent > 0):?>
                            <div class="item-card-badge sale">скидка <?=$salePersent?>%</div>
                        <?endif?>
						<? if(isset($_COOKIE["bigbuzzy"]) && $_COOKIE["bigbuzzy"] == "Y" && $arItems["PROPERTIES"]["SALE"]["VALUE"] != 1 && $bb){?>
							<div class="item-card-badge sale">скидка 10% bb</div>
						<?}?> 
                    </a>
                </li>
            <?endforeach?>
        </ul>
        <div class="preload-overlay"><i></i></div>
    </div>
    <?if ($arResult["SEO_PAGES"]):?>
        <div class="catalog-tags-cnt">
            <ul class="catalog-tag-list">
                <?foreach ($arResult["SEO_PAGES"] as $key => $arSeoItems) :?>
                    <li class="catalog-tag <?if ($_REQUEST["page"] == $arSeoItems["CODE"]):?>active<?endif?>">
                        <a href="<?=$arResult["SECTION_PAGE_URL"]?>?page=<?=$arSeoItems["CODE"]?>"><?=$arSeoItems["NAME"]?></a>
                    </li>
                <?endforeach?>
            </ul>
        </div>
    <?endif?>
<?else:?>
	
	<?if ($_GET["show_all"] == 'yes'){?>
		<script type="text/javascript">
			$(window).load(function(){
				$('a.js-show-all-items').click();
				if (localStorage.detLink != 'full'){								
					setTimeout(function(){
                        $('html, body').animate({
							scrollTop: $(localStorage.detLink).offset().top-125 // 125 - высота верхней наезжающей плашки
						}, 1000);
                    }, 2000);					
					//console.log($(localStorage.detLink));
				}
			});
		</script>
	<?} else {?>
		<script type="text/javascript">
			$(window).load(function(){
				localStorage.detLink = 'full';
			});
		</script>
	<?}?>

    <?
        include($_SERVER["DOCUMENT_ROOT"]."/include/catalog_filter.php");
    ?>
    <div class="item-cards-list-cnt">
        <ul class="item-cards-list matrix">
        	<?foreach ($arResult["ITEMS"] as $key => $arItems) :?>
    	        <li class="item-card-item js-item" data-id="<?=$arItems["ID"]?>">
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
    	                    <p class="item-brand"><?=$arItems["NAME"]?></p>														
    	                    <p class="item-desc">Артикул <?=$arItems["PROPERTIES"]["ARTIKUL"]["VALUE"]?></p>
                            <?if ($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"] < $arItems["PRICES"]["BASE"]["VALUE"]){?>
							<div class="item-price">
								<div class="twoline"><span><?=number_format($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"], 0, 0, " ")?></span> <span class="rub">a</span> | </div>
                                <div class="old-price twoline"><span><?=number_format($arItems["PRICES"]["BASE"]["VALUE"], 0, 0, " ")?></span> <span class="rub">a</span></div>
							</div>
                            <?} elseif(isset($_COOKIE["bigbuzzy"]) && $_COOKIE["bigbuzzy"] == "Y" && $arItems["PROPERTIES"]["SALE"]["VALUE"] != 1) {?>
								<div class="item-price">
									<div class="twoline"><span><?=number_format($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"] * 0.9, 0, 0, " ")?></span> <span class="rub">a</span> | </div>
									<div class="old-price twoline"><span><?=number_format($arItems["PRICES"]["BASE"]["VALUE"], 0, 0, " ")?></span> <span class="rub">a</span></div>
								</div>
							<?} else {?>						
								<div class="item-price"><span><?=number_format($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"], 0, 0, " ")?></span> <span class="rub">a</span></div>							
							<?}?>							
							<input class="item-count js-item-count" value="1" type="text" name="item1-count" id="item1-count" style="display:none;" />							
							<div class="item-actions-cnt common_list">
								<a class="btn important js-add-to-cart" href="#" onmousedown="try { rrApi.addToBasket(<?=$arItems["ID"]?>) } catch(e) {}" onclick="ga('send', 'event', 'adtocart', '<?=$arItems["PROPERTIES"]["ARTIKUL"]["VALUE"]?>'); return true;"
									data-id="<?=$arItems["ID"]?>"
									data-name="<?=$arItems["NAME"]?>"
									data-price="<?=$arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"]?>"
								
								>Купить</a>
							</div>
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
							
							$bb = false;
							if($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"] == $arItems["PRICES"]["BASE"]["VALUE"]) $bb = true;
                        ?>
    	                <?if ($salePersent > 0):?>
    	                	<div class="item-card-badge sale">скидка <?=$salePersent?>%</div>
    	                <?endif?>
						<? if(isset($_COOKIE["bigbuzzy"]) && $_COOKIE["bigbuzzy"] == "Y" && $arItems["PROPERTIES"]["SALE"]["VALUE"] != 1 && $bb){?>
									<div class="item-card-badge sale">скидка 10% bb</div>
								<?}?> 
    	            </a>
    	        </li>
    	    <?endforeach?>
        </ul>
        <?if ($arResult["NAV_RESULT"]->NavPageCount > 1):?>
            <div class="show-all-items-cnt aright">
                <a class="btn important js-show-all-items" href="#" style="display:none;">Показать все</a> <!-- old -->
                <a class="btn important js-show-all-items-2" href="?show_all=yes">Показать все</a>
            </div>
        <?endif?>
        <div class="preload-overlay"><i></i></div>
    </div>
    <?if ($arResult["SEO_PAGES"]):?>
        <div class="catalog-tags-cnt">
            <ul class="catalog-tag-list">
                <?foreach ($arResult["SEO_PAGES"] as $key => $arSeoItems) :?>
                    <li class="catalog-tag <?if ($_REQUEST["page"] == $arSeoItems["CODE"]):?>active<?endif?>">
                        <a href="<?=$arResult["SECTION_PAGE_URL"]?>?page=<?=$arSeoItems["CODE"]?>"><?=$arSeoItems["NAME"]?></a>
                    </li>
                <?endforeach?>
            </ul>
        </div>
    <?endif?>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    	<?=$arResult["NAV_STRING"]?>
    <?endif;?>
<?endif?>