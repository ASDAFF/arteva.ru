<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$previousLevel = 1;?>
<?foreach ($arResult["SECTIONS"] as $key => $arSections) :?>
    <?if ($previousLevel && $arSections["DEPTH_LEVEL"] < $previousLevel):?>
        <?=str_repeat("</ul>", ($previousLevel - $arSections["DEPTH_LEVEL"]));?>
    <?endif?>
    <?if ($arSections["DEPTH_LEVEL"] == 1):?>
        <ul class="footer-list bottom-left">
            <li class="<?if ($arSections["SELECTED"]): echo 'active ';endif;?>" data-level="<?=$arSections["DEPTH_LEVEL"]?>">
                <a href="<?=$arSections["SECTION_PAGE_URL"]?>" class="<?if ($arSections["SELECTED"]): echo 'active';endif;?>">
                    <?=$arSections["NAME"]?>
                </a>
            </li>
    <?else:?>
        <li class="<?if ($arSections["SELECTED"]): echo 'active ';endif;?>" data-level="<?=$arSections["DEPTH_LEVEL"]?>">
            <a href="<?=$arSections["SECTION_PAGE_URL"]?>" class="<?if ($arSections["SELECTED"]): echo 'active';endif;?>">
                <?=$arSections["NAME"]?>
            </a>
        </li>
    <?endif?>
    <?$previousLevel = $arSections["DEPTH_LEVEL"];?>
<?endforeach?>
<?if ($previousLevel > 1)://close last item tags?>
    <?=str_repeat("</ul>", ($previousLevel-1) );?>
<?endif?>