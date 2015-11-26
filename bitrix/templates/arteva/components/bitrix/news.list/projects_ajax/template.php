<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach ($arResult["ITEMS"] as $key => $arItems) :?>
    <li class="designer-project-item">
        <a href="<?=$arItems["~DETAIL_PAGE_URL"]?>">
            <img src="<?=CFile::GetPath($arItems["~PREVIEW_PICTURE"])?>" alt="<?=$arItems["NAME"]?>"/>
            <div class="caption">
                <p class="heading">
                	<?=$arItems["NAME"]?>
                </p>
                <div class="designer">
                	Дизайнер 
                	<p>
                		<?=$arItems["DISPLAY_PROPERTIES"]["DESIGNER"]["LINK_ELEMENT_VALUE"][$arItems["PROPERTIES"]["DESIGNER"]["VALUE"]]["NAME"]?>
                	</p>
                </div>
            </div>
        </a>
    </li>
<?endforeach?>