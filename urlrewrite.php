<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/sale/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/catalog/sale/index.php",
	),
	array(
		"CONDITION" => "#^/new/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/catalog/new/index.php",
	),
	array(
		"CONDITION" => "#^/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/index.php",
		"SORT" => "100",
	),
);

?>