<?php
ini_set("max_execution_time", 3600);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (!CModule::IncludeModule("iblock")):
	return false;
endif;
$IBLOCK_ID = 23; // инфоблок с процессами
// находим исполняемый процесс
$arSelect = Array("ID");
$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE"=>"Y", "PROPERTY_STATUS" => "processed");
$res = CIBlockElement::GetList(Array("PROPERTY_TIME" => "ASC"), $arFilter, false, array("nPageCount" => 1), $arSelect);
if($ob = $res->GetNextElement())
{
 	die(); // если какой либо процесс исполняется то выходим из скрипта
}

// находим первый(по времени) запрос со статусом ожидание(wait)
$arSelect = Array("ID", "NAME", "PROPERTY_STATUS", "PROPERTY_TIME", "PROPERTY_ACTION", "PROPERTY_TYPE", "PROPERTY_PARAMS");
$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE"=>"Y", "PROPERTY_STATUS" => "wait");
$res = CIBlockElement::GetList(Array("PROPERTY_TIME" => "ASC"), $arFilter, false, array("nPageCount" => 1), $arSelect);
if($ob = $res->GetNextElement())
{
 	$arProcess = $ob->GetFields();
}
if ($arProcess):
	// запускаем процесс и переводим его в статус исполняется(processed)
	include_once($_SERVER["DOCUMENT_ROOT"]."/include/1c_catalog/addProcess.php");
	if (updateResult($arProcess["ID"], $arProcess["PROPERTY_TYPE_VALUE"], "processed")):
		$msg = "Файл каталога не найден"
		$status = "fail";
		$arParams = json_decode($arProcess["~PROPERTY_PARAMS_VALUE"]);
		if ($arProcess["PROPERTY_TYPE_VALUE"] == "archive"):
			$archiveImport = $_SERVER["DOCUMENT_ROOT"]."/upload/1c_catalog/import.zip";
			if (file_exists($archiveImport)):
				$zip = new ZipArchive;
				if ($zip->open($archiveImport) === true):
				    $zip->extractTo($_SERVER["DOCUMENT_ROOT"].'/upload/1c_catalog/');
				    $zip->close();
				    $msg = "Файлы успешно разархивированны";
				    $status = "success";
				else:
					$msg = "Архива нет";
					$status = "fail";
				endif;
			endif;
		elseif ($arProcess["PROPERTY_TYPE_VALUE"] == "iblock"):
			$fileCatalog = $_SERVER["DOCUMENT_ROOT"]."/upload/1c_catalog/import.xml";
			if (file_exists($fileCatalog)):
				$xmlFile = file_get_contents($fileCatalog);
				$data = new SimpleXMLElement($xmlFile);
				include_once($_SERVER["DOCUMENT_ROOT"]."/include/1c_catalog/addPropertyIblock.php");
				//записываем свойства товара в инфоблок каталога
				$propIblock = new AddPropertyIblock();
				$addProp = $propIblock->readProp($data->Классификатор->Свойства);
				if ($addProp === false):
					$msg = "При добалении (обновлении) свойств инфолока, произошла ошибка. Попробуйте позже.";
					$status = "fail";
				elseif ($addProp === true):
					$msg = "Добавление (обновление) свойств инфоблока прошло успешно.";
					$status = "success";
				endif;
			endif;
		elseif ($arProcess["PROPERTY_TYPE_VALUE"] == "sections"):
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
					$status = "fail";
				elseif ($addSections === true):
					$msg = "Обновление разделов каталога прошло успешно.";
					$status = "success";
				endif;
			endif;
		elseif ($arProcess["PROPERTY_TYPE_VALUE"] == "products"):
			$fileCatalog = $_SERVER["DOCUMENT_ROOT"]."/upload/1c_catalog/import.xml";
			if (file_exists($fileCatalog)):
				$xmlFile = file_get_contents($fileCatalog);
				$data = new SimpleXMLElement($xmlFile);
				include_once($_SERVER["DOCUMENT_ROOT"]."/include/1c_catalog/addProducts.php");
				//записываем товары в инфоблок
				$productIblock = new AddProducts();
				$addProducts = $productIblock->readProducts($data->Каталог->Товары);
				if ($addProducts === true):
					$msg = "Обновление элементов каталога прошло успешно.";
					$status = "success";
				else:
					$msg = "Произошла непредвиденная ошибка. Попробуйте еще раз.";
					$status = "fail";
				endif;
			endif;
		elseif ($arProcess["PROPERTY_TYPE_VALUE"] == "actionproducts"):
			if (empty($_GET["action"]) || ($_GET["action"] != "remove" && $_GET["action"] != "noactive")):
				$actProducts = null;
			else:
				$fileCatalog = $_SERVER["DOCUMENT_ROOT"]."/upload/1c_catalog/import.xml";
				if (file_exists($fileCatalog)):
					$xmlFile = file_get_contents($fileCatalog);
					$data = new SimpleXMLElement($xmlFile);
					include_once($_SERVER["DOCUMENT_ROOT"]."/include/1c_catalog/actionProducts.php");
					$productIblock = new ActionProducts();
					if ($arParams->action == "remove"):
						$actProducts = $productIblock->removeProducts($data->Каталог->Товары);
					elseif ($arParams->action == "noactive"):
						$actProducts = $productIblock->noActiveProducts($data->Каталог->Товары);
					endif;
				endif;
			endif;
			if ($actProducts === true):
				$msg = "Деактивирование (удаление) элементов каталога прошло успешно.";
				updateResult($ID_RESULT, $arProcess["PROPERTY_TYPE_VALUE"], "success", $msg);
			elseif ($actProducts === false):
				$msg = "Произошла непредвиденная ошибка. Попробуйте еще раз.";
				$status = "fail";
			else:
				$msg = "Действия над товарами не проходили";
				$status = "success";
			endif;
		elseif ($arProcess["PROPERTY_TYPE_VALUE"] == "price"):
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
					$status = "fail";
				elseif ($addPrice === true):
					$msg = "Обновление цен каталога прошло успешно.";
					$status = "success";
				endif;
			else:
				$msg = "Файл цен не найден.";
				$status = "fail";
			endif;
		endif;
		updateResult($arProcess["ID"], $arProcess["PROPERTY_TYPE_VALUE"], $status, $msg);
	endif;
endif;
?>