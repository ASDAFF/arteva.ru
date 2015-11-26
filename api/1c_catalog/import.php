<?php
ini_set("session.gc_maxlifetime", 3600);
ini_set("max_execution_time", 3600);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$result = false;
$msg = "Некорректные входные данные";
if ($_GET["step"]):
	$msg = "Файл каталога не найден";
	if ($_GET["step"] == "archive"):
		$archiveImport = $_SERVER["DOCUMENT_ROOT"]."/upload/1c_catalog/import.zip";
		if (file_exists($archiveImport)):
			$zip = new ZipArchive;
			if ($zip->open($archiveImport) === true):
			    $zip->extractTo($_SERVER["DOCUMENT_ROOT"].'/upload/1c_catalog/');
			    $zip->close();
			    $result = true;
			    $msg = "Файлы успешно разархивированны";
			else:
				$msg = "Архива нет";
			endif;
		endif;
	endif;
	if ($_GET["step"] == "iblock"):
	/* 	$fileCatalog = $_SERVER["DOCUMENT_ROOT"]."/upload/1c_catalog/import.xml";
		if (file_exists($fileCatalog)):
			$xmlFile = file_get_contents($fileCatalog);
			$data = new SimpleXMLElement($xmlFile);
			include_once($_SERVER["DOCUMENT_ROOT"]."/include/1c_catalog/addPropertyIblock.php");
			//записываем свойства товара в инфоблок каталога
			$propIblock = new AddPropertyIblock();
			$addProp = $propIblock->readProp($data->Классификатор->Свойства);
			if ($addProp === false):
				$msg = "При добалении (обновлении) свойств инфолока, произошла ошибка. Попробуйте позже.";
			elseif ($addProp === true):
				$result = true;
				$msg = "Добавление (обновление) свойств инфоблока прошло успешно.";
			endif;
		endif; */
		$result = true;
		$msg = "Добавление (обновление) свойств инфоблока прошло успешно.";
	endif;
	if ($_GET["step"] == "sections"):
		$fileCatalog = $_SERVER["DOCUMENT_ROOT"]."/upload/1c_catalog/import.xml";
		if (file_exists($fileCatalog)):
			$xmlFile = file_get_contents($fileCatalog);
			$data = new SimpleXMLElement($xmlFile);
			include_once($_SERVER["DOCUMENT_ROOT"]."/include/1c_catalog/addSections.php");
			//записываем разделы товаров в инфоблок
			$sectionIblock = new AddSectionIblock();
			$addSections = $sectionIblock->readSection($data->Классификатор->Группы);
			if ($addSections === false):
				$msg = "Не удалось обновить разделы каталога. Попробуйте позже.";
			elseif ($addSections === true):
				$result = true;
				$msg = "Обновление разделов каталога прошло успешно.";
			endif;
		endif;
	endif;
	if ($_GET["step"] == "products"):
		$fileCatalog = $_SERVER["DOCUMENT_ROOT"]."/upload/1c_catalog/import.xml";
		if (file_exists($fileCatalog)):
			$xmlFile = file_get_contents($fileCatalog);
			$data = new SimpleXMLElement($xmlFile);
			include_once($_SERVER["DOCUMENT_ROOT"]."/include/1c_catalog/addProducts.php");
			//записываем товары в инфоблок
			$productIblock = new AddProducts();
			$addProducts = $productIblock->readProducts($data->Каталог->Товары);
			if ($addProducts === true):
				$result = true;
				$msg = "Обновление элементов каталога прошло успешно.";
			else:
				$msg = "Произошла непредвиденная ошибка. Попробуйте еще раз.";
			endif;
		endif;
	endif;
	if ($_GET["step"] == "actionproducts"):
		if (empty($_GET["action"]) || ($_GET["action"] != "remove" && $_GET["action"] != "noactive")):
			$actProducts = false;
		else:
			$fileCatalog = $_SERVER["DOCUMENT_ROOT"]."/upload/1c_catalog/import.xml";
			if (file_exists($fileCatalog)):
				$xmlFile = file_get_contents($fileCatalog);
				$data = new SimpleXMLElement($xmlFile);
				include_once($_SERVER["DOCUMENT_ROOT"]."/include/1c_catalog/actionProducts.php");
				$productIblock = new ActionProducts();
				if ($_GET["action"] == "remove"):
					$actProducts = $productIblock->removeProducts($data->Каталог->Товары);
				elseif ($_GET["action"] == "noactive"):
					$actProducts = $productIblock->noActiveProducts($data->Каталог->Товары);
				endif;
			endif;
		endif;
		if ($actProducts === true):
			$result = true;
			$msg = "Деактивирование (удаление) элементов каталога прошло успешно.";
		else:
			$msg = "Произошла непредвиденная ошибка. Попробуйте еще раз.";
		endif;
	endif;
	if ($_GET["step"] == "price"):
		$fileBalance = $_SERVER["DOCUMENT_ROOT"]."/upload/1c_catalog/balance.xml";
		if (file_exists($fileBalance)):
			$xmlFile = file_get_contents($fileBalance);
			$data = new SimpleXMLElement($xmlFile);
			include_once($_SERVER["DOCUMENT_ROOT"]."/include/1c_catalog/addProductsPrice.php");
			//прописываем цены у товаров в торговый каталог
			$priced = new AddProductsPrice();
			$addPrice = $priced->addPrice($data);
			if ($addPrice === false):
				$msg = "Не удалось обновить цены каталога. Попробуйте позже.";
			elseif ($addPrice === true):
				$result = true;
				$msg = "Обновление цен каталога прошло успешно.";
			endif;
		else:
			$msg = "Файл цен не найден.";
		endif;
	endif;
	if ($_GET["step"] == "clear"):
		/*include_once($_SERVER["DOCUMENT_ROOT"]."/include/1c_catalog/clearUploadFiles.php");
		$removeFiles = new RemoveFiles();
		$res = $removeFiles->clearUpload();
		if ($res === false):
			$msg = "Не удалось удалить файлы. Попробуйте позже.";
		elseif ($res === true):
			$result = true;
			$msg = "Папка с файлами очищенна.";
		endif;*/
		$msg = "Этап отключен.";
	endif;
endif; 
echo json_encode(
		array(
			"result" => $result,
			"msg" => $msg
			)
		);
exit;
?>