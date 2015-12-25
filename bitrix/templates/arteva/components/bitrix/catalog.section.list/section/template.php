<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h1><?=$arResult["SECTION"]["NAME"]?></h1>

<?
$arResult["ID"] = $arResult['SECTION']['ID'];
$arResult["IS_ROOT_SECTION"] = true;

include_once($_SERVER["DOCUMENT_ROOT"]."/include/catalog_filter.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/include/Sections.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/include/process_filter_in_url.php.php");

$sections = $arResult["SECTIONS"];
$filter = UrlFilter::GetFilter($arResult['SECTION']['CODE']);
if ($filter !== false) {
    $arFilter = array($filter['query-name']=>$filter['value']);
    $sections = Sections::RemoveEmptySections($arResult["SECTIONS"], $arFilter);
}
?>


<div class="item-cards-list-cnt categories">
    <?= Sections::GenerateMarkup($sections) ?>
    <div class="preload-overlay"><i></i></div>
</div>
