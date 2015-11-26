<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/catalog/sale/([a-zA-Z_0-9-]+)/(.*?)\$#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/catalog/sale/section.php",
	),
	array(
		"CONDITION" => "#^/catalog/new/([a-zA-Z_0-9-]+)/(.*?)\$#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/catalog/new/section.php",
	),
	array(
		"CONDITION" => "#^/catalog/([a-zA-Z_0-9-]+)/([a-zA-Z_0-9-]+)/([a-zA-Z_0-9-]+)/([a-zA-Z_0-9-]+)/(.*?)\$#",
		"RULE" => "SECTION_CODE=\$1&SUB_SECTION_CODE=\$2&CODE=\$3&ELEMENT_CODE=\$4",
		"ID" => "",
		"PATH" => "/catalog/detail.php",
	),
	array(
		"CONDITION" => "#^/catalog/([a-zA-Z_0-9-]+)/([a-zA-Z_0-9-]+)/([a-zA-Z_0-9-]+)/(.*?)\$#",
		"RULE" => "SECTION_CODE=\$1&SUB_SECTION_CODE=\$2&CODE=\$3",
		"ID" => "",
		"PATH" => "/catalog/detail.php",
	),
	array(
		"CONDITION" => "#^/catalog/([a-zA-Z_0-9-]+)/([a-zA-Z_0-9-]+)/(.*?)\$#",
		"RULE" => "SECTION_CODE=\$1&SUB_SECTION_CODE=\$2",
		"ID" => "",
		"PATH" => "/catalog/sub_section.php",
	),
	array(
		"CONDITION" => "#^/catalog/([a-zA-Z_0-9-]+)/(.*?)\$#",
		"RULE" => "SECTION_CODE=\$1",
		"ID" => "",
		"PATH" => "/catalog/section.php",
	),
	array(
		"CONDITION" => "#^/projects/([a-zA-Z_0-9-]+)/designer/#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/projects/designer/index.php",
	),
	array(
		"CONDITION" => "#^/projects/([a-zA-Z_0-9-]+)/detail/#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/projects/detail/index.php",
	),
	array(
		"CONDITION" => "#^/salons/([a-zA-Z_0-9-]+)/(.*?)\$#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/salons/detail.php",
	),
	/*array(
		"CONDITION" => "#^/1c_import/([a-zA-Z_0-9-]+)/([0-9-]+)/(.*?)\$#",
		"RULE" => "STEP=\$1&PAGE=\$2",
		"ID" => "",
		"PATH" => "/1c_import/index.php",
	),*/
	array(
		"CONDITION" => "#^/1c_import/([a-zA-Z_0-9-]+)/(.*?)\$#",
		"RULE" => "STEP=\$1",
		"ID" => "",
		"PATH" => "/1c_import/index.php",
	),
	array(
		"CONDITION" => "#^/news/([a-zA-Z_0-9-]+)/(.*?)\$#",
		"RULE" => "ELEMENT_CODE=\$1",
		"ID" => "",
		"PATH" => "/news/detail.php",
	),
);

?>