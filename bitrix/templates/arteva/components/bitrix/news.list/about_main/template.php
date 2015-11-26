<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult["ITEMS"]):?>
	<?
		$firstElement = array_shift($arResult["ITEMS"]);
	?>
	<div class="about-img img-cnt bigger">
		<?if ($firstElement["PROPERTIES"]["LINK_PICTURE"]["VALUE"]) {?>
			<a href="<?=$firstElement["PROPERTIES"]["LINK_PICTURE"]["VALUE"]?>">
				<img class="cover-linked" src="<?=CFile::GetPath($firstElement["~PREVIEW_PICTURE"])?>" alt="about"/>
			</a>
		<?} else {?>
			<img class="cover" src="<?=CFile::GetPath($firstElement["~PREVIEW_PICTURE"])?>" alt="about"/>
		<?}?>
	</div>
	<div class="about-text">
	    <p class="header"><?=$firstElement["NAME"]?></p>
	    <?=$firstElement["~PREVIEW_TEXT"]?>
	    <p><a href="/about/">Подробнее</a></p>
	</div>
<?endif?>