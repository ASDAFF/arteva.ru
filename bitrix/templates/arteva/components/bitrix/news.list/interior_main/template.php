<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult["ITEMS"]):?>
	<div class="promo-header">
        <p>Наши изделия</p>
        <p>в интерьерах</p>
    </div>
    <div class="main-promo">
        <div class="center bigger" onclick="location.href='/projects/'" style="cursor:pointer;">
            <p><span style="padding: 3px;">Наши изделия</span></p>
            <p style="font-size:normal;"><span><em>в интерьерах</em></span></p>
        </div>
		<div class="center-big">
			<? if ($arResult["ITEMS"][0]["PREVIEW_TEXT"]){ ?>
				<div class="img-cnt bigger" onclick="location.href='<?=$arResult["ITEMS"][0]["PREVIEW_TEXT"]?>'" style="cursor:pointer;">
					<img class="cover" src="<?=CFile::GetPath($arResult["ITEMS"][0]["~PREVIEW_PICTURE"])?>" alt="<?=$arResult["ITEMS"][0]["NAME"]?>"/>
				</div>
			<?} else {?>
				<div class="img-cnt">
					<img class="cover" src="<?=CFile::GetPath($arResult["ITEMS"][0]["~PREVIEW_PICTURE"])?>" alt="<?=$arResult["ITEMS"][0]["NAME"]?>"/>
				</div>
			<?}?>
        </div>
		<div class="left">
			<? if ($arResult["ITEMS"][1]["PREVIEW_TEXT"]){ ?>
				<div class="img-cnt bigger" onclick="location.href='<?=$arResult["ITEMS"][1]["PREVIEW_TEXT"]?>'" style="cursor:pointer;">
					<img class="cover" src="<?=CFile::GetPath($arResult["ITEMS"][1]["~PREVIEW_PICTURE"])?>" alt="<?=$arResult["ITEMS"][1]["NAME"]?>"/>
				</div>
			<?} else {?>
				<div class="img-cnt">
					<img class="cover" src="<?=CFile::GetPath($arResult["ITEMS"][1]["~PREVIEW_PICTURE"])?>" alt="<?=$arResult["ITEMS"][1]["NAME"]?>"/>
				</div>
			<?}?>
			<? if ($arResult["ITEMS"][2]["PREVIEW_TEXT"]){ ?>			
				<div class="img-cnt bigger" onclick="location.href='<?=$arResult["ITEMS"][2]["PREVIEW_TEXT"]?>'" style="cursor:pointer;">
					<img class="cover" src="<?=CFile::GetPath($arResult["ITEMS"][2]["~PREVIEW_PICTURE"])?>" alt="<?=$arResult["ITEMS"][2]["NAME"]?>"/>
				</div>
			<?} else {?>
				<div class="img-cnt">
					<img class="cover" src="<?=CFile::GetPath($arResult["ITEMS"][2]["~PREVIEW_PICTURE"])?>" alt="<?=$arResult["ITEMS"][2]["NAME"]?>"/>
				</div>
			<?}?>
        </div>
		<div class="right">
			<? if ($arResult["ITEMS"][3]["PREVIEW_TEXT"]){ ?>
				<div class="img-cnt bigger" onclick="location.href='<?=$arResult["ITEMS"][3]["PREVIEW_TEXT"]?>'" style="cursor:pointer;">
					<img class="cover" src="<?=CFile::GetPath($arResult["ITEMS"][3]["~PREVIEW_PICTURE"])?>" alt="<?=$arResult["ITEMS"][3]["NAME"]?>"/>
				</div>
			<?} else {?>
				<div class="img-cnt">
					<img class="cover" src="<?=CFile::GetPath($arResult["ITEMS"][3]["~PREVIEW_PICTURE"])?>" alt="<?=$arResult["ITEMS"][3]["NAME"]?>"/>
				</div>
			<?}?>
        </div>
	</div>
<?endif?>