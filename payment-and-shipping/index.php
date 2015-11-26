<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "&laquo;Arteva Home&raquo; - Оплата и доставка");
$APPLICATION->SetPageProperty("keywords", "&laquo;Arteva Home&raquo; Оплата и доставка");
$APPLICATION->SetPageProperty("description", "Оплата и доставка. &laquo;Arteva Home&raquo;");
$APPLICATION->SetTitle("Оплата и доставка");?>
<div class="outer-content-wrapper">
    <div class="content-wrapper">
        <?$APPLICATION->IncludeComponent(
	        "bitrix:breadcrumb",
	        "bread",
	        Array(
	            "START_FROM" => "0",
	            "PATH" => "",
	            "SITE_ID" => "-"
	        )
	    );?>
        <h1>Оплата и доставка</h1>
        <div class="payment-links-section">
        	<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"payments",
				Array(
					"IBLOCK_TYPE" => "pay",
					"IBLOCK_ID" => "11",
					"SECTION_ID" => "",
					"SECTION_CODE" => "",
					"SECTION_URL" => "",
					"COUNT_ELEMENTS" => "Y",
					"TOP_DEPTH" => "1",
					"SECTION_FIELDS" => array("DESCRIPTION", "PICTURE"),
					"SECTION_USER_FIELDS" => array("UF_IMAGE_MOBILE"),
					"ADD_SECTIONS_CHAIN" => "Y",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "3600",
					"CACHE_GROUPS" => "Y"
				),
			false
			);?>
        </div>
    </div>

</div>

<div class="outer-content-wrapper payment-section">
    <div class="content-wrapper">
        <div class="text-content">
        	<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"payments_detail",
				Array(
					"IBLOCK_TYPE" => "pay",
					"IBLOCK_ID" => "11",
					"SECTION_ID" => "",
					"SECTION_CODE" => "",
					"SECTION_URL" => "",
					"COUNT_ELEMENTS" => "Y",
					"TOP_DEPTH" => "1",
					"SECTION_FIELDS" => array("DESCRIPTION", "PICTURE"),
					"SECTION_USER_FIELDS" => array("UF_IMAGE_MOBILE"),
					"ADD_SECTIONS_CHAIN" => "Y",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "3600",
					"CACHE_GROUPS" => "Y"
				),
			false
			);?>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>