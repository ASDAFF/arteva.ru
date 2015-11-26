<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Смена пароля");
$APPLICATION->SetPageProperty("keywords", "Смена пароля");
$APPLICATION->SetPageProperty("description", "Смена пароля");
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
            <h1>Смена пароля</h1>
            <div class="register-form-cnt common-form">
            <?$APPLICATION->IncludeComponent(
                "bitrix:system.auth.changepasswd",
                "change_default",
                Array()
            );?>
            </div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>