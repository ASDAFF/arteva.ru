<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
foreach ($arResult["SECTIONS"] as $key => $arSections) :
	$arSelect = Array("ID", "NAME", "CODE", "PREVIEW_TEXT");
	$arFilter = Array("IBLOCK_ID"=>11, "ACTIVE"=>"Y", "SECTION_ID" => $arSections["ID"]);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement())
	{
		$arItem = $ob->GetFields();
		$arResult["SECTIONS"][$key]["ITEMS"][] = $arItem;
	}
endforeach;
?>