<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach ($arResult["SECTIONS"] as $key => $arSections) :?>
    <?if ($arSections["DEPTH_LEVEL"] == 1):?>
        <? $counter = 0; ?>
        <li class="has-sublist <?if ($arSections["SELECTED"]): echo 'active';endif;?>">
            <a href="<?=$arSections["SECTION_PAGE_URL"]?>" class="<?if ($arSections["SELECTED"]): echo 'active';endif;?>">
                <?=$arSections["NAME"]?>
            </a>
            <div class="top-nav-sublist-cnt">
                <div class="top-nav-sublist-wrapper">
                    <div class="top-nav-submenu-cnt">
                        <ul class="top-nav-sublist">
                            <?foreach ($arResult["SECTIONS"] as $arSec) :?>
                                <?if ($arSec["DEPTH_LEVEL"] == 2 && $arSections["ID"] == $arSec["IBLOCK_SECTION_ID"]):
                                    $counter = $counter + 1;
                                    ?>
                                    <li class="<?if ($arSec["SELECTED"]): echo 'active';endif;?>">
                                        <a href="<?=$arSec["SECTION_PAGE_URL"]?>" class="<?if ($arSec["SELECTED"]): echo 'active';endif;?>">
                                            <?=$arSec["NAME"]?>
                                        </a>
                                    </li>
                                    <?if ($counter == 7) { echo '</ul><ul class="top-nav-sublist">'; $counter = 0; } ?>
                                <?endif?>
                            <?endforeach?>
                        </ul>
                    </div>
					<? if ($arSections['UF_GOTO_LINK']) {?>
						<div class="top-nav-img-wrapper bg-cover" style="background-image: url('<?=CFIle::GetPath($arSections["~PICTURE"])?>'); cursor: pointer;" onclick="location.href='<?=$arSections['UF_GOTO_LINK']?>'"></div>						
					<?} else {?>
						<div class="top-nav-img-wrapper bg-cover" style="background-image: url('<?=CFIle::GetPath($arSections["~PICTURE"])?>');"></div>
					<?}?>
                </div>
            </div>
        </li>
    <?elseif ($arSections["DEPTH_LEVEL"] == 0):?>
        <li class="<?if ($arSections["SELECTED"]): echo 'active ';endif;if ($arSections["NAME"] == "Sale"): echo 'marked';endif;?>">
            <a href="<?=$arSections["SECTION_PAGE_URL"]?>" class="<?if ($arSections["SELECTED"]): echo 'active';endif;?>">
                <?=$arSections["NAME"]?>
            </a>
        </li>
    <?endif?>
<?endforeach?>