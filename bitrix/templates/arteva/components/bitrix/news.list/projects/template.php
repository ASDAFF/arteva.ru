<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<ul class="designer-projects-list" data-all-page="<?=$arResult["NAV_RESULT"]->NavPageCount?>">
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
</ul>
<? if ($arResult["NAV_RESULT"]->NavPageCount > 1) :?>
    <div class="aright show-more-projects-cnt"><a class="btn important js-show-more-projects" href="#">Показать еще</a></div>
<?endif;?>
