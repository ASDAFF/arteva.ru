<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

function getSections($id){
	$arFilter = Array('IBLOCK_ID'=>$IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y', "SECTION_ID" => $id);
	$db_list = CIBlockSection::GetList(Array("SORT" => "ASC"), $arFilter, true);
	while($ar_result = $db_list->GetNext())
	{
		if (($ar_result["RIGHT_MARGIN"] - $ar_result["LEFT_MARGIN"]) > 1):
			$ar_result["SECTIONS"] = getSections($ar_result["ID"]);
		endif;
		$arSections[] = $ar_result;
	}
	return $arSections;
}

foreach ($arResult["SECTIONS"] as $key => $arSections) :
	$arSections["SECTIONS"] = getSections($arSections["ID"]);
	$arResult["SECTIONS"][$key] = $arSections;
endforeach;
//echo "<pre>";print_r($arResult);echo "</pre>";
?>