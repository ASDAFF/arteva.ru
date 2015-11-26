<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<ul class="buy-salons-list">
	<?foreach ($arResult["ITEMS"] as $key => $arItems) :?>
		<?if ($key%3 == 0):?>
			</ul><ul class="buy-salons-list">
		<?endif?>
	    <li>
	        <a href="<?=$arItems["~DETAIL_PAGE_URL"]?>">
	            <div class="img-cnt">
	            	<img class="cover" src="<?=CFile::GetPath($arItems["~PREVIEW_PICTURE"])?>" alt="img"/>
	            </div>
	            <div class="salon-descr">
	                <p class="name"><?=$arItems["NAME"]?></p>
	                <p class="location"><?=$arItems["~PREVIEW_TEXT"]?></p>
	            </div>
	        </a>
	    </li>
	<?endforeach?>
</ul>