<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
echo $PROCESS_IMPORT;
if (!$USER->isAuthorized() && !in_array(1, $USER->GetUserGroupArray())):
	LocalRedirect("/bitrix/");
	exit;
else:
	if (!CModule::IncludeModule("iblock")):
	    return false;
	endif;
	$IBLOCK_ID = 23;
	$ID_RESULT = $_GET["ID"];
	$TYPE = $_GET["type"];
	$STATUS = $_GET["status"];
	$arSelect = Array();
	$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE"=>"Y", "ID" => $ID_RESULT, "PROPERTY_TYPE" => $TYPE, "PROPERTY_STATUS" => $STATUS);
	$res = CIBlockElement::GetList(Array("PROPERTY_TIME" => "DESC"), $arFilter, false, $page, $arSelect);
	while($ob = $res->GetNextElement())
	{
	 	$arItem = $ob->GetFields();
	 	$arItem["PROPERTIES"] =$ob->GetProperties();
		$arProcess[] = $arItem;
	}
	if ($arProcess):
		$xml .= "<?xml version='1.0' encoding='UTF-8'?>";
		$xml .= "<import>";
			$xml .= "<fields>";
				$xml .= "<id>id</id>";
				$xml .= "<time>time</time>";
				$xml .= "<action>action</action>";
				$xml .= "<status>status</status>";
				$xml .= "<off_time>off_time</off_time>";
				$xml .= "<message>message</message>";
				$xml .= "<type>type</type>";
			$xml .= "</fields>";
			$xml .= '<records>';
		foreach ($arProcess as $key => $process) :
			$xml .= "<row>";
			$xml .= "<id>".$process["ID"]."</id>";
			$xml .= "<time>".$process["PROPERTIES"]["TIME"]["VALUE"]."</time>";
			$xml .= "<action>".$process["PROPERTIES"]["ACTION"]["VALUE"]."</action>";
			$xml .= "<status>".$process["PROPERTIES"]["STATUS"]["VALUE"]."</status>";
			$xml .= "<off_time>".$process["PROPERTIES"]["OFF_TIME"]["VALUE"]."</off_time>";
			$xml .= "<message>".$process["PROPERTIES"]["MESSAGE"]["VALUE"]."</message>";
			$xml .= "<type>".$process["PROPERTIES"]["TYPE"]["VALUE"]."</type>";
			$xml .= "</row>";
		endforeach;
			$xml .= "</records>";
		$xml .= "</import>";
		header('Content-type: text/xml');
		echo $xml;
	else:
		echo false;
	endif;
endif;
?>