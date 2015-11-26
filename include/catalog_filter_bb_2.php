<div class="wrap_filter_m">
	<div class="filter_line_m">
		<a href="<?=$APPLICATION->GetCurPageParam("TIP_SV1=41532", array("TIP_SV2", "TIP_SV3", "TIP_SV4", "SEC1", "SEC2"));?>" class="filter_item_m <?=(isset($_GET["TIP_SV1"]))?"active_filt_i_m":"";?>">Настольные лампы</a>
		<a href="<?=$APPLICATION->GetCurPageParam("TIP_SV2=41530", array("TIP_SV1", "TIP_SV3", "TIP_SV4", "SEC1", "SEC2"));?>" class="filter_item_m <?=(isset($_GET["TIP_SV2"]))?"active_filt_i_m":"";?>">Торшеры</a>
		<a href="<?=$APPLICATION->GetCurPageParam("TIP_SV3=41528,41533,41534,41529", array("TIP_SV2", "TIP_SV1", "TIP_SV4", "SEC1", "SEC2"));?>" class="filter_item_m <?=(isset($_GET["TIP_SV3"]))?"active_filt_i_m":"";?>">Потолочное освещение</a>
		<a href="<?=$APPLICATION->GetCurPageParam("TIP_SV4=41531", array("TIP_SV2", "TIP_SV3", "TIP_SV1", "SEC1", "SEC2"));?>" class="filter_item_m <?=(isset($_GET["TIP_SV4"]))?"active_filt_i_m":"";?>">БРА</a>
		<a href="<?=$APPLICATION->GetCurPageParam("SEC1=705,706,707", array("TIP_SV2", "TIP_SV3", "TIP_SV4", "TIP_SV1", "SEC2"));?>" class="filter_item_m <?=(isset($_GET["SEC1"]))?"active_filt_i_m":"";?>">Уличные</a>
		<a href="<?=$APPLICATION->GetCurPageParam("SEC2=667", array("TIP_SV2", "TIP_SV3", "TIP_SV4", "SEC1", "TIP_SV1"));?>" class="filter_item_m <?=(isset($_GET["SEC2"]))?"active_filt_i_m":"";?>">Лампочки</a>
		
		
		<a href="<?=(!isset($_GET["price_sort"]))?"?price_sort=Y":"?price_sort2=Y"?>" class="sort_price_m">По цене</a>
	</div>
	<div class="filter_line_m flm2">
		<span>Светильники</span>
		<a href="<?=$APPLICATION->GetCurPageParam("am=Y", array("PLACE1", "PLACE2", "PLACE3", "TIP_SV4", "PLACE5"));?>" class="filter_item_m f1mm <?=(isset($_GET["am"]))?"active_filt_i_m":"";?>">ВСЕ</a>
		<a href="<?=$APPLICATION->GetCurPageParam("PLACE1=41548", array("am", "PLACE2", "PLACE3", "PLACE4", "PLACE5"));?>" class="filter_item_m  <?=(isset($_GET["PLACE1"]))?"active_filt_i_m":"";?>">Кухня</a>
		<a href="<?=$APPLICATION->GetCurPageParam("PLACE2=41546", array("am", "PLACE1", "PLACE3", "PLACE4", "PLACE5"));?>" class="filter_item_m  <?=(isset($_GET["PLACE2"]))?"active_filt_i_m":"";?>">Гостинная</a>
		<a href="<?=$APPLICATION->GetCurPageParam("PLACE3=41550", array("am", "PLACE2", "PLACE1", "PLACE4", "PLACE5"));?>" class="filter_item_m  <?=(isset($_GET["PLACE3"]))?"active_filt_i_m":"";?>">Спальня</a>
		<a href="<?=$APPLICATION->GetCurPageParam("PLACE4=41549", array("am", "PLACE2", "PLACE3", "PLACE1", "PLACE5"));?>" class="filter_item_m  <?=(isset($_GET["PLACE4"]))?"active_filt_i_m":"";?>">Прихожая</a>
		<a href="<?=$APPLICATION->GetCurPageParam("PLACE5=41547", array("am", "PLACE2", "PLACE3", "PLACE4", "PLACE1"));?>" class="filter_item_m  <?=(isset($_GET["PLACE5"]))?"active_filt_i_m":"";?>">Детская комната</a>
	</div>
</div>