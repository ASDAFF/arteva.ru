<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h1><?=$arResult["NAME"]?></h1>
<div class="project-content">
    <aside>
        <div id="project-slider">
            <?foreach ($arResult["PROPERTIES"]["IMAGES"]["VALUE"] as $key => $imgId) :?>
                <?$image = CFile::ResizeImageGet($imgId, array('width'=>540, 'height'=>320), BX_RESIZE_IMAGE_EXACT , true);?>
                <a class="project-image js-fbx-image" href="<?=CFile::GetPath($imgId)?>">
                    <img src="<?=$image['src']?>" alt=""/>
                </a>
            <?endforeach?>
            <?
                // для слайдера больших фоток
                // $arResult["PROPERTIES"]["IMAGES_BIG"]["VALUE"]
            ?>
        </div>
    </aside>
    <div class="project-description">
        <div class="designer-project-about">
            <div class="about">
                <p class="news-date">
                    <?=CIBlockFormatProperties::DateFormat("H:i", MakeTimeStamp($arResult["ACTIVE_FROM"], FORMAT_DATETIME));?>, 
                    <?=CIBlockFormatProperties::DateFormat("d F Y", MakeTimeStamp($arResult["ACTIVE_FROM"], FORMAT_DATETIME));?>
                </p>
				<?=$arResult["PROPERTIES"]["INTRO"]["~VALUE"]["TEXT"]?>
				<div style="margin-left:0px; clear:both; padding-top:30px;">
					<?=$arResult["~DETAIL_TEXT"]?>
				</div>
            </div>
        </div>
    </div>
</div>
<?
    $messNext = "Следующая новость";
    $messPrev = "Предыдущая новость";
    $messList = "Список новостей";
?>
<div class="news-inner-navigation">

<?if(count($arResult["LINKS"])>1):?>
    <?if($arResult["LINKS"][1]["ID"]==$arResult['ID']):?>
        <div class="fleft">
            <a href="<?=$arResult["LINKS"][0]["DETAIL_PAGE_URL"]?>"><?=$messPrev?></a>
        </div>
        <?if(is_array($arResult["LINKS"][2])):?>
            <div class="fright">
                <a href="<?=$arResult["LINKS"][2]["DETAIL_PAGE_URL"]?>"><?=$messNext?></a>
            </div>
        <?endif;
    else:?>
        <div class="fright">
            <a href="<?=$arResult["LINKS"][1]["DETAIL_PAGE_URL"]?>"><?=$messNext?></a>
        </div>
    <?endif?>
<?endif?>
<div class="centered">
    <a href="/news/"><?=$messList?></a>
</div>
</div>
