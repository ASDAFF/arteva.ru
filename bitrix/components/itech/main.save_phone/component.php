<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global CDatabase $DB
 * @global CUserTypeManager $USER_FIELD_MANAGER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponent $this
 */

if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)
	die();

global $USER_FIELD_MANAGER;

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST['REGISTER']['PERSONAL_PHONE'])
{
	$user_cmp = new CUser;
	$fields = Array( 
		"PERSONAL_PHONE" => $_REQUEST['REGISTER']['PERSONAL_PHONE'] 
	); 
	$user_cmp->Update($USER->GetID(),$fields);
	LocalRedirect($arParams['SUCCESS_PAGE']);
}else{
	$this->IncludeComponentTemplate();
}
