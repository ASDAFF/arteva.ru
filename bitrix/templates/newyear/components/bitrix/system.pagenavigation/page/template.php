<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

?>
<div class="row js-pagination-cnt">
	<ul class="pagination">
		<?if ($arResult["NavPageNomer"] > 1):?>
			<li class="pagination-item">
				<a href="?<?=$strNavQueryString?>"><<</a>
			</li>
			<li class="pagination-item">
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><</a>
			</li>
		<?endif?>

		<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
			<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
		        <li class="pagination-item">
		        	<a class="page-number active"><?=$arResult["nStartPage"]?></a>
		        </li>
			<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
				<li class="pagination-item">
					<a href="?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=$arResult["nStartPage"]?></a>
				</li>
			<?else:?>
				<li class="pagination-item">
					<a href="?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
				</li>
			<?endif?>
			<?$arResult["nStartPage"]++?>
		<?endwhile?>

		<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
			<li class="pagination-item item-forward">
				<a href="?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageNomer"]+1?>">></a>
			</li>
			<li class="pagination-item item-last">
				<a href="?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>">>></a>
			</li>
		<?endif?>
	</ul>
</div>