<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult["FORM_ERRORS_TEXT"] && $arResult["arForm"]["ID"] == intval($_REQUEST["WEB_FORM_ID"])) {?>
    <? /* HAS! error */ ?>
    <script type="text/javascript"> 
        $(window).load(function(){
            $.fancybox({
                content:'<p class="popup-header">Ошибка</p><div class="text-content"><?=trim($arResult["FORM_ERRORS_TEXT"])?></div><div class="acenter"><a class="btn js-fbx-close" href="#">Закрыть</a></div>',
                padding: [30, 20, 20, 20],
                wrapCSS: 'arteva-popup',
                tpl: {
                    closeBtn: '<div class="fancybox__close"><a class="fbx__close" href="#">&nbsp;</a></div>'
                },
                minWidth: 380,
                openEffect  : 'drop',
                closeEffect : 'drop',
                nextEffect  : 'elastic',
                prevEffect  : 'elastic'
            });
         });
    </script>
<?}elseif ($_REQUEST['formresult'] && $arResult["FORM_ERRORS_TEXT"] == "" && $arResult["arForm"]["ID"] == intval($_REQUEST["WEB_FORM_ID"])){?>
    <? /* no error */ ?>
    <script type="text/javascript"> 
        $(window).load(function(){
            $.fancybox({
                content:'<p class="popup-header">Успешно</p><div class="text-content"><p>Проект появится после модерации</p></div><div class="acenter"><a class="btn js-fbx-close" href="#">Закрыть</a></div>',
                padding: [30, 20, 20, 20],
                wrapCSS: 'arteva-popup',
                tpl: {
                    closeBtn: '<div class="fancybox__close"><a class="fbx__close" href="#">&nbsp;</a></div>'
                },
                minWidth: 380,
                openEffect  : 'drop',
                closeEffect : 'drop',
                nextEffect  : 'elastic',
                prevEffect  : 'elastic'
            });
         });
    </script>
<?}?>
<p class="popup-header">Заказать звонок</p>
<?=$arResult["FORM_HEADER"]?>
    <div class="">
        <fieldset>
            <label for="name_project">Название проекта*</label>
            <input type="text" name="form_text_<?=$arResult["QUESTIONS"]["SIMPLE_QUESTION_241"]["STRUCTURE"][0]["ID"]?>" id="name_project" value="" data-parsley-required/>
        </fieldset>
        <fieldset>
            <label for="file_project">Архив фото (zip/rar)*</label>
            <input type="file" name="form_file_<?=$arResult["QUESTIONS"]["SIMPLE_QUESTION_170"]["STRUCTURE"][0]["ID"]?>" id="file_project" value="" data-parsley-required/>
        </fieldset>
        <fieldset>
            <label for="description">Описание проекта*</label>
            <textarea name="form_textarea_<?=$arResult["QUESTIONS"]["SIMPLE_QUESTION_294"]["STRUCTURE"][0]["ID"]?>" id="description" data-parsley-required></textarea>
        </fieldset>
        <fieldset>
            <label for="user_phone">Телефон пользователя</label>
            <input type='text' name="form_text_<?=$arResult["QUESTIONS"]["USER_PHONE"]["STRUCTURE"][0]["ID"]?>" id="user_phone" data-parsley-required>
        </fieldset>
        <div class="btn-cnt">
            <input type="hidden" value="<?="[".$USER->GetID()."] (".$USER->GetLogin().") ".$USER->GetFullName();?>" name="form_text_<?=$arResult["QUESTIONS"]["SIMPLE_QUESTION_213"]["STRUCTURE"][0]["ID"]?>">
            <input type="submit" name="web_form_submit" value="Добавить"/>
            <p class="require-msg">Все поля обязательны для заполнения</p>
        </div>
    </div>
<?=$arResult["FORM_FOOTER"]?>
<?//echo "<pre>";print_r($_REQUEST);echo "</pre>";?>
<?//echo "<pre>";print_r($arResult);echo "</pre>";?>