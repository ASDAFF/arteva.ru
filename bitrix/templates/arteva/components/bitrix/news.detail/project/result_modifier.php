<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($arParams['ADD_SECTIONS_CHAIN'] && !empty($arResult['NAME']))
{

    $arResult['SECTION']['PATH'][] = array(

        'NAME' => $arResult['NAME'],
        'PATH' => ''
    );

}

$arSelect = Array();
$arFilter = Array("IBLOCK_ID"=> 13, "ACTIVE"=>"Y", "ID" => $arResult["PROPERTIES"]["DESIGNER"]["VALUE"]);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 	$arDesigner = $ob->GetFields();
 	$arDesigner["PROPERTIES"] = $ob->GetProperties();
}
$arResult["DESIGNER"] = $arDesigner;

global $USER;
foreach ($arResult["PROPERTIES"]["PRODUCTS"]["VALUE"] as $key => $idProd) :
    $arSelectProd = Array("ID", "NAME", "PREVIEW_PICTURE", "PROPERTY_ARTIKUL", "PROPERTY_NEW", "PROPERTY_HIT", "DETAIL_PAGE_URL");
    $arFilterProd = Array("IBLOCK_ID"=>17, "ACTIVE"=>"Y", "ID" => $idProd);
    $resProd = CIBlockElement::GetList(Array(), $arFilterProd, false, false, $arSelectProd);
    if($obProd = $resProd->GetNextElement())
    {
        $arItem = $obProd->GetFields();
        $dbPrice = CPrice::GetList(
            array("QUANTITY_FROM" => "ASC", "QUANTITY_TO" => "ASC", "SORT" => "ASC"),
            array("PRODUCT_ID" => $arItem["ID"]),
            false,
            false,
            array("ID", "CATALOG_GROUP_ID", "PRICE", "CURRENCY", "QUANTITY_FROM", "QUANTITY_TO")
            );
        if($arPrice = $dbPrice->Fetch()):
            $arDiscounts = CCatalogDiscount::GetDiscountByPrice($arPrice["ID"], $USER->GetUserGroupArray(), "N", SITE_ID);
            $discountPrice = CCatalogProduct::CountPriceWithDiscount($arPrice["PRICE"], $arPrice["CURRENCY"], $arDiscounts);
            $arPrice["DISCOUNT_VALUE"] = $discountPrice;
            $arItem["PRICES"] = $arPrice;
        endif;
        $arProducts[] = $arItem;
    }
endforeach;
$arResult["ITEMS"] = $arProducts;
?>