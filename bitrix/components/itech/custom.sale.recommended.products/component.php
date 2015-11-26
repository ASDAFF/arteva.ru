<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


$arSelect = Array("ID");
$arFilter = Array("IBLOCK_ID"=>IntVal($arParams['IBLOCK_ID']), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "CODE" => $arParams['CODE']);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
while($arFields = $res->GetNext())
{
	$elementID = $arFields['ID'];
}

$res = CIBlockElement::GetProperty($arParams['IBLOCK_ID'], $elementID, "sort", "asc", array("CODE" => $arParams['PROPERTY_LINK']));
if ($ob = $res->GetNext())
{
    $stringRecommendedProducts = $ob['VALUE'];
    $arRecommendedProducts = explode(",", $stringRecommendedProducts);
}

foreach($arRecommendedProducts as $key => $recommendedProduct){
	$arRecommendedProducts[$key] = trim($recommendedProduct);
}
if($arRecommendedProducts[0] <> ""){
	$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL");
	$arSelect = array_merge($arSelect, $arParams['PROPERTY_CODE']);
	$arFilter = Array("IBLOCK_ID"=>IntVal($arParams['IBLOCK_ID']), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_ID_PROD" => $arRecommendedProducts);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($arFields = $res->GetNext())
	{
		$dbPrice = CPrice::GetList(
		    array("QUANTITY_FROM" => "ASC", "QUANTITY_TO" => "ASC", 
		          "SORT" => "ASC"),
		    array("PRODUCT_ID" => $arFields['ID']),
		    false,
		    false,
		    array("ID", "CATALOG_GROUP_ID", "PRICE", "CURRENCY", 
		          "QUANTITY_FROM", "QUANTITY_TO")
		);
		while ($arPrice = $dbPrice->Fetch())
		{
		    $arDiscounts = CCatalogDiscount::GetDiscountByPrice(
		            $arPrice["ID"],
		            $USER->GetUserGroupArray(),
		            "N",
		            SITE_ID
		        );
		    if(count($arDiscounts)){
		    	$discountPrice = CCatalogProduct::CountPriceWithDiscount(
		            $arPrice["PRICE"],
		            $arPrice["CURRENCY"],
		            $arDiscounts
		        );
			    $arPrice["DISCOUNT_PRICE"] = $discountPrice;
		    }else{
		    	$arPrice["DISCOUNT_PRICE"] = $arPrice['PRICE'];
		    }

		    $arFields['PRICE_VALUE'] = $arPrice;
		}
		$arResult['ITEMS'][] = $arFields;
	}
}
$this->IncludeComponentTemplate();
?>