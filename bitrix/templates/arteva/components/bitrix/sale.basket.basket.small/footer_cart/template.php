<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p class="header">
	<a class="js-close-cart icon-close-cart mobile-show" href="#"></a>
	Ваша корзина
</p>
<?if ($arResult["ITEMS"]):?>
	<form method="get" action="/personal/cart/" name="basket_form">
		<div class="top-cart-items-list-cnt">
			<ul class="top-cart-items-list js-items-list">
				<?foreach ($arResult["ITEMS"] as $key => $arItems) :?>
					<?
						$sum += intval($arItems["PRICE"])*intval($arItems["QUANTITY"]);
						$itemsum = intval($arItems["PRICE"])*intval($arItems["QUANTITY"]);
						$arItemValue = getItemCart($arItems["PRODUCT_ID"]);
						$allCount += intval($arItems["QUANTITY"]);
					?>
				    <li class="top-cart-item js-item" data-id="<?=$arItems["ID"]?>" data-price="<?=$arItems["PRICE"] * 1?>">
				        <aside>
				        	<a href="<?=$arItems["DETAIL_PAGE_URL"]?>">
				        		<?
			                        //$waterImage = waterImage($arItemValue["~PREVIEW_PICTURE"]);
			                        // $waterImage["src"]
			                        $waterImage["src"] = CFIle::GetPath($arItemValue["~PREVIEW_PICTURE"]);
			                    ?>
					            <div class="img-cnt">
					            	<img src="<?=$waterImage["src"]?>" alt="item1"/>
					            </div>
				            </a>
				        </aside>
				        <div class="cart-item-info">
				            <p class="cart-item-name">
				            	<a href="<?=$arItemValue["DETAIL_PAGE_URL"]?>"><?=$arItemValue["NAME"]?></a>
				            </p>
				            <p class="cart-item-num">Артикул <?=$arItemValue["PROPERTY_ARTIKUL_VALUE"]?></p>
				            <div class="cart-item-digits">
				                <div class="cart-item-count">
				                    <a class="item-dec js-dec" href="#">–</a>
				                    <input class="item-count js-item-count" value="<?=$arItems["QUANTITY"]*1?>" type="text" name="count" id="item1-count"/>
				                    <a class="item-inc js-inc" href="#">+</a>
				                </div>
				                <div class="cart-item-sum"><span class="js-item-sum" data-sum="<?=$itemsum?>"><?=number_format($itemsum, 0, 0, " ")?></span> руб.</div>
				            </div>
				        </div>
				        <a class="remove-item js-remove-item" href="#"></a>
				 	</li>
				<?endforeach?>
			</ul>
		</div>
		<div class="cart-item-total-cnt">
			<span>ИТОГО</span>
			<span class="total-sum">
				<strong class="js-total-sum" data-sum="<?=$sum?>" data-count="<?=$allCount?>"><?=number_format($sum, 0, 0, " ")?> </strong>руб.
			</span>
		</div>
		<div class="submit-cnt">
			<a class="btn js-goto-cart" href="#" onclick="ga('send', 'event', 'cart', 'next-step'); return true;">Перейти к оформлению</a>
		</div>
	</form>
<?else:?>
	<p class="empty-cart">Ваша корзина пуста</p>
<?endif?>