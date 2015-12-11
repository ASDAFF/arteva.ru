<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?

global $APPLICATION;
$i = 0;
foreach($_GET as $key =>  $val){

    $i ++;
    //if($key != 'section_code' and $key != 'section_id'){
    if($key != 'section_id'){
        if($i == 1){
            $par = '?' .  $key . '=' . $val;
        }else{
            if(is_array($val)){
                foreach($val as  $item){

                    $patter = "|[а-яё]|is";
                    if(preg_match($patter, $item)){
                        $item = urlencode($item);
                    }

                    $par .= '&' . $key . '%5B%5D=' . $item;
                }
            }else{
				if($key == 'section_code'){
					$par .= '&#38;' . $key . '=' . $val;
				}else{
					$par .= '&' . $key . '=' . $val;
				}
            }
        }
    }

}

$parr = str_replace(' ', '%20', $par);

if(!empty($_REQUEST['section_code'])){
    $url = '/catalog/' . trim($_REQUEST['section_code']) . '/';
}
if(!empty($GLOBALS['CATEGORY_CODE'])){
    $url .= $GLOBALS['CATEGORY_CODE'] . '/' . $parr;
}
//$urlPrint = str_replace('ion_code', 'section_code', $url);
//$urlPrint = str_replace('§', '&', $urlPrint);
$showAll = false;
$i = 0;

foreach ($arResult["ITEMS"] as $key => $arItems):
    $i ++;
    $labels = null;
    $salePersent = null;
    //$waterImage = waterImage($arItems["~PREVIEW_PICTURE"]);
    // $waterImage["src"]
    $waterImage["src"] = CFIle::GetPath($arItems["~PREVIEW_PICTURE"]);
	
	
	
	if(isset($_COOKIE["bigbuzzy"]) && $_COOKIE["bigbuzzy"] == "Y" && $arItems["PROPERTIES"]["SALE"]["VALUE"] != 1 && $arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"] == $arItems["PRICES"]["BASE"]["VALUE"]) 
	{
		$two_price = '</p><div class="item-price"><div class="twoline"><span>'.number_format($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"]*0.9, 0, 0, " ").'</span> <span class="rub">a</span> | </div>';
		$two_price .= '<div class="old-price twoline"><span>'.number_format($arItems["PRICES"]["BASE"]["VALUE"], 0, 0, " ").'</span> <span class="rub">a</span></div></div>';
		
	}else{
		$two_price = '</p><div class="item-price"><div class="twoline"><span>'.number_format($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"], 0, 0, " ").'</span> <span class="rub">a</span> | </div>';
		if ($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"] < $arItems["PRICES"]["BASE"]["VALUE"]){
			$two_price .= '<div class="old-price twoline"><span>'.number_format($arItems["PRICES"]["BASE"]["VALUE"], 0, 0, " ").'</span> <span class="rub">a</span></div></div>';
		} else {
			$two_price = '</p><div class="item-price"><span>'.number_format($arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"], 0, 0, " ").'</span> <span class="rub">a</span></div>';
		}
		
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
	
	if(isset($_COOKIE["bigbuzzy"]) && $_COOKIE["bigbuzzy"] == "Y" && $arItems["PROPERTIES"]["SALE"]["VALUE"] != 1 && $arItems["PRICES"]["BASE"]["DISCOUNT_VALUE"] == $arItems["PRICES"]["BASE"]["VALUE"]){
		$labels .= '<div class="item-card-badge sale">скидка 10% bb</div>';
	}
	
	
    if ($USER->IsAdmin()){
        if($i == 1){
            $html = '<div style="color:red" >' . $url . '</div>';
        }
    }

    $html .= '<li class="item-card-item js-item" data-id="'.$arItems["ID"].'">
                <a href="'.$arItems["DETAIL_PAGE_URL"].'">
                    <div class="img-cnt">
                    	<img src="/img/img_dummy.png" data-src="'.$waterImage["src"].'" alt=""/>
                    </div>
                    <div class="item-info">
                        <p class="item-brand">'.$arItems["NAME"].$two_price.'
                        <p class="item-desc">Артикул '.$arItems["PROPERTIES"]["ARTIKUL"]["VALUE"].'</p>
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

//============
require($_SERVER["DOCUMENT_ROOT"]."/include/section_props.php");
//AddMessage2Log($arResult);
// Get props values for filter
//$nonEmptyPropsOld = GetNonEmptyValuesForProps($arResult["IBLOCK_ID"], $arResult["ID"],$GLOBALS["arrFilterAjaxSection"]);
$nonEmptyProps = GetNonEmptyValuesForProps($arResult["IBLOCK_ID"], $arResult["ID"],
    Array("BRAND","STYLE","REPLICA","COLOR","COLOR_BASE","PLACE_MOUTING",$GLOBALS["MATERIAL_PROP_CODE"]),$GLOBALS["arrFilterAjaxSection"]);
//AddMessage2Log($nonEmptyPropsOld);
//AddMessage2Log($nonEmptyProps);
//=============

echo json_encode(
    array(
        "html" => ($html) ? $html : "",
        "page" => ($page) ? $page : "",
        "showall" => $showAll,
        "nonEmptyProps" => $nonEmptyProps
    )
);
?>