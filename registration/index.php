<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Регистрация");
$APPLICATION->SetPageProperty("keywords", "Регистрация");
$APPLICATION->SetPageProperty("description", "Регистрация");
$APPLICATION->SetTitle("Регистрация");?>
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
            <h1>Регистрация</h1>
            <?$APPLICATION->IncludeComponent(
            	"itech:main.register",
            	"reg",
            	Array(
			        "USER_PROPERTY_NAME" => "", 
			        "SEF_MODE" => "Y", 
			        "SHOW_FIELDS" => Array(
			        	"NAME", "PERSONAL_PHONE",
			        	"EMAIL"
			        	), 
			        "REQUIRED_FIELDS" => Array(
			        	"NAME"
			        	),
			        "AUTH" => "Y", 
			        "USE_BACKURL" => "Y", 
			        "SUCCESS_PAGE" => "/registration/", 
			        "SET_TITLE" => "Y", 
			        "USER_PROPERTY" => Array(
			        	"UF_SUBSCRIBE"
			        	), 
			        "SEF_FOLDER" => "/", 
			        "VARIABLE_ALIASES" => Array()
			    )
			);?>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
