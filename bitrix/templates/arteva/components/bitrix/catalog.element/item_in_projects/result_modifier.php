<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
// товар в проектах
$i = 0;
$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID" => 8, "ACTIVE" => "Y", "PROPERTY_PRODUCTS" => $arResult["ID"]);
$res = CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
	if ($i <= 2):
		$arProjects[] = $ob->GetFields();
		$i++;
	endif;
}
$arResult["PRODUCT_PROJECTS"] = $arProjects;

//echo "<pre>";print_r($arSimilarItems);echo "</pre>";
?>