<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$countSections = count($arResult["SECTIONS"])-1?>
<?foreach ($arResult["SECTIONS"] as $key => $arSections) :?>
    <h2><?=$arSections["NAME"]?></h2>
    <?foreach ($arSections["ITEMS"] as $arItems) :?>
    <h3 id="<?=$arItems["CODE"]?>"><?=$arItems["NAME"]?></h3>
    <?=$arItems["~PREVIEW_TEXT"]?>
    <?endforeach?>
    <?if ($key < $countSections):?>
        <hr/>
    <?endif?>
<?endforeach?>