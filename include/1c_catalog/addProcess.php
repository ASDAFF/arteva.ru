<?php
function getActionStr($STEP){
	switch ($STEP) {
		case 'archive':
			$actionStr = "Разархивирвоание каталога";
			break;
		case 'iblock':
			$actionStr = "Добавление (обновление) свойств инфоблока";
			break;
		case 'sections':
			$actionStr = "Добавлениие (обновление) разделов";
			break;
		case 'products':
			$actionStr = "Добавлениие (обновление) товаров";
			break;
		case 'actionproducts':
			$actionStr = "Действие с элементами (удаление, деактивация)";
			break;
		case 'price':
			$actionStr = "Обновление цен и остатков";
			break;
		case 'clear':
			$actionStr = "Очистка папки с картинками";
			break;
	}
	return $actionStr;
}
function addResult($STEP, $PARAMS){
	if (!CModule::IncludeModule("iblock")):
		return false;
	endif;
	global $USER;
	$actionStr = getActionStr($STEP);
	$el = new CIBlockElement;
	$PROP = array();
	$PROP = array(
		"TIME" => mktime(),
		"ACTION" => $actionStr,
		"STATUS" => "wait",
		"TYPE" => $STEP,
		"PARAMS" => $PARAMS,
		"MESSAGE" => "Ожидает"
		);
	$arLoadProductArray = Array(
	  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
	  "IBLOCK_ID"      => 23,
	  "PROPERTY_VALUES"=> $PROP,
	  "NAME"           => $actionStr,
	  "ACTIVE"         => "Y",// активен
	  );
	if($ID = $el->Add($arLoadProductArray)):
		return $ID;
	endif;
}
function updateResult($ID_RESULT, $STEP, $RES, $MSG){
	if (!CModule::IncludeModule("iblock")):
		return false;
	endif;
	global $USER;
	$actionStr = getActionStr($STEP);
	if ($RES == "success"):
		$STATUS = "success";
		$MESSAGE = "Успешно";
	elseif ($RES == "fail"):
		$STATUS = "fail";
		$MESSAGE = "Ошибка";
	else:
		$STATUS = "processed";
		$MESSAGE = "Исполняется";
	endif;
	if ($MSG):
		$MESSAGE = $MSG;
	endif;
	$PROP = array();
	$PROP = array(
		"ACTION" => $actionStr,
		"STATUS" => $STATUS,
		"MESSAGE" => $MESSAGE,
		"OFF_TIME" => mktime(),
		"TYPE" => $STEP
		);
	foreach ($PROP as $code => $value) :
		CIBlockElement::SetPropertyValues($ID_RESULT, 23, $value, $code);
	endforeach;
	return $ID_RESULT;
}
?>