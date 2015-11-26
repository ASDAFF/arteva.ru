<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($arParams['ADD_SECTIONS_CHAIN'] && !empty($arResult['NAME']))
{

    $arResult['SECTION']['PATH'][] = array(

        'NAME' => 'Проекты дизайнера',
        'PATH' => ''
    );

}
$arSelect = Array();
$arFilter = Array("IBLOCK_ID"=> 8, "ACTIVE"=>"Y", "PROPERTY_DESIGNER" => $arResult["ID"]);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
	$arResult["ITEMS"][] = $ob->GetFields();
}
?>