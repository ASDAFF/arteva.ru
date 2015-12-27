<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

//	var_dump($arResult);
	// Получаем все родительские разделы текущего раздела
	$SecParants1 = GetAllParantsSection($arResult['ID']); 

	$APRT_DATA = "";
	if( count($SecParants1) > 1)
	{
		$APRT_DATA = "parentCategories: [";
		foreach($SecParants1 as $k => $SecPar)
			if($k != 0)	$APRT_DATA .= "{id: " . $SecPar["ID"] . ", name: '" . $SecPar["NAME"] . "'},";
		
		$APRT_DATA .= "]";
	}
?>
<script>
	// Интеграция с retailrocket.ru
    rrApiOnReady.push(function() {
		try { rrApi.categoryView(<?= $arResult['ID']?>); } catch(e) {}
	})
	
	
	window.ad_category = "<?= $arResult['ID']?>";

	window.APRT_DATA = {
		pageType: 3,
		currentCategory: {
			id: <?= $arResult['ID']?>,
			name: "<?=$arResult["NAME"]?>"
		},
		<?=$APRT_DATA ?>
	}
</script>


<?if ($arResult["SEO_PRODUCTS"] && in_array($_REQUEST["page"], $arResult["SEO_PAGE_CODE"])):?>
	<div class="outer-content-wrapper">
    	<div class="content-wrapper">
			<?$APPLICATION->IncludeComponent("intsys:breadcrumb","bread",Array(
							"START_FROM" => "0",
							"PATH" => $APPLICATION->GetCurPage(),
							"SITE_ID" => "s1"
					)
			);?>
		    <h1><?=$arResult["CUR_SEO_PAGE"]["NAME"]?></h1>
		    <div class="text-content">
		        <?if ($arResult["CUR_SEO_PAGE"]["~PREVIEW_PICTURE"]):?>
		            <img src="<?=CFile::GetPath($arResult["CUR_SEO_PAGE"]["~PREVIEW_PICTURE"])?>" alt=""/>
		        <?endif?>
		        <?=$arResult["CUR_SEO_PAGE"]["~PREVIEW_TEXT"]?>
		    </div>
		    <div class="item-cards-list-cnt">
		        <ul class="item-cards-list matrix">
		            <?foreach ($arResult["SEO_PRODUCTS"] as $key => $arItems) :?>
		                <li class="item-card-item">
		                    <a href="<?=$arItems["DETAIL_PAGE_URL"]?>">
		                        <?
		                            //$waterImage = waterImage($arItems["~PREVIEW_PICTURE"]);
		                            // $waterImage["src"]
		                            $waterImage["src"] = CFIle::GetPath($arItems["~PREVIEW_PICTURE"]);
		                        ?>
		                        <div class="img-cnt">
		                            <img src="/img/img_dummy.png" data-src="<?=$waterImage["src"]?>" alt=""/>
		                        </div>
		                        <div class="item-info">
		                            <p class="item-brand"><?=$arItems["NAME"]?></p>
		                            <p class="item-desc">Артикул <?=$arItems["PROPERTY_ARTIKUL_VALUE"]?></p>
									
									<?if(isset($_COOKIE["bigbuzzy"]) && $_COOKIE["bigbuzzy"] == "Y" && $arItems["PROPERTIES"]["SALE"]["VALUE"] != 1) {?>
											<p class="item-price"><span><?=number_format($arItems["PRICES"]["DISCOUNT_VALUE"] * 0.9, 0, 0, " ")?></span> руб.</p>
											<p class="old-price"><span><?=number_format($arItems["PRICES"]["PRICE"], 0, 0, " ")?></span> руб.</p>
									<?} else {?>
										<p class="item-price"><span><?=number_format($arItems["PRICES"]["DISCOUNT_VALUE"], 0, 0, " ")?></span> руб.</p>
										<?if ($arItems["PRICES"]["DISCOUNT_VALUE"] < $arItems["PRICES"]["PRICE"]):?>
											<p class="old-price"><span><?=number_format($arItems["PRICES"]["PRICE"], 0, 0, " ")?></span> руб.</p>
										<?endif?>
									<?}?>
									
		                        </div>
		                        <?if ($arItems["PROPERTY_HIT_VALUE"]):?>
		                            <div class="item-card-badge hit">Хит продаж</div>
		                        <?endif?>
		                        <?if ($arItems["PROPERTY_NEW_VALUE"]):?>
		                            <div class="item-card-badge new">Новинка</div>
		                        <?endif?>
		                        <?
		                            $salePersent = 100-($arItems["PRICES"]["DISCOUNT_VALUE"]*100)/$arItems["PRICES"]["PRICE"];
		                            $salePersent = number_format($salePersent, 0, 0, "");
		                        ?>
		                        <?if ($salePersent > 0):?>
		                            <div class="item-card-badge sale">скидка <?=$salePersent?>%</div>
		                        <?endif?>
								<? if(isset($_COOKIE["bigbuzzy"]) && $_COOKIE["bigbuzzy"] == "Y" && $arItems["PROPERTIES"]["SALE"]["VALUE"] != 1){?>
									<div class="item-card-badge sale">скидка 10% bb</div>
								<?}?> 
		                    </a>
		                </li>
		            <?endforeach?>
		        </ul>
		        <div class="preload-overlay"><i></i></div>
		    </div>
		    <?if ($arResult["SEO_PAGES"]):?>
		        <div class="catalog-tags-cnt">
		            <ul class="catalog-tag-list">
		                <?foreach ($arResult["SEO_PAGES"] as $key => $arSeoItems) :?>
		                    <li class="catalog-tag <?if ($_REQUEST["page"] == $arSeoItems["CODE"]):?>active<?endif?>">
		                        <a href="<?=$arResult["SECTION_PAGE_URL"]?>?page=<?=$arSeoItems["CODE"]?>"><?=$arSeoItems["NAME"]?></a>
		                    </li>
		                <?endforeach?>
		            </ul>
		        </div>
		    <?endif?>
		</div>
	</div>
