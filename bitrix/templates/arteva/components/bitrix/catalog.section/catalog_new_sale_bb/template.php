<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
// include($_SERVER["DOCUMENT_ROOT"]."/include/catalog_filter_bb.php"); // Фильтр отправляет данные на адресс /include/catalog_filter_bb.php
PR($arResult["NAV_RESULT"]->NavRecordCount);

/* 	BASE: Object
		CAN_ACCESS: "Y"
		CAN_BUY: "Y"
		CURRENCY: "RUB"
		DISCOUNT_DIFF: 3000
		DISCOUNT_DIFF_PERCENT: 60
		DISCOUNT_VALUE: 2000
		DISCOUNT_VALUE_NOVAT: 2000
		DISCOUNT_VALUE_VAT: 2000
		DISCOUNT_VATRATE_VALUE: 0
		ID: "23115"
		MIN_PRICE: "Y"
		PRICE_ID: 1
		PRINT_DISCOUNT_DIFF: "3 000 руб."
		PRINT_DISCOUNT_VALUE: "2 000 руб."
		PRINT_DISCOUNT_VALUE_NOVAT: "2 000 руб."
		PRINT_DISCOUNT_VALUE_VAT: "2 000 руб."
		PRINT_DISCOUNT_VATRATE_VALUE: "0 руб."
		PRINT_VALUE: "5 000 руб."
		PRINT_VALUE_NOVAT: "5 000 руб."
		PRINT_VALUE_VAT: "5 000 руб."
		PRINT_VATRATE_VALUE: "0 руб."
		VALUE: 5000
		VALUE_NOVAT: 5000
		VALUE_VAT: 5000
		VATRATE_VALUE: 0 */
?>
<div class="item-cards-list-cnt">
    <ul class="item-cards-list matrix">
    	<?foreach ($arResult["ITEMS"] as $key => $arItems) :
			// CL($arItems);
		?>
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
						$bb = false;
						if( $arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"] == $arItems["PRICES"]["BASE"]["VALUE"] ) $bb = true;
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
            <a class="btn important js-show-all-items" href="<?=$APPLICATION->GetCurPageParam("showall=Y");?>">Показать все</a>
        </div>
    <?endif?>
    <div class="preload-overlay"><i></i></div>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>