<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
    include($_SERVER["DOCUMENT_ROOT"]."/include/catalog_filter_new_sale.php");
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
                        <?} else {?>
							<div class="item-price"><span><?=number_format($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"], 0, 0, " ")?></span> <span class="rub">a</span></div>
						<?}?>						
						<input class="item-count js-item-count" value="1" type="text" name="item1-count" id="item1-count" style="display:none;" />
						<div class="item-actions-cnt common_list">
							<a class="btn important js-add-to-cart" href="#" onclick="ga('send', 'event', 'adtocart', '<?=$arItems["PROPERTIES"]["ARTIKUL"]["VALUE"]?>'); return true;">Купить</a>
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
            <a class="btn important js-show-all-items" href="#">Показать все</a>
        </div>
    <?endif?>
    <div class="preload-overlay"><i></i></div>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>