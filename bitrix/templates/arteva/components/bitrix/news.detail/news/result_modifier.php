<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($arParams['ADD_SECTIONS_CHAIN'] && !empty($arResult['NAME']))
{

    $arResult['SECTION']['PATH'][] = array(

        'NAME' => $arResult['NAME'],
        'PATH' => ''
    );

}

$arSelect = Array("ID","NAME", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=>$arResult["IBLOCK_ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array($arParams["ELEMENT_SORT_FIELD"]=>$arParams["ELEMENT_SORT_ORDER"]), $arFilter, false, Array("nPageSize"=>1,"nElementID"=>$arResult['ID']), $arSelect);
while($ob = $res->GetNext())
{
	$arLinks[]=$ob;
}
$arResult["LINKS"] = $arLinks;
?>