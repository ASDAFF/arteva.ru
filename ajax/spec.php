<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'):
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	/**
	 * $_POST["user"] id
	 * $_POST["product"] id
	 * $_POST["spec"] id or new Name specification
	 * $_POST["action"] add or update or remove or get specification
	 * $_POST["count"] count products
	 */
	if (htmlspecialchars($_POST["action"]) == "add"): // добавляем спецификацию
		$result = addSpecifications($_POST);
	elseif (htmlspecialchars($_POST["action"]) == "update"): // обновляем спецификацию
		$result = updateSpecifications($_POST);
	elseif (htmlspecialchars($_POST["action"]) == "remove"): // если remove тогда либо пустой product либо пустой spec
		if (htmlspecialchars($_POST["spec"])): // если удаляем спецификацию
			$result = removeSpecification($_POST);
		elseif (htmlspecialchars($_POST["product"])): // если удаляем проудкт из спецификации
			$result = removeItemSpecification($_POST);
		endif;
	elseif (htmlspecialchars($_POST["action"]) == "get"): // получаем спецификации по юзеру
		$result = getSpecificationsName(htmlspecialchars($_POST["user"]));
		echo getPopupSpecifications($result);
		exit;
	elseif (htmlspecialchars($_POST["action"]) == "file"):
		$idSpec = htmlspecialchars($_POST["spec"]);
        $pathFile = getPdfFile($idSpec); // формируем файл
        if ($pathFile):
        	echo json_encode(
        		array(
        			"result" => true,
        			"path" => $pathFile
        			)
        		);
        	exit();
        endif;
	endif;
	if ($result):
		echo json_encode(array("result" => true));
	else:
		echo json_encode(array("result" => false));
	endif;
endif;
?>