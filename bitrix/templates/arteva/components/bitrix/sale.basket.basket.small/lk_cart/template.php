<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult["ITEMS"]):?>
	<?foreach ($arResult["ITEMS"] as $key => $arItems) :
		$sum += intval($arItems["PRICE"])*intval($arItems["QUANTITY"]);
		$countAll += intval($arItems["QUANTITY"]);
	endforeach;?>
	<div class="lk-toc-row"><span>Товаров</span><span><?=$countAll?></span></div>
	<div class="lk-toc-row"><span>На общую сумму</span><span><?=number_format($sum, 0, 0, " ")?> руб.</span></div>
	<a class="btn small-btn important" href="/personal/cart/">Перейти в корзину</a>
<?else:?>
	<p class="emptycart-text">Ваша корзина пуста</p>
<?endif?>