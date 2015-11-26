<?
// require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('catalog');  
CModule::IncludeModule('sale');  
// CModule::IncludeModule("iblock");
// PR($_COOKIE);
// PR($_COOKIE["actionpay"]);

// file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/z/___log.php", "asd");

// PR($_COOKIE["bigbuzzy"]);


// Выборка товаров со скидками
$arFilter = array(
	"DISCOUNT_ID" => array(10, 11, 12, 13, 16, 18, 25, 27, 28, 29, 30, 33, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55)
	// "DISCOUNT_ID" => array(10, 11, 12, 13, 16, 18, 25, 27, 28, 29, 30, 33)
);
$res = CCatalogDiscount::GetDiscountProductsList(
	array(),
	$arFilter,
	false,
	false,
	array()
);
$str = "<?php \narray(\n";
while($item = $res->GetNext()){
	PR($item);
	$str .= "'" . $item["PRODUCT_ID"] . "',\n";
}
$str .= ");";
file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/include/discount_ids2.php", $str);


$arLogic = array(
		"CLASS_ID" => "CondGroup",
		"DATA" => array(
			"All" => "OR",
			"True" => "True",
		),
		"CHILDREN" => array(
			array(
				"CLASS_ID" => "CondIBElement",
				"DATA" => array(
					"logic" => "Equal",
					"value" => 29770,
					)
			),
			array(
				"CLASS_ID" => "CondIBElement",
				"DATA" => array(
					"logic" => "Equal",
					"value" => 29771,
				)
			)
		)
	);
		
$arFields = array(
	"SITE_ID" => "s1",
	"NAME" => "Тестовая скидка 111",
	"CURRENCY" => "RUB",
	"PRIORITY" => 1,
	"VALUE_TYPE" => "P",
	"VALUE" => "33",
	"NOTES" => "33",
	// "CONDITIONS" => serialize($arLogic),
);

// $ID = CCatalogDiscount::Add($arFields);
// $res = $ID>0;
// PR($ID);

// $arFields2 = array(
	// "CONDITIONS" => serialize($arLogic),
// );
// CCatalogDiscount::Update(44, $arFields2);


// $dbProductDiscounts = CCatalogDiscount::GetList(array(), array("NOTES" => "11"), false, false, array())->Fetch();
// PR($dbProductDiscounts);

// PR(unserialize($dbProductDiscounts["CONDITIONS"]));

// file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/api/discount/" . rand(), rand() );

?>
