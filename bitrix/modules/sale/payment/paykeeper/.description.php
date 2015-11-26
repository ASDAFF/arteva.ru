<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?><?
include(GetLangFileName(dirname(__FILE__)."/", "/payment.php"));

$psTitle = GetMessage("TMG_PK_TITLE");
$psDescription = GetMessage("TMG_PK_DESC");

$arPSCorrespondence = array(
		"TMG_PK_SERVER_ADDR" => array(
				"NAME" => GetMessage("TMG_PK_SERVER_ADDR"),
				"DESCR" => GetMessage("TMG_PK_SERVER_ADDR_DESCR"),
				"VALUE" => "",
				"TYPE" => ""
			),
                "TMG_PK_SECRET_KEY" => array(
				"NAME" => GetMessage("TMG_PK_SECRET_KEY"),
				"DESCR" => "",
				"VALUE" => "",
				"TYPE" => ""
			)
	);
?>
