<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказов");?>
<?php
	if (CModule::IncludeModule("sale") and isset($_GET['ORDER_ID'])) foreach(GetModuleEvents("sale", "OnBasketOrder", true) as $arEvent) {
	if ($arEvent['TO_MODULE_ID'] == 'platina.conveadtracker') ExecuteModuleEventEx($arEvent, array($_GET['ORDER_ID'])); }
?>
<?
	$rsUser = CUser::GetByID($USER->GetID());
	$arUser = $rsUser->Fetch();

	if ($_REQUEST["ORDER_ID"]):
		$ORDER_ID = htmlspecialchars($_REQUEST["ORDER_ID"]);
		include($_SERVER["DOCUMENT_ROOT"]."/personal/order/make/confirm.php");
	elseif (!getBasketOrder()):
		LocalRedirect('/personal/cart/');
    elseif ($_POST["step"] == "" && !$USER->isAuthorized() || $USER->isAuthorized() && empty($arUser['PERSONAL_PHONE'])):
        include($_SERVER["DOCUMENT_ROOT"]."/personal/order/make/step1.php");
    elseif (strlen($_POST["ORDER_CONFIRM_BUTTON"]) > 0 && $USER->isAuthorized()):
    	$ORDER_ID = addOrder($_POST);
    	if ($ORDER_ID > 0):
    		LocalRedirect('/personal/order/make/?ORDER_ID='.$ORDER_ID);
        else:
            LocalRedirect('/personal/order/make/');
    	endif;
    elseif ($_POST["step"] == 3 && $USER->isAuthorized()):
        include($_SERVER["DOCUMENT_ROOT"]."/personal/order/make/step3.php");
    elseif ($_POST["step"] == 2 || $USER->isAuthorized()):
        include($_SERVER["DOCUMENT_ROOT"]."/personal/order/make/step2.php");
    endif;
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
