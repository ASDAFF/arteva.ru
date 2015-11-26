<?php 

$discount_ids = include($_SERVER["DOCUMENT_ROOT"] . "/catalog/blackfriday/include/discount_ids.php");
$GLOBALS["arrFilterSectionSale"] = array(
	// ">=catalog_PRICE_1" => $_REQUEST["priceMin"],
	// "<=catalog_PRICE_1" => $_REQUEST["priceMax"],
	// "ID" => $discount_ids,
	// "PROPERTY_discount_id" => array("4", "11", "10", "8"),
	// ">=catalog_QUANTITY" => 1,
	// "!PROPERTY_SALE" => 1
	array(
        "LOGIC" => "OR",
		"ID" => $discount_ids,
		"PROPERTY_discount_id" => array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11"),
    ),
);


	// $ELEMENT_SORT_FIELD = "PROPERTY_SALE";
	$ELEMENT_SORT_FIELD = "ID";
	$ELEMENT_SORT_ORDER = "desc";
	// $SECTION_ID = "";
	$SECTION_ID = "664";
	
	if(isset($_GET["price_sort"])){
		$ELEMENT_SORT_FIELD = "catalog_PRICE_1";
		$ELEMENT_SORT_ORDER = "desc";
	}
	if(isset($_GET["price_sort2"])){
		$ELEMENT_SORT_FIELD = "catalog_PRICE_1";
		$ELEMENT_SORT_ORDER = "asc";
	}
	$PAGE_ELEMENT_COUNT = "24";
	if(isset($_GET["showall"]) && $_GET["showall"] == "Y"){
		$PAGE_ELEMENT_COUNT = "10000";
	}

	if(isset($_GET["SECTION"]) && is_numeric($_GET["SECTION"])){
		$SECTION_ID = $_GET["SECTION"];
	}
	if(isset($_GET["SUB_SECTION"]) && is_numeric($_GET["SUB_SECTION"])){
		$SECTION_ID = $_GET["SUB_SECTION"];
	}
	echo $success_mess;



