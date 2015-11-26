<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult["ITEMS"]):?>
	<?foreach ($arResult["ITEMS"] as $key => $arItems) :?>
		<h2><?=$arItems["NAME"]?></h2>
		<?if ($arItems["~PREVIEW_PICTURE"]):?>
			<?if ($arItems["PROPERTIES"]["LINK"]["~VALUE"]):?>
				<a href="<?=$arItems["PROPERTIES"]["LINK"]["~VALUE"]?>" style="float:right;">
	        		<img src="<?=CFIle::GetPath($arItems["~PREVIEW_PICTURE"])?>" alt=""/>
	        	</a>
	        <?else:?>
				<img src="<?=CFIle::GetPath($arItems["~PREVIEW_PICTURE"])?>" alt=""/>
	        <?endif?>
        <?endif?>
        <?=$arItems["PREVIEW_TEXT"]?>
	<?endforeach?>
<?endif?>