<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="content-wrapper">
    <nav>
        <ul class="menu">
        	<?foreach ($arResult as $key => $arItem) :?>
	            <li class="<?if ($arItem["SELECTED"]):?>active<?endif?>">
	                <a href="<?=$arItem["LINK"]?>">
						<?=$arItem["TEXT"]?>
					</a>
	            </li>
            <?endforeach?>
        </ul>
    </nav>
</div>