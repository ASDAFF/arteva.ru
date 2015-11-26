<?php
$bodyprefix = '';
$curprefix = '';
include('header.php');
?>

    <div class="outer-content-wrapper">
        <div class="content-wrapper">
            <ul class="breadcrumbs">
                <li class="bc-item"><a href="/">Главная</a></li>
                <li class="bc-item"><a>Оплата и доставка</a></li>
            </ul>
            <h1>Оплата и доставка</h1>
            <div class="payment-links-section">
                <ul class="links-list">
                    <li class="link-item">
                        <div class="img-cnt">
                            <picture>
                                <!--[if IE 9]><video style="display: none;"><![endif]-->
                                <source srcset="/img/icon_payment_mobile1.png" media="(max-width: 640px)">
                                <!--[if IE 9]></video><![endif]-->
                                <img srcset="/img/icon_payment1.png" alt="Способы оплаты">
                            </picture>
                        </div>
                        <p class="link-header">Способы оплаты</p>
                        <p><a href="#payment-cash">Наличными при получении</a></p>
                        <p><a href="#payment-card">картой онлайн</a></p>
                    </li>
                    <li class="link-item">
                        <div class="img-cnt">
                            <picture>
                                <!--[if IE 9]><video style="display: none;"><![endif]-->
                                <source srcset="/img/icon_payment_mobile2.png" media="(max-width: 640px)">
                                <!--[if IE 9]></video><![endif]-->
                                <img srcset="/img/icon_payment2.png" alt="Способы доставки">
                            </picture>
                        </div>
                        <p class="link-header">Способы доставки</p>
                        <p><a href="#delivery-self">Самовывоз в Москве</a></p>
                        <p><a href="#delivery-city">Доставка по Москве и МО</a></p>
                        <p><a href="#delivery-country">Доставка по РФ</a></p>
                    </li>
                    <li class="link-item">
                        <div class="img-cnt">
                            <picture>
                                <!--[if IE 9]><video style="display: none;"><![endif]-->
                                <source srcset="/img/icon_payment_mobile3.png" media="(max-width: 640px)">
                                <!--[if IE 9]></video><![endif]-->
                                <img srcset="/img/icon_payment3.png" alt="Информация для покупателей">
                            </picture>
                        </div>
                        <p class="link-header">Информация для покупателей</p>

                        <p><a href="#info-refund">Возврат товара</a></p>
                        <p><a href="#info-guarantee">Гарантийные обязательства</a></p>
                        <p><a href="#info-service">Сервисное обслуживание</a></p>
                    </li>
                </ul>
            </div>
        </div>

    </div>

    <div class="outer-content-wrapper payment-section">
        <div class="content-wrapper">
            <div class="text-content">
                <h2>Способы оплаты</h2>
                <h3 id="payment-cash">Наличными при получении</h3>
                <p>Расплатиться наличными можно непосредственно с курьером, когда он доставит заказ, либо в офисе или магазине. При получении товара, оплаченного по безналичному расчету от организации или ИП, необходимо иметь при себе доверенность или печать организации или ИП. При получении товара, оплаченного от Физического лица, необходимо иметь при себе паспорт.</p>
                <h3 id="payment-card">Банковской картой онлайн</h3>
                <p>Счет на Физическое лицо может быть оплачен on-line через Интернет-банк (если такая услуга есть в сервисе Вашего банка) или непосредственно через отделения Сбербанка.
                    <br/>
                    Оплата осуществляется перед отправкой товара. По Вашему желанию для дополнительных гарантий перед оплатой возможно заключение Договора купли-продажи (в том числе и с Физическими лицами), чтобы Вы были на 100% уверены в том, что товар будет отправлен Вам сразу после оплаты. </p>
                <hr/>
                <h2>Способы доставки</h2>
                <h3 id="delivery-self">Самовывоз по москве</h3>
                <p>Доставка заказа осуществляется в течение 1-3 дней с момента размещения заказа при условии наличия товара на складе. При оформлении заказа указывайте в соответствующем поле, что Вы хотели бы получить товар доставкой курьером. После получения заказа Интернет-магазином, с Вами свяжется наш специалист для подтверждения заказа и согласования даты и времени доставки.
                    <br/>
                    Доставка осуществляется в рабочие дни (понедельник - пятница). Возможен выбор временного интервала (с 10.00 до 13.00 или с 13.00 до 17.00). </p>
                <h3 id="delivery-city">Доставка по Москве и Московской области</h3>
                <p>Доставка заказа осуществляется в течение 1-3 дней с момента размещения заказа при условии наличия товара на складе. </p>
                <p>При оформлении заказа указывайте в соответствующем поле, что Вы хотели бы получить товар доставкой курьером. После получения заказа Интернет-магазином, с Вами свяжется наш специалист для подтверждения заказа и согласования даты и времени доставки.
                    Доставка осуществляется в рабочие дни (понедельник - пятница). Возможен выбор временного интервала (с 10.00 до 13.00 или с 13.00 до 17.00). </p>
            </div>
        </div>
    </div>


<?php
include('footer.php');
?>