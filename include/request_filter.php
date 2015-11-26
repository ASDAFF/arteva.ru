<?php
global $APPLICATION;
$curpage = $APPLICATION->GetCurPage();
$arLink = explode("/", $curpage);
$link = $arLink[2];
// фильтр по сортировке
if (empty($_REQUEST["sortPopular"]) && empty($_REQUEST["sortPrice"])):
	if ($link == "sale"): // сортировка для sale
		$sort1 = "PROPERTY_SORT_SALE";
		$typeSort1 = "asc";	
	elseif ($link == "new"): // сортировка для new
		$sort1 = "PROPERTY_SORT_NEW";
		$typeSort1 = "asc";
	else:
		$sort1 = "sort";
		$typeSort1 = "asc";
	endif;
	$sort2 = "sort";
	$typeSort2 = "asc";
elseif ($_REQUEST["sortPopular"] == -1 && $_REQUEST["sortPrice"] == 0):
	$sort1 = "catalog_PRICE_1";
	$typeSort1 = "desc";
	$sort2 = "sort";
	$typeSort2 = "asc";
elseif ($_REQUEST["sortPopular"] == -1 && $_REQUEST["sortPrice"] == 1):
	$sort1 = "catalog_PRICE_1";
	$typeSort1 = "asc";
	$sort2 = "sort";
	$typeSort2 = "asc";
elseif ($_REQUEST["sortPopular"] == 0 && $_REQUEST["sortPrice"] == -1):
	$sort1 = "SHOW_COUNTER";
	$typeSort1 = "desc";
	$sort2 = "sort";
	$typeSort2 = "asc";
elseif ($_REQUEST["sortPopular"] == 1 && $_REQUEST["sortPrice"] == -1):
	$sort1 = "SHOW_COUNTER";
	$typeSort1 = "asc";
	$sort2 = "sort";
	$typeSort2 = "asc";
elseif ($_REQUEST["sortPopular"] == 0 && $_REQUEST["sortPrice"] == 0):
	$sort1 = "SHOW_COUNTER";
	$typeSort1 = "desc";
	$sort2 = "catalog_PRICE_1";
	$typeSort2 = "desc";
elseif ($_REQUEST["sortPopular"] == 1 && $_REQUEST["sortPrice"] == 0):
	$sort1 = "SHOW_COUNTER";
	$typeSort1 = "asc";
	$sort2 = "catalog_PRICE_1";
	$typeSort2 = "desc";
elseif ($_REQUEST["sortPopular"] == 0 && $_REQUEST["sortPrice"] == 1):
	$sort1 = "SHOW_COUNTER";
	$typeSort1 = "desc";
	$sort2 = "catalog_PRICE_1";
	$typeSort2 = "asc";
elseif ($_REQUEST["sortPopular"] == 1 && $_REQUEST["sortPrice"] == 1):
	$sort1 = "SHOW_COUNTER";
	$typeSort1 = "asc";
	$sort2 = "catalog_PRICE_1";
	$typeSort2 = "asc";
endif;

// для каждого раздела свой материал
switch ($_REQUEST["section_code"]) {
    case 'svetilniki':
        $code_prop = "SVET_MATERIAL";
        break;
    case 'mebel':
        $code_prop = "MEBEL_MATERIAL";
        break;
    case 'predmety-interera':
        $code_prop = "INTERIER_MATERIAL";
        break;
    default:
		$code_prop = "";
		break;
}
// основной фильтр
if ($_REQUEST["presence"] == "true"):
	$deposit = 2;
else:
	$deposit = 0;
endif;
if ($_REQUEST["new"]):
	$new = 1;
endif;
if ($_REQUEST["sale"]):
	$sale = 1;
endif;
?>