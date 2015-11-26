<?php
ini_set("session.gc_maxlifetime", 3600);
ini_set("max_execution_time", 3600);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$db_result = CSaleOrder::GetList(array("SORT" => "ASC"),array(),false,false,array());
$a = 0;
while($result = $db_result->Fetch())
{
	echo var_dump($result);
	$a = $a + 1;
	if ($a>10)
	{break;}
	
}
exit;
?>