<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult["ITEMS"]):?>
    <?
        $firstElement = array_shift($arResult["ITEMS"]);
    ?>
    <div class="item-big js-item mainBlock" data-id="<?=$arItems["ID"]?>">
		<div class="shadowBlockBottom" style="display:none;">
			<input class="item-count js-item-count" value="1" type="text" name="item1-count" id="item1-count" style="display:none;" />			
			<div class="item-actions-cnt common_list">
				<a class="btn important js-add-to-cart" href="#" onclick="ga('send', 'event', 'adtocart', '<?=$arItems["PROPERTIES"]["ARTIKUL"]["VALUE"]?>'); return true;">Купить</a>
			</div>
		</div>
        <a href="<?=$firstElement["DETAIL_PAGE_URL"]?>">
            <?
                //$waterImage = waterImage($firstElement["~PREVIEW_PICTURE"]);
                // $waterImage["src"]
                $waterImage["src"] = CFIle::GetPath($firstElement["~PREVIEW_PICTURE"]);
            ?>
            <div class="img-cnt">
                <img src="<?=$waterImage["src"]?>" alt="<?=$firstElement["NAME"]?>"/>
            </div>
            <div class="item-info">
                <div>
                    <p class="item-name">Артикул <?=$firstElement["PROPERTIES"]["ARTIKUL"]["VALUE"]?></p>
                    <p class="item-desc"><?=$firstElement["NAME"]?></p>          
                    <?if ($firstElement["PRICES"]["BASE"]["DISCOUNT_VALUE"] < $firstElement["PRICES"]["BASE"]["VALUE"]){?>
						<div class="item-price oneline"><span><?=number_format($firstElement["PRICES"]["BASE"]["DISCOUNT_VALUE"], 0, 0, " ")?></span> <span class="rub">a</span> | </div>
                        <div class="old-price oneline"><span><?=number_format($firstElement["PRICES"]["BASE"]["VALUE"], 0, 0, " ")?></span> <span class="rub">a</span></div>
                    <?} else {?>
						 <div class="item-price"><span><?=number_format($firstElement["PRICES"]["BASE"]["DISCOUNT_VALUE"], 0, 0, " ")?></span> <span class="rub">a</span></div>
					<?}?>
                </div>
            </div>
            <?if ($firstElement["PROPERTIES"]["HIT"]["VALUE"]):?>
                <div class="item-card-badge hit">Хит продаж</div>
            <?endif?>
            <?if ($firstElement["PROPERTIES"]["NEW"]["VALUE"]):?>
                <div class="item-card-badge new">Новинка</div>
            <?endif?>
            <?
                $salePersent = 100-($firstElement["PRICES"]["BASE"]["DISCOUNT_VALUE"]*100)/$firstElement["PRICES"]["BASE"]["VALUE"];
                $salePersent = number_format($salePersent, 0, 0, "");
            ?>
            <?if ($salePersent > 0):?>
                <div class="item-card-badge sale">скидка <?=$salePersent?>%</div>
            <?endif?>
        </a>
    </div>
    <?foreach ($arResult["ITEMS"] as $key => $arItems) :?>
    	<div class="item js-item mainBlock" data-id="<?=$arItems["ID"]?>">
			<div class="shadowBlockBottom" style="display:none;">
				<input class="item-count js-item-count" value="1" type="text" name="item1-count" id="item1-count" style="display:none;" />			
				<div class="item-actions-cnt common_list">
					<a class="btn important js-add-to-cart" href="#" onclick="ga('send', 'event', 'adtocart', '<?=$arItems["PROPERTIES"]["ARTIKUL"]["VALUE"]?>'); return true;">Купить</a>
				</div>
			</div>
    		<a href="<?=$arItems["DETAIL_PAGE_URL"]?>">
                <?
                    //$waterImage = waterImage($arItems["~PREVIEW_PICTURE"]);
                    // $waterImage["src"]
                    $waterImage["src"] = CFIle::GetPath($arItems["~PREVIEW_PICTURE"]);
                ?>
    	        <div class="img-cnt">
                    <img src="<?=$waterImage["src"]?>" alt=""/>
                </div>
    	        <div class="item-info">
    	            <p class="item-name">Артикул <?=$arItems["PROPERTIES"]["ARTIKUL"]["VALUE"]?></p>
    	            <p class="item-desc"><?=$arItems["NAME"]?></p>    	         
                    <?if ($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"] < $arItems["PRICES"]["BASE"]["VALUE"]){?>
                        <div class="item-price oneline"><span><?=number_format($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"], 0, 0, " ")?></span> <span class="rub">a</span> | </div>
						<div class="old-price oneline"><span><?=number_format($arItems["PRICES"]["BASE"]["VALUE"], 0, 0, " ")?></span> <span class="rub">a</span></div>
                    <?} else {?>
						<div class="item-price"><span><?=number_format($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"], 0, 0, " ")?></span> <span class="rub">a</span></div>
					<?}?>
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
    	</div>
    <?endforeach?>
<?endif?>