<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
    $curpage = $APPLICATION->GetCurPage();
?>
        <div class="top-cart-cnt">
            <div class="top-cart">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:sale.basket.basket.small",
                    "footer_cart",
                    Array(
                        "PATH_TO_BASKET" => "/personal/cart/",
                        "PATH_TO_ORDER" => "/personal/order/make/",
                        "SHOW_DELAY" => "Y",
                        "SHOW_NOTAVAIL" => "Y",
                        "SHOW_SUBSCRIBE" => "Y"
                    )
                );?>
            </div>
        </div>
    </div>
    <div id="footer-struggle"></div>
</div>
<div id="footer">
    <div class="footer-nav-cnt">
        <div class="footer-wrapper">
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "bottom",
                Array(
                    "ROOT_MENU_TYPE" => "bottom",
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "bottom",
                    "USE_EXT" => "N",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_TIME" => "",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    "MENU_CACHE_GET_VARS" => array()
                )
            );?>
        </div>
    </div>
    <div class="footer-wrapper">
        <div class="bottom-right">
            <div class="footer-subscribe">
                <div class="subscribe-form-cnt">
                    <form action="">
                        <input type="text" name="email" placeholder="Подпишитесь на новости" data-parsley-required data-parsley-type="email"/>
                        <input type="hidden" name="action" value="add"/>
                        <input type="submit" value=""/>
                    </form>
                </div>
            </div>
            <div class="payments">
                <img src="/img/payments.png" alt="">
            </div>
        </div>
        <div class="bottom-right footer-contacts">
            <ul>
                <li>8-495-255-51-21</li>
                <li>8-800-775-40-48</li>
                <li><a href="mailto:info@arteva.ru">info@arteva.ru</a></li>
            </ul>
            <!-- <div class="social-links">
                <a href="#" class="fb"></a>
                <a href="#" class="ok"></a>
                <a href="#" class="vk"></a>
            </div> -->
        </div>
        <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.section.list",
            "bottom_menu",
            Array(
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => "17",
                "SECTION_ID" => "",
                "SECTION_CODE" => "",
                "SECTION_URL" => "",
                "COUNT_ELEMENTS" => "Y",
                "TOP_DEPTH" => "2",
                "SECTION_FIELDS" => array("DESCRIPTION", "PICTURE", "DETAIL_PICTURE"),
                "SECTION_USER_FIELDS" => array(),
                "ADD_SECTIONS_CHAIN" => "Y",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "3600",
                "CACHE_GROUPS" => "Y"
            ),
        false
        );?>
        <div class="copyrights">© <?=date("Y")?> Arteva</div>
    </div>
</div>
<div class="fbx-content callback-form-cnt common-form" id="callback-form">
    <?$APPLICATION->IncludeComponent(
        "bitrix:form.result.new",
        "feedback",
        Array(
            "SEF_MODE" => "N",
            "WEB_FORM_ID" => "1",
            "LIST_URL" => "",
            "EDIT_URL" => "",
            "SUCCESS_URL" => "",
            "CHAIN_ITEM_TEXT" => "",
            "CHAIN_ITEM_LINK" => "",
            "IGNORE_CUSTOM_TEMPLATE" => "N",
            "USE_EXTENDED_ERRORS" => "Y",
            "CACHE_TYPE" => "N",
            "CACHE_TIME" => "0",
            "VARIABLE_ALIASES" => Array(
            )
        ),
        false
    );?>
</div>
<?if (!$USER->isAuthorized()):?>
    <div class="fbx-content auth-form-cnt common-form" id="auth-form">
        <p class="popup-header">Войти на сайт</p>
        <?$APPLICATION->IncludeComponent(
            "bitrix:system.auth.form",
            "auth_popup",
            Array(
                "REGISTER_URL" => "/registration/",
                "FORGOT_PASSWORD_URL" => "/forgot-password/",
                "PROFILE_URL" => "/repsonal/",
                "SHOW_ERRORS" => "Y" 
                )
        );?>
    </div>
<?endif?>

<script src="/js/addons/device.min.js"></script>
<script src="/js/addons/picturefill.min.js"></script>
<script src="/js/addons/doubletaptogo.min.js"></script>
<script src="/js/plugins/unveil/jquery.unveil.js"></script>
<script src="/js/plugins/bxslider/jquery.bxslider.min.js"></script>
<script src="/js/plugins/swiper/idangerous.swiper.min.js"></script>
<script src="/js/plugins/swiper/idangerous.swiper.progress.min.js"></script>
<script src="/js/plugins/scrollbar/jquery.mCustomScrollbar.min.js"></script>
<script src="/js/plugins/coinslider/coin-slider.min.js"></script>
<script src="/js/plugins/fancybox3/jquery.fancybox.js"></script>
<script src="/js/plugins/fancybox3/jquery.fancybox-thumbs.js"></script>
<script src="/js/plugins/parsley/parsley.min.js"></script>
<script src="/js/plugins/parsley/i18n/ru.js"></script>
<script src="/js/plugins/maskedinput/jquery.maskedinput.js"></script>
<script src="/js/plugins/backgroundcheck/background-check.min.js"></script>
<script src="/js/plugins/chosen/chosen.jquery.min.js"></script>
<script src="/js/plugins/nouislider/jquery.nouislider.all.min.js"></script>
<script src="/js/plugins/zoom/zoomsl-3.0.min.js"></script>
<script src="/js/support.js"></script>
<script src="/js/main.js"></script>
 


<script type="text/javascript">
    (function (w, d) {
        try {
            var el = 'getElementsByTagName', rs = 'readyState';
            if (d[rs] !== 'interactive' && d[rs] !== 'complete') {
                var c = arguments.callee;
                return setTimeout(function () { c(w, d) }, 100);
            }
            var s = d.createElement('script');
            s.type = 'text/javascript';
            s.async = s.defer = true;
            s.src = '//aprtx.com/code/arteva/';
            var p = d[el]('body')[0] || d[el]('head')[0];
            if (p) p.appendChild(s);
        } catch (x) { if (w.console) w.console.log(x); }
    })(window, document);
	
		console.log(window.APRT_DATA)
</script>

</body>
</html>
