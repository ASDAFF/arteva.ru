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
                content:'<p class="popup-header">Успешно</p><div class="text-content"><p>Наш менеджер свяжется с Вами.</p></div><div class="acenter"><a class="btn js-fbx-close" href="#">Закрыть</a></div>',
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
<p class="popup-header">Отправить менеджеру</p>
<?=$arResult["FORM_HEADER"]?>
    <fieldset>
        <label for="cb-comment">Комментарий</label>
        <textarea name="form_textarea_<?=$arResult["QUESTIONS"]["SIMPLE_QUESTION_689"]["STRUCTURE"][0]["ID"]?>" id="cb-comment" placeholder="Комментарий к спецификации" data-parsley-required></textarea>         
    </fieldset>
    <fieldset>
            <label for="user_phone">Телефон пользователя</label>
            <input type='text' name="form_text_<?=$arResult["QUESTIONS"]["USER_PHONE"]["STRUCTURE"][0]["ID"]?>" id="user_phone" data-parsley-required>
    </fieldset>
    <fieldset class="submit-cnt">
        <input type="hidden" name="form_text_<?=$arResult["QUESTIONS"]["SIMPLE_QUESTION_584"]["STRUCTURE"][0]["ID"]?>" value="<?=$USER->GetFullName()?>"/>
        <input type="hidden" name="form_text_<?=$arResult["QUESTIONS"]["SIMPLE_QUESTION_314"]["STRUCTURE"][0]["ID"]?>" value="1" id="PATH_FILE"/>
        <input type="hidden" name="form_text_<?=$arResult["QUESTIONS"]["SIMPLE_QUESTION_391"]["STRUCTURE"][0]["ID"]?>" value="" id="SPEC_ID"/>
        <input type="submit" value="Отправить" name="web_form_submit"/>
    </fieldset>
<?=$arResult["FORM_FOOTER"]?>
<?//echo "<pre>";print_r($_REQUEST);echo "</pre>";?>
<?//echo "<pre>";print_r($arResult);echo "</pre>";?>