<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
global $APPLICATION;
$curpage = $APPLICATION->GetCurPage();
$arCurLink = explode("/", $curpage);
$arResult["SECTIONS"][] = array(
	"SECTION_PAGE_URL" => "/catalog/new/",
	"CODE" => "new",
	"NAME" => "Новинки",
	"DEPTH_LEVEL" => 0
	);
$arResult["SECTIONS"][] = array(
	"SECTION_PAGE_URL" => "/catalog/sale/",
	"NAME" => "Sale",
	"CODE" => "sale",
	"DEPTH_LEVEL" => 0
	);
//echo "<pre>";print_r($arResult["SECTIONS"]);echo "</pre>";
foreach ($arResult["SECTIONS"] as $key => $arSections) :
	$arLink = explode("/", $arSections["SECTION_PAGE_URL"]);
	if ($arCurLink[3] && $arSections["CODE"] == $arCurLink[3] && !in_array($arCurLink[3], array("svetilniki", "mebel", "predmety-interera"))):
		$arResult["SECTIONS"][$key]["SELECTED"] = true;
	elseif ($arCurLink[2] && $arSections["CODE"] == $arCurLink[2]):
		$arResult["SECTIONS"][$key]["SELECTED"] = true;
	else:
		$arResult["SECTIONS"][$key]["SELECTED"] = false;
	endif;
endforeach;
?>