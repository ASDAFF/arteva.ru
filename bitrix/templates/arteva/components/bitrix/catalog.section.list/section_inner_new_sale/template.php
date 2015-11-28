<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $APPLICATION;
$curpage = $APPLICATION->GetCurPage();
$arLink = explode("/", $curpage);
$link = "/".$arLink[1]."/";
//test_dump($arLink);
?>
<?if ($arLink[1] == "new"):?>
    <h1>Новинки</h1>
<?elseif ($arLink[1] == "sale"):?>
    <h1>Распродажа</h1>
<?endif?>
<?if ($arResult["SECTIONS"]):?>
    <div class="categories-list-cnt tabs-cnt">
        <ul class="tabs-list acenter">
            <li class="<?if ($curpage == $link):?>active<?endif;?>">
                <a class="<?if ($curpage == $link):?>active<?endif;?>" href="<?=$link?>">Все</a>
            </li>
            <?foreach ($arResult["SECTIONS"] as $key => $arSections) :?>
                <li class="<?if ($link.$arSections["CODE"]."/" == $curpage):?>active<?endif;?> <?=$curpage?>">
                    <a class="<?if ($link.$arSections["CODE"]."/" == $curpage):?>active<?endif;?>" href="<?=$link.$arSections["CODE"]?>/"><?=$arSections["NAME"]?></a>
                </li>
            <?endforeach?>
        </ul>
    </div>
<?endif?>