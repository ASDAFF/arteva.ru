<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? include_once($_SERVER["DOCUMENT_ROOT"]."/include/getTitle_and_getAlt.php"); ?>
<?if ($arResult["ITEMS"]):?>
	<?foreach ($arResult["ITEMS"] as $key => $arItems) :?>
		<h2><?=$arItems["NAME"]?></h2>
		<?if ($arItems["~DETAIL_PICTURE"]):?>
			<?if ($arItems["PROPERTIES"]["LINK"]["~VALUE"]):?>
				<a href="<?=$arItems["PROPERTIES"]["LINK"]["~VALUE"]?>" style="float:right;">
	        		<img src="<?=CFIle::GetPath($arItems["~DETAIL_PICTURE"])?>" alt="<?=getAlt($arItems)?>" title="<?=getTitle($arItems)?>"/>
	        	</a>
	        <?else:?>
				<img src="<?=CFIle::GetPath($arItems["~DETAIL_PICTURE"])?>" alt="<?=getAlt($arItems)?>" title="<?=getTitle($arItems)?>"/>
	        <?endif?>
        <?endif?>
        <?=$arItems["DETAIL_TEXT"]?>
	<?endforeach?>
<?endif?>