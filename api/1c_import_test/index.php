<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
if (!$USER->isAuthorized() && !in_array(1, $USER->GetUserGroupArray())):
	LocalRedirect("/bitrix/");
	exit;
else:
	$arSteps = array(
		"archive", 
		"iblock", 
		"sections", 
		"products", 
		"actionproducts", 
		"price", 
		//"clear"
		);
	if ($_REQUEST["STEP"] && in_array($_REQUEST["STEP"], $arSteps)):
		include_once($_SERVER["DOCUMENT_ROOT"]."/include/1c_catalog/addProcess.php");
		$params = "";
		if ($_GET) $params = json_encode($_GET);
		$ID_RESULT = addResult($_REQUEST["STEP"], $params);
		echo $ID_RESULT;
	endif;
endif;
?>