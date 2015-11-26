<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Каталог");
$APPLICATION->SetPageProperty("keywords", "Каталог");
$APPLICATION->SetPageProperty("description", "Каталог");
$APPLICATION->SetTitle("Каталог");?>
<?
	LocalRedirect("/catalog/svetilniki/");
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>