<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult["ITEMS"]):
	foreach ($arResult["ITEMS"] as $key => $arItems) :
		$sum += intval($arItems["PRICE"])*intval($arItems["QUANTITY"]);
		$countAll += intval($arItems["QUANTITY"]);
	endforeach;
else:
	$countAll = 0;
	$sum = 0;
endif?>
<div class="cart-icon">
	<span class="js-cart-items-count"><?=$countAll?></span>
</div>
<div class="cart-text">
    <p>Корзина</p>
	<p class="sum js-sum" data-sum="<?=$sum?>">
		<?=number_format($sum, 0, 0, " ")?> <span class="rub">a</span>
	</p>
</div>