<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult["ITEMS"]):?>
	<? $cnt=1; ?>
	<?foreach ($arResult["ITEMS"] as $key => $arItems) :?>
		<? if ($cnt == 1){?>
			<p class='phone-hold'><?=$arItems["NAME"]?></p>
			<? if ($arItems["PREVIEW_TEXT"]){?>
				<p class="header small"><span class="small"><?=$arItems["PREVIEW_TEXT"]?></span></p>
			<?}?>
		<?} else {?>	
			<p><?=$arItems["NAME"]?></p>
			<? if ($arItems["PREVIEW_TEXT"]){?>
				<p class="header small"><span class="small"><?=$arItems["PREVIEW_TEXT"]?></span></p>
			<?}?>
		<?}?>
		<? $cnt++; ?>
	<?endforeach?>
<?endif?>