<?else:?>
	<div class="outer-content-wrapper">
    	<div class="content-wrapper">
			<?$APPLICATION->IncludeComponent("intsys:breadcrumb","bread",Array(
							"START_FROM" => "0",
							"PATH" => $APPLICATION->GetCurPage(),
							"SITE_ID" => "s1"
					)
			);?>
		    <?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"section",
				Array(
					"IBLOCK_TYPE" => "catalog",
					"IBLOCK_ID" => "17",
					"SECTION_ID" => "",
					"SECTION_CODE" => $arResult["CODE"],
					"COUNT_ELEMENTS" => "Y",
					"TOP_DEPTH" => "1",
					"SECTION_FIELDS" => array("","",""),
					"SECTION_USER_FIELDS" => array("UF_1C_ID","",""),
					"VIEW_MODE" => "LINE",
					"SHOW_PARENT_NAME" => "Y",
					"SECTION_URL" => "",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "36000000",
					"CACHE_GROUPS" => "Y",
					"ADD_SECTIONS_CHAIN" => "Y",
					"FILTER_NAME" => $arParams['FILTER_NAME'],
				)
			);?>
	    </div>
	</div>
	<?
		include_once($_SERVER['DOCUMENT_ROOT'].'/include/getTitle_and_getAlt.php');
	?>
	<div class="outer-content-wrapper">
	    <div class="content-wrapper">
	        <div class="item-cards-list-cnt">
	            <ul class="item-cards-list matrix">
	            	<?foreach ($arResult["ITEMS"] as $key => $arItems) :?>
		                <li class="item-card-item">
		                    <a href="<?=$arItems["DETAIL_PAGE_URL"]?>">
		                    	<?
			                        //$waterImage = waterImage($arItems["~PREVIEW_PICTURE"]);
			                        // $waterImage["src"]
			                        $waterImage["src"] = CFIle::GetPath($arItems["~PREVIEW_PICTURE"]);
			                    ?>
		                        <div class="img-cnt">
		                        	<img src="/img/img_dummy.png" data-src="<?=$waterImage["src"]?>" alt="<?=getAlt($arItems)?>" title="<?=getTitle($arItems)?>"/>
		                        </div>
		                        <div class="item-info">
		                            <p class="item-brand"><?=$arItems["NAME"]?></p>
		                            <p class="item-desc">Артикул <?=$arItems["PROPERTIES"]["ARTIKUL"]["VALUE"]?></p>
									
									<?if(isset($_COOKIE["bigbuzzy"]) && $_COOKIE["bigbuzzy"] == "Y" && $arItems["PROPERTIES"]["SALE"]["VALUE"] != 1) {?>
											<p class="item-price"><span><?=number_format($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"] * 0.9, 0, 0, " ")?></span> руб.</p>
											<p class="old-price"><span><?=number_format($arItems["PRICES"]["BASE"]["VALUE"], 0, 0, " ")?></span> руб.</p>
									<?} else {?>
		                            <p class="item-price"><span><?=number_format($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"], 0, 0, " ")?></span> руб.</p>
		                        	<?if ($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"] < $arItems["PRICES"]["BASE"]["VALUE"]):?>
			                            <p class="old-price"><span><?=number_format($arItems["PRICES"]["BASE"]["VALUE"], 0, 0, " ")?></span> руб.</p>
			                        <?endif?>
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
								<? if(isset($_COOKIE["bigbuzzy"]) && $_COOKIE["bigbuzzy"] == "Y" && $arItems["PROPERTIES"]["SALE"]["VALUE"] != 1){?>
									<div class="item-card-badge sale">скидка 10% bb</div>
								<?}?> 
		                    </a>
		                </li>
	               	<?endforeach?>
	            </ul>
				<div class="preload-overlay"><i></i></div>
	        </div>
	        <?if ($arResult["SEO_PAGES"]):?>
		        <div class="catalog-tags-cnt">
		            <ul class="catalog-tag-list">
		                <?foreach ($arResult["SEO_PAGES"] as $key => $arSeoItems) :?>
		                    <li class="catalog-tag <?if ($_REQUEST["page"] == $arSeoItems["CODE"]):?>active<?endif?>">
		                        <a href="<?=$arResult["SECTION_PAGE_URL"]?>?page=<?=$arSeoItems["CODE"]?>"><?=$arSeoItems["NAME"]?></a>
		                    </li>
		                <?endforeach?>
		            </ul>
		        </div>
		    <?endif?>
	    </div>
	</div>
<?endif?>