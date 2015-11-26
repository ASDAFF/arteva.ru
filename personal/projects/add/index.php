<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавить проект");?>
<?if ($USER->isAuthorized() && in_array(8, $USER->GetUserGroupArray())):?>
	<div class="outer-content-wrapper lk-page">
        <div class="content-wrapper">
            <?
                include($_SERVER["DOCUMENT_ROOT"]."/include/menu_personal.php");
            ?>
            <div class="lk-inner">
                <ul class="breadcrumbs">
                    <li class="bc-item"><a href="/">Главная</a></li>
                    <li class="bc-item"><a>Личный кабинет</a></li>
                </ul>
                <h1>Добавить проект</h1>
                <div class="lk-section">
                	<div class="text-content">
	                	<p>Вы можете добавить *</p>
	                	<ul>
	                		<li>до 10 фотографий в формате png или jpg</li>
	                		<li>описание проекта: текст объемом до 3 000 символов</li>
	                	</ul>
	                    <div class="common-form">
	                		<?$APPLICATION->IncludeComponent(
                                "bitrix:form.result.new",
                                "projects",
                                Array(
                                    "SEF_MODE" => "N",
                                    "WEB_FORM_ID" => "3",
                                    "LIST_URL" => "",
                                    "EDIT_URL" => "",
                                    "SUCCESS_URL" => "",
                                    "CHAIN_ITEM_TEXT" => "",
                                    "CHAIN_ITEM_LINK" => "",
                                    "IGNORE_CUSTOM_TEMPLATE" => "N",
                                    "USE_EXTENDED_ERRORS" => "Y",
                                    "CACHE_TYPE" => "A",
                                    "CACHE_TIME" => "3600",
                                    "VARIABLE_ALIASES" => Array(
                                    )
                                ),
                                false
                            );?>
	                	</div>
	                </div>
                </div>
            </div>
        </div>
    </div>
<?else:
    LocalRedirect("/auth/");
endif?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>