<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Избранное");
$APPLICATION->SetPageProperty("keywords", "Избранное");
$APPLICATION->SetPageProperty("description", "Избранное");
$APPLICATION->SetTitle("Избранное");?>
<?
	$idUser = $USER->GetID();
	$favorites = getFavorites($idUser);
    if ($favorites["result"] && $favorites["items"]):
        $arResultItems = getFavoriteProducts($favorites["items"]);
    elseif ($_SESSION["FAVORITES_PRODUCTS"]):
        $arResultItems = getFavoriteProducts($_SESSION["FAVORITES_PRODUCTS"]);
    endif;
?>
<div class="outer-content-wrapper">
    <div class="content-wrapper">
        <?$APPLICATION->IncludeComponent(
	        "bitrix:breadcrumb",
	        "bread",
	        Array(
	            "START_FROM" => "0",
	            "PATH" => "",
	            "SITE_ID" => "-"
	        )
	    );?>
        <h1>Избранные товары</h1>
        <div class="item-cards-list-cnt wishlist js-content-favorites" data-user="<?=$idUser?>">
        	<?if ($arResultItems):?>
	            <ul class="item-cards-list actionable matrix">
	            	<?foreach ($arResultItems as $key => $arItems) :?>
                        <li class="item-card-item js-item" data-id="<?=$arItems["ID"]?>" data-user="<?=$idUser?>">
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
                                    <p class="item-brand">Артикул: <?=$arItems["PROPERTIES"]["ARTIKUL"]["VALUE"]?></p>
                                    <p class="item-desc"><?=$arItems["NAME"]?></p>
                                    <p class="item-price"><span><?=number_format($arItems["PRICES"]["DISCOUNT_VALUE"], 0, 0, " ")?></span> руб.</p>
                                    <?if ($arItems["PRICES"]["DISCOUNT_VALUE"] < $arItems["PRICES"]["PRICE"]):?>
                                        <p class="old-price"><span><?=number_format($arItems["PRICES"]["PRICE"], 0, 0, " ")?></span> руб.</p>
                                    <?endif?>
                                </div>
                                <?if ($arItems["PROPERTIES"]["HIT"]["VALUE"]):?>
                                    <div class="item-card-badge hit">Хит продаж</div>
                                <?endif?>
                                <?if ($arItems["PROPERTIES"]["NEW"]["VALUE"]):?>
                                    <div class="item-card-badge new">Новинка</div>
                                <?endif?>
                                <?
                                    $salePersent = 100-($arItems["PRICES"]["DISCOUNT_VALUE"]*100)/$arItems["PRICES"]["PRICE"];
                                    $salePersent = number_format($salePersent, 0, 0, "");
                                ?>
                                <?if ($salePersent > 0):?>
                                    <div class="item-card-badge sale">скидка <?=$salePersent?>%</div>
                                <?endif?>
                            </a>
                            <div class="item-actions">
		                        <a class="fleft btn small-btn important js-add-to-cart" href="#">В корзину</a>
                                <?if ($USER->isAuthorized() && in_array(8, $USER->GetUserGroupArray())):?>
                                    <a class="fright mr10 inline js-add-to-spec-popup" href="#">В спецификацию</a>
                                <?endif?>
		                    </div>
                            <input class="js-item-count" type="hidden" name="item-fav-count" value="1"/>
		                    <a class="item-remove js-wishlist-item-remove" href="#"></a>
                        </li>
                    <?endforeach?>
	            </ul>
	        <?else:?>
				<p class="emptycart-text">Ваш список избранных товаров пуст...</p>
			<?endif?>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>