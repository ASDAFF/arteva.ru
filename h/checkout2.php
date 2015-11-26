<?php
$bodyprefix = '';
$curprefix = '';
    include('header.php');
?>

<div class="outer-content-wrapper checkout-page">
    <ul class="breadcrumbs">
        <li class="bc-item"><a href="/">Главная</a></li>
        <li class="bc-item"><a>Оформление заказа</a></li>
    </ul>
    <h1>Оформление заказа</h1>
    <div class="checkout-wrapper">
        <div class="content-wrapper">
            <div class="steps-indicators">
                <div class="step-indicator">
                    <div class="step-num">1</div>
                    <p class="step-name">Шаг первый</p>
                    <p class="step-info">Авторизация/регистрация</p>
                </div>
                <div class="step-indicator active">
                    <div class="step-num">2</div>
                    <p class="step-name">Шаг второй</p>
                    <p class="step-info">Выбор способа доставки и оплаты</p>
                </div>
                <div class="step-indicator">
                    <div class="step-num">3</div>
                    <p class="step-name">Шаг третий</p>
                    <p class="step-info">Подтверждение заказа</p>
                </div>
            </div>
        </div>
        <div class="step-inner">
            <div class="content-wrapper">
                <div class="common-form delivery-type">
                    <form action="">
                        <div class="col12">
                            <p class="header">Выберите способ доставки</p>
                            <ul class="delivery-list">
                                <li class="delivery-list-item">
                                    <fieldset>
                                        <input type="radio" class="css-checkbox" checked="checked" name="delivery-type" id="delivery1" value="delivery1"/>
                                        <label class="cb-label" for="delivery1"><em>Самовывоз</em></label>
                                        <p class="delivery-meta"></p>
                                    </fieldset>
                                    <span>бесплатно</span>
                                </li>
                                <li class="delivery-list-item">
                                    <fieldset>
                                        <input type="radio" class="css-checkbox" name="delivery-type" id="delivery2" value="delivery2" data-toggle="1"/>
                                        <label class="cb-label" for="delivery2"><em>Курьером по Москве</em></label>
                                        <p class="delivery-meta">в пределах МКАД</p>
                                    </fieldset>
                                    <span>500 руб.</span>
                                </li>
                                <li class="js-toggle toggled">
                                    <fieldset>
                                        <label for="delivery-courier-address">Адрес</label>
                                        <textarea name="delivery-courier-address" id="delivery-courier-address"></textarea>
                                    </fieldset>
                                </li>
                                <li class="delivery-list-item">
                                    <fieldset>
                                        <input type="radio" class="css-checkbox" name="delivery-type" id="delivery3" value="delivery3" data-toggle="1"/>
                                        <label class="cb-label" for="delivery3"><em>Курьером по Москве и МО</em></label>
                                        <p class="delivery-meta">за пределами МКАД</p>
                                    </fieldset>
                                    <span>500 руб.&nbsp;+ 30&nbsp;руб./км<br/>за МКАД</span>
                                </li>
                                <li class="js-toggle toggled">
                                    <fieldset>
                                        <label for="delivery-mkad-city">Город</label>
                                        <select class="js-common-select mobile-hide" name="delivery-mkad-city" id="delivery-mkad-city" data-placeholder="Начните вводить название">
                                            <option value=""></option>
                                            <option value="1">Москва</option>
                                            <option value="2">Ульяновск</option>
                                            <option value="3">Краснодар</option>
                                        </select>
                                        <div class="mobile mobile-select-cnt">
                                            <select class="mobile" name="delivery-mkad-city" id="delivery-mkad-city-mobile">
                                                <option value="1">Москва</option>
                                                <option value="2">Ульяновск</option>
                                                <option value="3">Краснодар</option>
                                            </select>
                                            <i class="mobile-select-arrow"></i>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <label for="delivery-mkad-address">Адрес</label>
                                        <textarea name="delivery-mkad-address" id="delivery-mkad-address"></textarea>
                                    </fieldset>
                                </li>
                                <li class="delivery-list-item">
                                    <fieldset>
                                        <input type="radio" class="css-checkbox" name="delivery-type" id="delivery4" value="delivery4" data-toggle="1"/>
                                        <label class="cb-label" for="delivery4"><em>Транспортной компанией</em></label>
                                        <p class="delivery-meta"></p>
                                    </fieldset>
                                    <span>по тарифам ТК</span>
                                </li>
                                <li class="js-toggle toggled">
                                    <fieldset>
                                        <input type="radio" class="css-checkbox" name="tk-name" id="tk1" value="tk1"/>
                                        <label class="cb-label" for="tk1">Деловые линии</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="radio" class="css-checkbox" name="tk-name" id="tk2" value="tk2"/>
                                        <label class="cb-label" for="tk2">Первая экспедиционная компания</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="radio" class="css-checkbox" name="tk-name" id="tk3" value="tk3"/>
                                        <label class="cb-label" for="tk3">Байкал сервис</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="radio" class="css-checkbox" name="tk-name" id="tk4" value="tk4"/>
                                        <label class="cb-label" for="tk4">Автотрейдинг</label>
                                    </fieldset>
                                    <fieldset>
                                        <p>
                                            <input type="radio" class="css-checkbox" name="tk-name" id="tk5" value="tk5" rel="#tk-custom-name"/>
                                            <label class="cb-label" for="tk5">Другая компания</label>
                                        </p>
                                        <input type="text" name="tk-custom-name" id="tk-custom-name" disabled/>
                                    </fieldset>
                                </li>
                            </ul>
                            <a class="more-about-delivery" href="#">Подробнее о доставке и оплате</a>
                        </div>
                        <div class="col12">
                            <p class="header">Выберите способ оплаты</p>
                            <fieldset>
                                <input type="radio" class="css-checkbox" checked="checked" name="payment-type" id="payment1" value="payment1"/>
                                <label class="cb-label" for="payment1">Наличными при получении</label>
                                <p class="delivery-meta">Оплата при получении заказа наличными курьеру или в салоне при самовывозе</p>
                            </fieldset>
                            <fieldset>
                                <input type="radio" class="css-checkbox" name="payment-type" id="payment2" value="payment2"/>
                                <label class="cb-label" for="payment2">Оплата с помощью Робокасса</label>
                                <p class="delivery-meta">Оплата с помощью карт Visa, MasterCard, American Express и Maestro или электронными деньгами</p>
                            </fieldset>
                            <fieldset>
                                <input type="radio" class="css-checkbox" name="payment-type" id="payment3" value="payment3" rel="requisits"/>
                                <label class="cb-label" for="payment3">Безналичный расчет</label>
                                <p class="delivery-meta">После оформления заказа на указанный e-mail будет выслан счет, который можно будет оплатить в любом ближайшем банке.</p>
                            </fieldset>
                            <fieldset style="display: none;">
                                <label for="requisits">Загрузите файл с вашими реквизитам</label>
                                <input type="file" name="requisits" id="requisits"/>
                            </fieldset>
                            <a class="payment-comment-trigger js-payment-comment-trigger" href="#">Добавить комментарий</a>
                            <fieldset>
                                <textarea name="payment-comment" id="payment-comment"></textarea>
                            </fieldset>
                        </div>
                        <div class="step2-submit-cnt aright">
                            <input class="important" type="submit" value="Перейти к подтверждению заказа"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include('footer.php');
?>