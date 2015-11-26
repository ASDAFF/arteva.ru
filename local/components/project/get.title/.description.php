<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc as Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = array(
	"NAME" => 'Заголовки',
	"DESCRIPTION" => 'Заголовки',
	"ICON" => '/images/icon.gif',
	"SORT" => 20,
	"PATH" => array(
		"ID" => 'project',
		"NAME" => 'Дополнительне компоненты',
		"SORT" => 10,
	),
);

?>