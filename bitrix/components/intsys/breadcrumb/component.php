<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$sections = preg_split('/\//', $arParams["PATH"], -1, PREG_SPLIT_NO_EMPTY);

$arResult = Array(
		"0" => array(
				"TITLE" => "Главная",
				"LINK" => "/",
		)
);

$i = 1;
$link = "/";
foreach ($sections as $s) {
	$rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 17, '=CODE' => $s));
	$link = $link . $s . "/";
	if ($arSection = $rsSections->Fetch()) {
		$arResult[$i] = array(
				"TITLE" => $arSection["NAME"],
				"LINK" => $link
		);
		$i++;
	} elseif ($i == 1 && ($s == "new" || $s == "sale")) {
		$arResult[$i] = array(
				"TITLE" => $s == "new" ? "Новинки" : "Распродажа",
				"LINK" => $link
		);
		$i++;
	}
}

$this->IncludeComponentTemplate();

//if (!$this->InitComponentTemplate())
//	return;

//$template = &$this->GetTemplate();
//$templatePath = $template->GetFile();
//$templateFolder = $template->GetFolder();
//
//$APPLICATION->SetAdditionalCSS($templateFolder."/style.css");
//
////Params
//$arParams["START_FROM"] = (isset($arParams["START_FROM"]) && intval($arParams["START_FROM"]) > 0 ? intval($arParams["START_FROM"]) : 0);
//$arParams["PATH"] = (isset($arParams["PATH"]) && strlen($arParams["PATH"]) > 0 ? htmlspecialcharsbx($arParams["PATH"]) : false);
//$arParams["SITE_ID"] = (isset($arParams["SITE_ID"]) && strlen($arParams["SITE_ID"]) == 2 ? htmlspecialcharsbx($arParams["SITE_ID"]) : false);
//
//if ($arParams["SITE_ID"] === false)
//	$path = $arParams["PATH"];
//else
//	$path = Array($arParams["SITE_ID"], $arParams["PATH"]);
//
//$APPLICATION->AddBufferContent(
//	Array(&$APPLICATION, "GetNavChain"),
//	$path,
//	$arParams["START_FROM"],
//	$templatePath,
//	$bIncludeOnce = true,
//	$bShowIcons = false
//);
?>