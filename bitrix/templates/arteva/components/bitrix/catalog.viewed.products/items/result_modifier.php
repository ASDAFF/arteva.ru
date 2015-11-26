<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
foreach ($arResult["ITEMS"] as $key => $arItems) :
	$arSelect = Array();
	$arFilter = Array("IBLOCK_ID" => 17, "ACTIVE" => "Y", "ID" => $arItems["ID"]);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	if($ob = $res->GetNextElement())
	{
		$arProps = $ob->GetProperties();
	}
	$arResult["ITEMS"][$key]["PROPERTIES"] = $arProps;
endforeach;
?>