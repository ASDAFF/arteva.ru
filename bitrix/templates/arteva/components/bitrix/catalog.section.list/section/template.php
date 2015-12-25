<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h1><?=$arResult["SECTION"]["NAME"]?></h1>

<?
$arResult["ID"] = $arResult['SECTION']['ID'];
$arResult["IS_ROOT_SECTION"] = true;

include($_SERVER["DOCUMENT_ROOT"]."/include/catalog_filter.php");
include($_SERVER["DOCUMENT_ROOT"]."/include/Sections.php");
?>


<div class="item-cards-list-cnt categories">
    <?= Sections::GenerateMarkup($arResult["SECTIONS"]) ?>
    <div class="preload-overlay"><i></i></div>
</div>
