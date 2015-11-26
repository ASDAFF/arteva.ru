<?php
ini_set("session.gc_maxlifetime", 3600);
ini_set("max_execution_time", 3600);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$result = 4;	
$status_str="";
$ORDER_ID = (int) $_GET["id"];
if (!($arOrder = CSaleOrder::GetByID($ORDER_ID)))
{
	$result="Заказ с кодом ".$ORDER_ID." не найден";
}
else
{
	$result=$arOrder["STATUS_ID"];
	if ($arStatus = CSaleStatus::GetByID($result))
	{
		$status_str = $arStatus["NAME"];
   	}
}
echo json_encode(
	array(
		"result" => "asasas",
		"msg" => $result,
		"msga" => $status_str 
		)
	);
exit;
?>