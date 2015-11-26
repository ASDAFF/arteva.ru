<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "&laquo;Arteva Home&raquo; - Авторизация");
$APPLICATION->SetPageProperty("keywords", "Arteva Home Авторизация");
$APPLICATION->SetPageProperty("description", "Авторизация. &laquo;Arteva Home&raquo;");
$APPLICATION->SetTitle("Авторизация");?>
<?if (!$USER->isAuthorized()):?>
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
	        	<h1>Авторизация</h1>
                <div class="auth-form-cnt common-form" style="margin-left:auto; margin-right: auto;">
					<?$APPLICATION->IncludeComponent(
						"bitrix:system.auth.form",
						"auth",
						Array(
							"REGISTER_URL" => "/registration/",
							"FORGOT_PASSWORD_URL" => "/forgot-password/",
							"PROFILE_URL" => "/repsonal/",
							"SHOW_ERRORS" => "Y" 
							)
					);?>
                </div>
			</div>
		</div>
	</div>
<?else:
	LocalRedirect("/personal/");
endif?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>