<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult["PRODUCT_PROJECTS"]):?>
    <div class="outer-content-wrapper item-designers">
        <div class="content-wrapper">
            <p class="section-header">Товар в проектах дизайнеров</p>
            <ul class="item-designers-projects-list">
                <?foreach ($arResult["PRODUCT_PROJECTS"] as $key => $arProjects) :?>
                    <li>
                        <a href="<?=$arProjects["DETAIL_PAGE_URL"]?>">
                            <img src="<?=CFile::GetPath($arProjects["~PREVIEW_PICTURE"])?>" alt=""/>
                            <span><?=$arProjects["NAME"]?></span>
                        </a>
                    </li>
                <?endforeach?>
            </ul>
        </div>
    </div>
<?endif?>