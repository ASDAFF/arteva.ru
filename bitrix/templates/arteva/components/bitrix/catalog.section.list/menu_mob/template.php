<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach ($arResult["SECTIONS"] as $key => $arSections) :?>
    <li>
        <a href="<?=$arSections["SECTION_PAGE_URL"]?>">
            <?=$arSections["NAME"]?>
        </a>
    </li>
<?endforeach?>
<li>
    <a href="/catalog/new/">
        Новинки
    </a>
</li>
<li class="marked">
    <a href="/catalog/sale/">
        Sale
    </a>
</li>