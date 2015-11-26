<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Проекты");?>
<?if ($USER->isAuthorized() && in_array(8, $USER->GetUserGroupArray())):?>
    <?
        $arProjects = getProjects($USER->GetID());
    ?>
	<div class="outer-content-wrapper lk-page">
        <div class="content-wrapper">
            <a class="lk-sidebar-trigger js-lk-side-trigger mobile" href="#">Личный кабинет</a>
            <?
                include($_SERVER["DOCUMENT_ROOT"]."/include/menu_personal.php");
            ?>
            <div class="lk-inner">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "bread",
                    Array(
                        "START_FROM" => "0",
                        "PATH" => "",
                        "SITE_ID" => "-"
                    )
                );?>
                <h1>Мои проекты</h1>
                <div class="lk-section projects lk-my-projects">
                    <ul class="designer-projects-list">
                        <?foreach ($arProjects as $key => $arItems) :?>
                            <li class="designer-project-item" data-id="<?=$arItems["ID"]?>">
                                <a href="<?=$arItems["~DETAIL_PAGE_URL"]?>">
                                    <img src="<?=CFile::GetPath($arItems["~PREVIEW_PICTURE"])?>" alt="<?=$arItems["NAME"]?>"/>
                                    <div class="caption">
                                        <p class="heading">
                                            <?=$arItems["NAME"]?>
                                        </p>
                                    </div>
                                </a>
                                <div class="project-actions">
                                    <button class="btn js-project-remove" href="#" data-id="<?=$arItems["ID"]?>">Удалить</button>
                                    <a class="btn important" href="/personal/projects/update/">Изменить</a>
                                </div>
                            </li>
                        <?endforeach?>
                    </ul>
                </div>
                <div class="mobile-wrapper">
                    <a class="btn" href="/personal/projects/add/">Добавить проект</a>
                </div>
            </div>
        </div>
    </div>
<?else:
    LocalRedirect("/auth/");
endif?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>