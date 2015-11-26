<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Восстановление пароля");
$APPLICATION->SetPageProperty("keywords", "Восстановление пароля");
$APPLICATION->SetPageProperty("description", "Восстановление пароля");
$APPLICATION->SetTitle("Восстановление пароля");?>
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
        <div class="text-content">
            <h1>Напомнить пароль</h1>
            <?$APPLICATION->IncludeComponent(
				"bitrix:system.auth.forgotpasswd",
				"auth",
				Array()
			);?>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>