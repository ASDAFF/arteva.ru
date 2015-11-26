<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<ul class="sb-menu">
    <?foreach ($arResult as $key => $arItems) :?>
        <li class="sb-menu-item<?if ($arItems["SELECTED"]):?> active<?endif?>">
            <a class="<?if ($arItems["SELECTED"]):?>active<?endif?>" href="<?=$arItems["LINK"]?>">
                <?=$arItems["TEXT"]?>
            </a>
        </li>
    <?endforeach?>
</ul>