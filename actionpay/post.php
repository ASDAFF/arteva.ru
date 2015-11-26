<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	CModule::IncludeModule("catalog");
	CModule::IncludeModule("sale");
	
$xml = "<?xml version='1.0' encoding='UTF-8'?><items><item>10557</item></items>";

$xml_result = objectToArray( simplexml_load_string($xml) );

PR($_POST, true);
?>

<form method="post" action="">
	<input type="text" name="date" value="">
	<input type="submit" name="sss" value="отправить">
</form>
