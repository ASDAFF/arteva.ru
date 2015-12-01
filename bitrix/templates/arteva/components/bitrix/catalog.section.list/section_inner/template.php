<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
test_dump($arResult);
global $APPLICATION;
$curpage = $APPLICATION->GetCurPage();
?>
<?if($GLOBALS['CAT_TITLE']){?>
	<h1><?=$GLOBALS['CAT_TITLE']?></h1>
<?}else{?>
	<h1><?=$arResult["SECTION"]["NAME"]?></h1>
<?}?>

<?if ($arResult["SECTIONS"]):?>
    <div class="categories-list-cnt tabs-cnt">
        <ul class="tabs-list acenter">
            <li class="<?if ($arResult["SECTION"]["SECTION_PAGE_URL"] == $curpage):?>active<?endif;?>">
                <a class="<?if ($arResult["SECTION"]["SECTION_PAGE_URL"] == $curpage):?>active<?endif;?>" href="<?=$arResult["SECTION"]["SECTION_PAGE_URL"]?>">Все</a>
            </li>
            <?foreach ($arResult["SECTIONS"] as $key => $arSections) :?>
                <li class="<?if ($arSections["SECTION_PAGE_URL"] == $curpage):?>active<?endif;?>">
                    <a class="<?if ($arSections["SECTION_PAGE_URL"] == $curpage):?>active<?endif;?>" href="<?=$arSections["SECTION_PAGE_URL"]?>"><?=$arSections["NAME"]?></a>
                </li>
            <?endforeach?>
        </ul>
    </div>
<?endif?>