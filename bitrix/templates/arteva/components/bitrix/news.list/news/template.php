<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-list-cnt">
    <ul class="news-list">
    	<?foreach ($arResult["ITEMS"] as $key => $arItems) :?>
    		<?if ($key > 0 && $key%3 == 0):?>
    			</ul><ul class="news-list">
    		<?endif?>
	        <li>
	        	<a href="<?=$arItems["~DETAIL_PAGE_URL"]?>">
	                <div class="img-cnt">
	                	<img src="<?=CFile::GetPath($arItems["~PREVIEW_PICTURE"])?>" alt="" class="cover"/>
	                </div>
	                <div class="news-info">
	                    <p class="news-date">
	                    	<?=CIBlockFormatProperties::DateFormat("H:i", MakeTimeStamp($arItems["ACTIVE_FROM"], FORMAT_DATETIME));?>, 
	                    	<?=CIBlockFormatProperties::DateFormat("d F Y", MakeTimeStamp($arItems["ACTIVE_FROM"], FORMAT_DATETIME));?>
	                    </p>
	                    <p class="news-announce"><?=$arItems["NAME"]?></p>
	                </div>
	            </a>
	        </li>
       	<?endforeach?>
    </ul>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>