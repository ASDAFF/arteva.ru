<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="cart-cnt js-big-cart">
    <a class="cart-print-link js-print-version" href="#">Распечатать</a>
    <div class="cart-header">
        <div class="cart-row">
            <div class="cell header-cell cell-img">&nbsp;</div>
            <div class="cell header-cell cell-descr">Описание</div>
            <div class="cell header-cell cell-color">Цвет</div>
            <div class="cell header-cell cell-count">Количество</div>
            <div class="cell header-cell cell-price">Цена</div>
            <div class="cell header-cell cell-remove">Удалить</div>
        </div>
    </div>
    <div class="cart-body">
    	<?foreach ($arResult["ITEMS"]["AnDelCanBuy"] as $key => $arItems) :?>
    		<?
    			$arPropItems = getItemCart($arItems["PRODUCT_ID"]);
    			$allPriceCart += intval($arItems["PRICE"]+$arItems["DISCOUNT_PRICE"]) * intval($arItems["QUANTITY"]);
                $allCount += $arItems["QUANTITY"];
    		?>
            <div class="cart-row js-item" data-id="<?=$arItems["ID"]?>" data-price="<?=intval($arItems["PRICE"]+$arItems["DISCOUNT_PRICE"])?>">
                <div class="cell body-cell cell-img">
                	<a href="<?=$arPropItems["DETAIL_PAGE_URL"]?>">
                		<?
	                        //$waterImage = waterImage($arItems["PREVIEW_PICTURE"]);
	                        // $waterImage["src"]
	                        $waterImage["src"] = CFIle::GetPath($arItems["PREVIEW_PICTURE"]);
	                    ?>
	                    <div class="img-cnt">
	                    	<img src="<?=$waterImage["src"]?>" alt="item image"/>
	                    </div>
	                </a>
                </div>
                <div class="cells-cnt">
                    <div class="cell body-cell cell-descr">
                        <p class="num">Артикул <?=$arPropItems["PROPERTY_ARTIKUL_VALUE"]?></p>
                        <p><?=$arItems["NAME"]?></p>
                    </div>
                    <div class="cell body-cell cell-color">
                        <p><?=implode(", ", $arPropItems["PROPERTY_COLOR_VALUE"])?></p>
                    </div>
                    <div class="cell body-cell cell-count">
                        <div class="cart-item-count">
                            <a class="item-dec js-dec" href="#">–</a>
                            <input class="item-count js-item-count" value="<?=$arItems["QUANTITY"]?>" type="text" name="count" id="item-count"/>
                            <a class="item-inc js-inc" href="#">+</a>
                        </div>
                    </div>
                    <div class="cell body-cell cell-price">
                        <p><?=number_format($arItems["PRICE"]*$arItems["QUANTITY"], 0, 0, " ")?> руб.</p>
                        <?if ($arItems["PRICE"] < $arItems["FULL_PRICE"]):?>
                        	<p class="item-old-price"><?=number_format($arItems["FULL_PRICE"]*$arItems["QUANTITY"], 0, 0, " ")?> руб.</p>
                        <?endif?>
                    </div>
                    <div class="cell body-cell cell-remove">
                    	<a class="remove-item js-item-remove" href="#" data-id="<?=$arItems["ID"]?>"></a>
                    </div>
                </div>
            </div>
        <?endforeach?>
    </div>
    <div class="cart-footer">
        <div class="summary-cnt">
            <p>Стоимость товаров<span><em class="js-cart-sum"><?=number_format($allPriceCart, 0, 0, " ")?></em> руб.</span></p>
            <p>Скидка на заказ <span><em class="js-cart-discount"><?=number_format($arResult["DISCOUNT_PRICE_ALL"], 0, 0, " ")?></em> руб</span></p>
            <p class="cart-total">Итого <span><em class="js-cart-discount-sum"><?=number_format($arResult["allSum"], 0, 0, " ")?></em> руб</span></p>
            <p class="js-total-count" data-count="<?=$allCount?>"></p>
        </div>
    </div>
</div>
<div class="cart-submit-cnt">
    <a class="btn important js-submit-form" href="/personal/order/make/" onclick="ga('send', 'event', 'order', 'place'); return true;">Оформить заказ</a>
</div>