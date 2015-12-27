<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$sections = preg_split('/\//', $arParams["PATH"], -1, PREG_SPLIT_NO_EMPTY);

$URL_TYPE = GetUrlType(trim($arParams["PATH"], "/"));

$arResult = Array(
		"0" => array(
				"TITLE" => "Главная",
				"LINK" => "/",
		)
);

$i = 1;
$link = "/";

// Типы URL, который мы обрабатываем
// -1. URL неправильный
// 0. Обычный SECTION_CODE_PATH
// 1. SECTION_CODE_PATH + brandname
// 2. new + SECTION_CODE_PATH
// 3. sale + SECTION_CODE_PATH
// 4. /brands/
// 5. /brands/brandname/

$len = count($sections);

if ($URL_TYPE == 0) {
	foreach ($sections as $s) {
		$rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 17, '=CODE' => $s));
		$link = $link . $s . "/";
		if ($arSection = $rsSections->Fetch()) {
			$arResult[$i] = array(
				"TITLE" => $arSection["NAME"],
				"LINK" => $link
			);
			$i++;
		}
	}
} elseif ($URL_TYPE == 1) {
    foreach (array_slice($sections, 0, $len - 2) as $s) {
        $rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 17, '=CODE' => $s));
        $link = $link . $s . "/";
        if ($arSection = $rsSections->Fetch()) {
            $arResult[] = array(
                "TITLE" => $arSection["NAME"],
                "LINK" => $link
            );
            $i++;
        }
    }
    $CURRENT_BRAND = GetBrandByXmlId($sections[$len - 1]);
    $rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 17, '=CODE' => $sections[$len - 2]));
    $link = $link . $sections[$len - 2] . "/";
    if ($arSection = $rsSections->Fetch()) {
        $arResult[] = array(
            "TITLE" => $arSection["NAME"] . " " . $CURRENT_BRAND["VALUE"],
            "LINK" => $link
        );
        $i++;
    }
} elseif ($URL_TYPE == 2) {
	$link = $link . $sections[0] . "/";
	$arResult[] = array(
		"TITLE" => "Новинки",
		"LINK" => $link
	);
	$i++;
	foreach (array_slice($sections, 1) as $s) {
		$rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 17, '=CODE' => $s));
		$link = $link . $s . "/";
		if ($arSection = $rsSections->Fetch()) {
			$arResult[$i] = array(
				"TITLE" => $arSection["NAME"],
				"LINK" => $link
			);
			$i++;
		}
	}
} elseif ($URL_TYPE == 3) {
	$link = $link . $sections[0] . "/";
	$arResult[] = array(
		"TITLE" => "Распродажа",
		"LINK" => $link
	);
	$i++;
	foreach (array_slice($sections, 1) as $s) {
		$rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 17, '=CODE' => $s));
		$link = $link . $s . "/";
		if ($arSection = $rsSections->Fetch()) {
			$arResult[$i] = array(
				"TITLE" => $arSection["NAME"],
				"LINK" => $link
			);
			$i++;
		}
	}
} elseif($URL_TYPE == 4) {
	$link = $link . $sections[0] . "/";
	$arResult[] = array(
		"TITLE" => "Бренды",
		"LINK" => $link
	);
	$i++;
} elseif ($URL_TYPE == 5) {
    $CURRENT_BRAND = GetBrandByXmlId($sections[1]);
	$link = $link . $sections[0] . "/";
	$arResult[] = array(
		"TITLE" => "Бренды",
		"LINK" => $link
	);
	$i++;
	$link = $link . $sections[1] . "/";
	$arResult[] = array(
		"TITLE" => $CURRENT_BRAND["VALUE"],
		"LINK" => $link
	);
	$i++;
}

/*foreach ($sections as $s) {
	if ($i == 3) {
		$CURRENT_BRAND = GetBrandByXmlId($s);
		$brandFilter = $CURRENT_BRAND != false;

		if ($brandFilter) {
			$arResult[2]["TITLE"] = $arResult[2]["TITLE"] . " " . $CURRENT_BRAND["VALUE"];
		}

		continue;
	} elseif ($i == 2 && $sections[0] == "brands") {
		$CURRENT_BRAND = GetBrandByXmlId($s);
		$arResult[$i] = array(
				"TITLE" => $CURRENT_BRAND["VALUE"],
				"LINK" => $link
		);
		$i++;
		continue;
	}
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
	} elseif ($i == 1 && $s == "brands") {
		$arResult[$i] = array(
				"TITLE" => "Бренды",
				"LINK" => $link
		);
		$i++;
	}
}*/

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