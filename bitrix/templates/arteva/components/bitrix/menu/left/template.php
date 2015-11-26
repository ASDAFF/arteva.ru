<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
	<ul class="tabbed-links">
		<?foreach($arResult as $key => $arItem):?>
			<li<?if ($arItem["SELECTED"]):?> class="active"<?endif?>>
				<a class="<?if ($arItem["SELECTED"]):?> active<?endif?>" href="<?=$arItem["LINK"]?>">
					<?=$arItem["TEXT"]?>
				</a>
			</li>
		<?endforeach?>
	</ul>
<?endif?>