<?php
ini_set("session.gc_maxlifetime", 3600);
ini_set("max_execution_time", 3600);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$result = 4;	
$status_str="";
$ORDER_ID = (int) $_GET["id"];
if (!($arOrder = CSaleOrder::CancelOrder($ORDER_ID,"Y", "Не может быть поставки")))
{
	$result="Ошибка отмены заказа ".$ORDER_ID;
}
else
{
	$result="Отменен";
}
echo $result;
exit;
?>