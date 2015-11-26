<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'):
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	/**
	 * $_POST["project"] id projects
	 */
	if ($_POST["project"]):
		$result = removeProjects($_POST["project"]);
	endif;
	if ($result):
		echo json_encode(array("result" => true));
	else:
		echo json_encode(array("result" => false));
	endif;
endif;
?>