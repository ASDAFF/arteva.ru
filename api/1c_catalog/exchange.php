<?php
ini_set("session.gc_maxlifetime", 3600);
ini_set("max_execution_time", 3600);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
if (!$USER->isAuthorized() && !in_array(1, $USER->GetUserGroupArray())):
	LocalRedirect("/bitrix/");
	exit;
else:
	$file = $_SERVER["DOCUMENT_ROOT"].'/api/1c_catalog/log.txt';
	$current = file_get_contents($file);
	if ($_REQUEST):
		$current .= serialize($_REQUEST);
	else:
		$current .= "empty query";
	endif;
	$current .= "\n";
	$current .= "-------------------- ".date("d.m.Y H:i:s")." -------------------------";
	$current .= "\n";
	// Пишем содержимое обратно в файл
	file_put_contents($file, $current);

	/*include_once($_SERVER["DOCUMENT_ROOT"]."/include/1c_exchange/getProductsXML.php");
	$getxml = new ProductsXML();
	$xml = $getxml->getXML();
	header('Content-type: text/xml');
	echo $xml;*/
	$arResult = array("ERROR" => "Не верный запрос");
	// обновление статусов заказа
	if ($_REQUEST["update"]):
		if ($_REQUEST["orders"] && CModule::IncludeModule("catalog") && CModule::IncludeModule("sale")):
			$arResult = "";
			$arOrders = $_REQUEST["orders"];
			foreach ($arOrders as $key => $order) :
				if (!CSaleOrder::StatusOrder($order["ID"], $order["STATUS"])):
					$result = true;
				else:
					$result = false;
				endif;
				$arResult[] = array(
					"ID" => $order["ID"],
					"RESULT" => $result
					);
			endforeach;
		endif;
	// все типы статусов
	elseif($_REQUEST["getstatus"] && CModule::IncludeModule("catalog") && CModule::IncludeModule("sale")):
		$arResult = "";
		$arStatus = array();
		$rsStatus = CSaleStatus::GetList(array("ID"=>"ASC"), array("LID" => "ru"));
		while($arStatus_tmp = $rsStatus->Fetch()){
			$arResult[] = array(
				"ID" => $arStatus_tmp["ID"],
				"NAME" => $arStatus_tmp["NAME"],
				"DESCRIPTION" => $arStatus_tmp["DESCRIPTION"]
				);
		}
	endif;
	echo json_encode($arResult);
	exit;
endif;
?>