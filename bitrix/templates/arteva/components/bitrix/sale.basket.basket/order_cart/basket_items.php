<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
    if ($_REQUEST["PAY_SYSTEM_ID"] == 10):
        $actionPayed = true;
    endif;
    $idUser = $USER->GetID();
?>
<div class="col12">
    <p class="header">Состав заказа</p>
    <ul class="checkout-order-list">
        <?foreach ($arResult["ITEMS"]["AnDelCanBuy"] as $key => $arItems) :?>
        	<?
    			$arPropItems = getItemCart($arItems["PRODUCT_ID"]);
                if ($arPropItems["CATALOG_PROP"]["QUANTITY"] < 2 && $_REQUEST["PAY_SYSTEM_ID"] == 10):
                    $actionPayed = false;
                endif;
    		?>
            <li class="checkout-order-item">
                <aside>
                    <?
                        //$waterImage = waterImage($arItems["PREVIEW_PICTURE"]);
                        // $waterImage["src"]
                        $waterImage["src"] = CFIle::GetPath($arItems["PREVIEW_PICTURE"]);
                    ?>
                    <div class="img-cnt">
                        <img src="<?=$waterImage["src"]?>" alt="item"/>
                    </div>
                </aside>
                <div class="order-item-info">
                    <p class="item-num">Артикул <?=$arPropItems["PROPERTY_ARTIKUL_VALUE"]?></p>
                    <p class="item-descr"><?=$arItems["NAME"]?></p>
                    <p>
                        <span class="item-count">x <?=$arItems["QUANTITY"]?> шт.</span><span class="item-sum">на сумму <?=number_format(($arItems["PRICE"]+$arItems["DISCOUNT_PRICE"])*$arItems["QUANTITY"], 0, 0, " ")?> руб.</span>
                    </p>
                </div>
            </li>
        <?endforeach?>
    </ul>
    <p class="header">Параметры заказа</p>
    <ul class="checkout-order-params">
        <li class="checkout-param">
            <span>Стоимость товаров</span>
            <span><?=number_format($arResult["allSum"]+$arResult["DISCOUNT_PRICE_ALL"], 0, 0, " ")?> руб.</span>
        </li>
        <li class="checkout-param">
            <span>Со скидкой</span>
            <span><?=number_format($arResult["allSum"], 0, 0, " ")?> руб.</span>
        </li>
        <li class="checkout-param">
            <?$arDeliv = CSaleDelivery::GetByID($_REQUEST["DELIVERY_ID"]);?>
            <span>Доставка</span>
            <span><?=$arDeliv["NAME"]?> — <?=$arDeliv["DESCRIPTION"]?></span>
        </li>
        <li class="checkout-param">
            <span>Адрес доставки</span>
            <span><?=$_REQUEST["ORDER_PROP_7"]?></span>
        </li>
        <li class="checkout-param">
            <span>Оплата</span>
            <span><?=getPaySystemName($_REQUEST["PAY_SYSTEM_ID"])?></span>
        </li>
    </ul>
    <p class="header">
        <a href="#" class="checkout-confirm-comment js-checkout-confirm-comment-trigger">Ваш комментарий</a>
    </p>
    <fieldset class="checkout-confirm-comment-cnt<?=($_REQUEST["ORDER_DESCRIPTION"])?" comment-true":""?>">
        <textarea name="ORDER_DESCRIPTION" id="checkout-confirm-comment" ><?=$_REQUEST["ORDER_DESCRIPTION"]?></textarea>
    </fieldset>
</div>
<div class="col12">
    <div class="checkout-total-cnt">
        <p class="checkout-total"><span><strong>К оплате</strong></span><span><strong><?=number_format($arResult["allSum"], 0, 0, " ")?></strong> руб.</span></p>
        <p class="checkout-economy"><span>Ваша экономия</span><span><?=number_format($arResult["DISCOUNT_PRICE_ALL"], 0, 0, " ")?> руб.</span></p>
        <p class="checkout-confirm-comment-info">Сумма заказа указана без учета стоимости доставки</p>
        <!--p class="checkout-confirm-comment-info" style="margin-top: 10px;">Обращаем ваше внимание, что в праздничные дни 1-4 и 9-11 мая 2015 года обработка заказов и их доставка будут производиться в первые рабочие дни после выходных</p>
        <p class="checkout-confirm-comment-info" style="margin-top: 10px;"><a href="/schedule/" target="_blank">Подробнее</a></p-->
        <fieldset class="checkout-confirm">
            <input type="submit" name="ORDER_CONFIRM_BUTTON" value="Подтвердить заказ" class="important" onclick="ga('send', 'event', 'order', 'confirmation-yes'); return true;"/>
        </fieldset>
        <fieldset class="checkout-confirm">
            <a class="btn" href="/personal/order/make/">Изменить способ доставки/оплаты</a>
        </fieldset>
        <?if ($actionPayed === false):?>
            <p class="checkout-confirm-comment-info"><strong>Внимание!</strong> <br/> В вашем заказе есть товар категории «по запросу». В данном случае оплата онлайн будет возможна после подтверждения заказа оператором. При условии наличия этого товара на ваш e-mail будет отправлено письмо, содержащее ссылку на страницу банка для последующей оплаты, в противном случае оператор с вами свяжется.</p>
        <?endif?>
    </div>
</div>
<input type="hidden" name="PROFILE_ID" value="<?=$idUser?>">
<input type="hidden" name="DELIVERY_ID" value="<?=$_REQUEST["DELIVERY_ID"]?>">
<textarea name="ORDER_PROP_7" style="display:none;"><?=$_REQUEST["ORDER_PROP_7"]?></textarea>
<input type="hidden" name="PAY_SYSTEM_ID" value="<?=$_REQUEST["PAY_SYSTEM_ID"]?>">
<input type="hidden" name="ORDER_PROP_3" value="<?=getUserPhone($idUser)?>">
<?
if ($_FILES["requisits"]):
	$idFile = CFile::SaveFile($_FILES["requisits"], "file_order");
endif;
?>
<input type="hidden" name="ORDER_PROP_20" value="<?=$idFile?>">