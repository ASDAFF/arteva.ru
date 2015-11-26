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
<p class="popup-header">Заказать звонок</p>
<?=$arResult["FORM_HEADER"]?>
    <fieldset>
        <label for="cb-name">Ваше имя</label>
        <input type="text" name="form_text_<?=$arResult["QUESTIONS"]["SIMPLE_QUESTION_363"]["STRUCTURE"][0]["ID"]?>" id="cb-name" data-parsley-required/>
    </fieldset>
    <fieldset>
        <label for="cb-phone">Номер телефона</label>
        <input type="text" name="form_text_<?=$arResult["QUESTIONS"]["SIMPLE_QUESTION_816"]["STRUCTURE"][0]["ID"]?>" id="cb-phone" class="js-masked" data-parsley-required/>
    </fieldset>
    <fieldset>
        <label for="cb-comment">Комментарий</label>
        <textarea name="form_textarea_<?=$arResult["QUESTIONS"]["SIMPLE_QUESTION_172"]["STRUCTURE"][0]["ID"]?>" id="cb-comment" placeholder="Укажите, пожалуйста, желаемое время звонка по Московскому времени." data-parsley-required></textarea>
    </fieldset>
    <fieldset class="submit-cnt">
        <input type="submit" value="Отправить" name="web_form_submit" onclick="ga('send', 'event', 'call-me-please-form', 'sent');return true;"/>
        <p class="require-msg">Все поля обязательны для заполнения</p>
    </fieldset>
<?=$arResult["FORM_FOOTER"]?>
<?//echo "<pre>";print_r($_REQUEST);echo "</pre>";?>
<?//echo "<pre>";print_r($arResult);echo "</pre>";?>