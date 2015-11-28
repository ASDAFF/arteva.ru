<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
global $APPLICATION;
$curpage = $APPLICATION->GetCurPage();
$arCurLink = explode("/", $curpage);
$arResult["SECTIONS"][] = array(
	"SECTION_PAGE_URL" => "/new/",
	"CODE" => "new",
	"NAME" => "Новинки",
	"DEPTH_LEVEL" => 0
	);
$arResult["SECTIONS"][] = array(
	"SECTION_PAGE_URL" => "/sale/",
	"NAME" => "Sale",
	"CODE" => "sale",
	"DEPTH_LEVEL" => 0
	);
//echo "<pre>";print_r($arResult["SECTIONS"]);echo "</pre>";
foreach ($arResult["SECTIONS"] as $key => $arSections) :
	$arLink = explode("/", $arSections["SECTION_PAGE_URL"]);
	if ($arCurLink[2] && $arSections["CODE"] == $arCurLink[2] && !in_array($arCurLink[2], array("svetilniki", "mebel", "predmety-interera"))):
		$arResult["SECTIONS"][$key]["SELECTED"] = true;
	elseif ($arCurLink[1] && $arSections["CODE"] == $arCurLink[1	]):
		$arResult["SECTIONS"][$key]["SELECTED"] = true;
	else:
		$arResult["SECTIONS"][$key]["SELECTED"] = false;
	endif;
endforeach;
?>