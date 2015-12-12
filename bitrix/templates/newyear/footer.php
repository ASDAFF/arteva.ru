<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>





	<footer>
		<div class="footer_top_line">
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"bottom_menu",
				Array(
					"IBLOCK_TYPE" => "catalog",
					"IBLOCK_ID" => "17",
					"SECTION_ID" => "",
					"SECTION_CODE" => "",
					"SECTION_URL" => "",
					"COUNT_ELEMENTS" => "Y",
					"TOP_DEPTH" => "2",
					"SECTION_FIELDS" => array("DESCRIPTION", "PICTURE", "DETAIL_PICTURE"),
					"SECTION_USER_FIELDS" => array(),
					"ADD_SECTIONS_CHAIN" => "Y",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "3600",
					"CACHE_GROUPS" => "Y"
				),
			false
			);?>
		
		</div>
	</footer>
</div> <!-- End mconteiner -->
<script src="/js/addons/device.min.js"></script>
<script src="/js/addons/picturefill.min.js"></script>
<script src="/js/addons/doubletaptogo.min.js"></script>
<script src="/js/plugins/unveil/jquery.unveil.js"></script>
<script src="/js/main.js"></script>

<script type="text/javascript">
    (function (w, d) {
        try {
            var el = 'getElementsByTagName', rs = 'readyState';
            if (d[rs] !== 'interactive' && d[rs] !== 'complete') {
                var c = arguments.callee;
                return setTimeout(function () { c(w, d) }, 100);
            }
            var s = d.createElement('script');
            s.type = 'text/javascript';
            s.async = s.defer = true;
            s.src = '//aprtx.com/code/arteva/';
            var p = d[el]('body')[0] || d[el]('head')[0];
            if (p) p.appendChild(s);
        } catch (x) { if (w.console) w.console.log(x); }
    })(window, document);
	
		console.log(window.APRT_DATA)
</script>
</body>
</html>
