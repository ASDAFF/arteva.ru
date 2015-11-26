<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$showAll = false;
$i = 0;
foreach ($arResult["ITEMS"] as $key => $arItems):
    $i ++;
    $labels = null;
    $salePersent = null;
    $two_price = '</p><div class="item-price"><div class="twoline"><span>'.number_format($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"], 0, 0, " ").'</span> <span class="rub">a</span> | </div>';
    //$waterImage = waterImage($arItems["~PREVIEW_PICTURE"]);
    // $waterImage["src"]
    $waterImage["src"] = CFIle::GetPath($arItems["~PREVIEW_PICTURE"]);
    if ($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"] < $arItems["PRICES"]["BASE"]["VALUE"]){
        $two_price .= '<div class="old-price twoline"><span>'.number_format($arItems["PRICES"]["BASE"]["VALUE"], 0, 0, " ").'</span> <span class="rub">a</span></div></div>';
    } else {
        $two_price = '</p><div class="item-price"><span>'.number_format($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"], 0, 0, " ").'</span> <span class="rub">a</span></div>';
    }
    if ($arItems["PROPERTIES"]["HIT"]["VALUE"]):
        $labels .= '<div class="item-card-badge hit">Хит продаж</div>';
    endif;
    if ($arItems["PROPERTIES"]["NEW"]["VALUE"]):
        $labels .= '<div class="item-card-badge new">Новинка</div>';
    endif;
    $salePersent = 100-($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"]*100)/$arItems["PRICES"]["BASE"]["VALUE"];
    $salePersent = number_format($salePersent, 0, 0, "");
    if ($salePersent > 0):
        $labels .= '<div class="item-card-badge sale">скидка '.$salePersent.'%</div>';
    endif;
    $html .= '<li class="item-card-item js-item" data-id="'.$arItems["ID"].'">
                <a href="'.$arItems["DETAIL_PAGE_URL"].'">
                    <div class="img-cnt">
                        <img src="/img/img_dummy.png" data-src="'.$waterImage["src"].'" alt=""/>
                    </div>
                    <div class="item-info">
                        <p class="item-brand">Артикул '.$arItems["PROPERTIES"]["ARTIKUL"]["VALUE"].'</p>
                        <p class="item-desc">'.$arItems["NAME"].$two_price.'
                        <input class="item-count js-item-count" value="1" type="text" name="item1-count" id="item1-count" style="display:none;" />                      
                        <div class="item-actions-cnt common_list">
                            <a class="btn important js-add-to-cart" href="#" onclick="ga(\'send\', \'event\', \'adtocart\', \''.$arItems["PROPERTIES"]["ARTIKUL"]["VALUE"].'\'); return true;">Купить</a>
                        </div>
                    </div>
                    '.$labels.'
                </a>
            </li>';
endforeach;
if($arParams["DISPLAY_BOTTOM_PAGER"]):
    $page = $arResult["NAV_STRING"];
endif;

if ($arResult["NAV_RESULT"]->NavPageCount > 1):
    $showAll = true;
endif;

echo json_encode(
    array(
        "html" => ($html) ? $html : "",
        "page" => ($page) ? $page : "",
        "showall" => $showAll
    )
);
?>