<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Карта сайта");
$APPLICATION->SetPageProperty("keywords", "Карта сайта");
$APPLICATION->SetPageProperty("description", "Карта сайта");
$APPLICATION->SetTitle("Карта сайта");?>
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
        <h1>Карта сайта</h1>
        <div class="sitemap-cnt">
            <div class="sitemap-top">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:catalog.section.list",
                    "section_site_map",
                    Array(
                        "IBLOCK_TYPE" => "catalog",
                        "IBLOCK_ID" => "17",
                        "SECTION_ID" => "",
                        "SECTION_CODE" => "",
                        "COUNT_ELEMENTS" => "Y",
                        "TOP_DEPTH" => "1",
                        "SECTION_FIELDS" => array("","",""),
                        "SECTION_USER_FIELDS" => array("","",""),
                        "VIEW_MODE" => "LINE",
                        "SHOW_PARENT_NAME" => "Y",
                        "SECTION_URL" => "",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_GROUPS" => "Y",
                        "ADD_SECTIONS_CHAIN" => "Y"
                    )
                );?>
                <div class="sitemap-section">
                    <div class="sitemap-header">Разделы сайта</div>
                    <ul class="sitemap-links-list">
                        <li><a href="/catalog/sale/">SALE</a></li>
                        <li><a href="/catalog/new/">Новинки</a></li>
                        <li><a href="/salons/">Купить в салоне</a></li>
                        <li><a href="/payment-and-shipping/">Оплата и доставка</a></li>
                        <li><a href="/about/">О компании</a></li>
                        <li><a href="/brands/">Наши торговые марки</a></li>
                        <li><a href="/designers/">Дизайнерам</a></li>
                        <li><a href="/projects/">Проекты</a></li>
                        <li><a href="/news/">Новости</a></li>
                        <li><a href="/contacts/">Контакты</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>