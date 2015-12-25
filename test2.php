<?
// require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/include/Sections.php");

//$secs = Sections::GetNonEmpty2(Array("IBLOCK_ID"=>17,"SECTION_ID"=>687));



CModule::IncludeModule('iblock');

$arSelect = Array("IBLOCK_SECTION_ID","NAME","ID");
$arFilter = Array("IBLOCK_ID"=>17,"SECTION_ID"=>687,"INCLUDE_SUBSECTIONS"=>"Y");


$items = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
$sections = Array();

while ($arSection = $items->GetNext())
{
	$sections[]=$arSection;//["IBLOCK_SECTION_ID"];
}

AddMessage2Log($sections);

$arSelect = Array("IBLOCK_ID", "NAME", "SECTION_PAGE_URL", "PICTURE");
$arFilter = Array("IBLOCK_ID" => 17, "SECTION_ID"=>687,"ID" => $sections);

$items = CIBlockSection::GetList(array("SORT" => "asc"), $arFilter, false, $arSelect);
$sections = Array();
while ($arSection = $items->GetNext()) {
	$sections[]=$arSection;
}


?>
<pre>
	<? print_r($sections); ?>
</pre>