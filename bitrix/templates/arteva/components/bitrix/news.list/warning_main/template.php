<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach ($arResult["ITEMS"] as $key => $arItems) :?>
	<div class="warning_open">
		<span>Развернуть</span>
	</div>
	<div class="warning_banner" <?if ($arItems["PREVIEW_PICTURE"]["SRC"]) {?>style="background-image: url('<?=$arItems["PREVIEW_PICTURE"]["SRC"]?>'); <?if ($arItems["DETAIL_TEXT"]) {?>cursor: pointer;<?}?>"<?}?> <?if ($arItems["DETAIL_TEXT"]) {?>onclick="location.href='<?=$arItems["DETAIL_TEXT"]?>'"<?}?> >
		<div class="warning_close"><span>Закрыть</span></div>
		<?if ($arItems["PREVIEW_TEXT"]){?>
			<?=$arItems["PREVIEW_TEXT"]?>
		<?}?>
	</div>
<?endforeach?>

<script type="text/javascript">
	$(window).load(function(){
		if (localStorage.wantWarning == 'no'){
			$(".warning_banner").hide();
			$(".warning_open").show();
		};
	});
</script>