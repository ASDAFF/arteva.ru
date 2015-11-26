<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <?
        $APPLICATION->ShowPanel();
        $curpage = $APPLICATION->GetCurPage();
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?$APPLICATION->ShowHead();?>
	<title><?$APPLICATION->ShowTitle()?></title>
    <meta name="viewport" content="width=device-width">
    <meta name="cmsmagazine" content="9fd15f69c95385763dcf768ea3b67e22" />
    <link rel="canonical" href="<?='http://'.$_SERVER['SERVER_NAME'].$curpage?>"
    <?
        $elCode = "";
        if ($_REQUEST["ELEMENT_CODE"] && findElements($_REQUEST["ELEMENT_CODE"], 17)):
            $elCode = $_REQUEST["ELEMENT_CODE"];
        elseif ($_REQUEST["CODE"]):
            if (findElements($_REQUEST["CODE"], 17)):
                $elCode = $_REQUEST["CODE"];
            endif;
        endif;
    ?>
    <?if ($elCode && $arOgItem = ogItem($elCode)):?>
        <meta property="og:url" content="http://<?=$_SERVER["HTTP_HOST"].$curpage?>" />
        <meta property="og:site_name" content="Arteva Home" />
        <meta property="og:title" content="<?=htmlspecialchars($arOgItem["NAME"])." (".htmlspecialchars($arOgItem["PROPERTY_ARTIKUL_VALUE"]).")"?>" />
        <?if ($arOgItem["DETAIL_TEXT"]) {
            $descr = htmlspecialchars($arOgItem["~DETAIL_TEXT"]);
        } else {
            $descr = htmlspecialchars($arOgItem["~PROPERTY_OPIS_VALUE"]);
        }
        $descr = str_replace("&lt;BR&gt;", "", $descr);
        ?>
        <meta property="og:description" content="<?=$descr?>" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="http://<?=$_SERVER["HTTP_HOST"].CFile::GetPath($arOgItem["~PREVIEW_PICTURE"])?>" />
    <?endif?>
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="stylesheet" href="/css/plugins/jquery.fancybox3.css"/>
    <link rel="stylesheet" href="/css/plugins/jquery.fancybox-thumbs.css"/>
    <link rel="stylesheet" href="/css/plugins/coin-slider-styles.css"/>
    <link rel="stylesheet" href="/css/plugins/idangerous.swiper.css"/>
    <link rel="stylesheet" href="/css/plugins/chosen.min.css"/>
    <link rel="stylesheet" href="/css/plugins/jquery.nouislider.min.css"/>
    <link rel="stylesheet" href="/css/plugins/jquery.mCustomScrollbar.css"/>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/custom.css">
    <script>
        if (navigator.userAgent.match(/IEMobile/)) {
            var msViewportStyle = document.createElement("style");
            msViewportStyle.appendChild(
                document.createTextNode(
                    "@-ms-viewport{width:640px!important}"
                )
            );
            document.getElementsByTagName("head")[0].
                appendChild(msViewportStyle);
        }
    </script>

    <script src="/js/addons/modernizr-2.6.2.min.js"></script>
    <script src="/js/libs/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAvQSpv4GNTxToru5eLi-iQ16oGp9-XapE&sensor=true"></script> 
    <!--[if lt IE 9]> 
    <script>
        document.createElement('main');
        document.createElement('picture');
    </script>
    <![endif]-->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-46203144-1', 'auto');
        ga('require', 'displayfeatures');
        ga('require', 'linkid', 'linkid.js');
        ga('send', 'pageview');
    </script>
	<script>
		   var rrPartnerId = "564c6a1a6c7d3d3d38a70c5d";
		   var rrApi = {}; 
		   var rrApiOnReady = rrApiOnReady || [];
		   rrApi.addToBasket = rrApi.order = rrApi.categoryView = rrApi.view = 
			   rrApi.recomMouseDown = rrApi.recomAddToCart = function() {};
		   (function(d) {
			   var ref = d.getElementsByTagName('script')[0];
			   var apiJs, apiJsId = 'rrApi-jssdk';
			   if (d.getElementById(apiJsId)) return;
			   apiJs = d.createElement('script');
			   apiJs.id = apiJsId;
			   apiJs.async = true;
			   apiJs.src = "//cdn.retailrocket.ru/content/javascript/api.js";
			   ref.parentNode.insertBefore(apiJs, ref);
		   }(document));
	</script>
	
    <script src="/js/init.js"></script>
</head>
<body>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {(w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter23092420 = new Ya.Metrika({id:23092420,
                webvisor:true,
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true,
                trackHash:true,
ecommerce:"dataLayer"});
        } catch(e) { }
    });
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";
        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/23092420" style="position:absolute; left:-9999px;"
                    alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<?
    $arLink = explode("/", $curpage);
    if ($curpage == "/"):
        $curprefix = "index-";
        $active = "";
    elseif ($curpage == "/payment-and-shipping/"):
        $payactive = "active";
    elseif ($curpage == "/salons/" || $arLink[1] == "salons"):
        $slonsactive = "active";
    elseif ($curpage == "/wishlist/"):
        $favactive = "active";
    elseif ($curpage == "/personal/" || $arLink[1] == "personal"):
        $peractive = "active";
    else:
        $active = "";
    endif;
?>
<?if ($_GET["action"] == "unsubscribe" && $_GET["CONFIRM_CODE"] && $_GET["ID"]):
    if (unsubscribeUser($_GET)):
        $messageHeader = "Успешно";
        $messageUnsubscribe = "Вы успешно отписались от рассылки";
    else:
        $messageHeader = "Ошибка";
        $messageUnsubscribe = "Подписка не найдена";
    endif;?>
    <script type="text/javascript"> 
        $(window).load(function(){
            $.fancybox({
                content:'<p class="popup-header"><?=$messageHeader?></p><div class="text-content"><p><?=$messageUnsubscribe?></p></div><div class="acenter"><a class="btn js-fbx-close" href="#">Закрыть</a></div>',
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
<?endif?>
<?
    $countFavorites = (is_array(getFavoriteItemsId($USER->GetID()))) ? count(getFavoriteItemsId($USER->GetID())) : 0;
?>
<div id="root-wrapper">
    <div class="overlay"></div>
    <div id="site-wrapper">
        <!-- Для адаптивной версии -->
        <div class="mobile-menu-wrapper">
            <div class="mobile-menu-cnt">
                <a class="close-mobile-menu js-close-menu" href="#"></a>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:search.form",
                    "search",
                    Array(),
                    false
                );?>
                <div class="phones-cnt">
                    <?php include($_SERVER["DOCUMENT_ROOT"]."/include/phone_header.php");?>
                    <!-- p><a class="fancy-popup" href="#callback-form" onclick="ga('send', 'event', 'call-me-please-form', 'open'); return true;">Прошу перезвонить</a></p -->
					<p class="head-mail">по России бесплатно</p>
                </div>
		<p class="head-mail-mobile"><a href="mailto:info@arteva.ru">info@arteva.ru</a></p>
                <div class="mobile-top-links">
                    <a href="/payment-and-shipping/" class="<?=$payactive?>">Оплата и доставка</a>
                    <a href="/salons/" class="<?=$slonsactive?>">Купить в салоне</a>
                </div>
                <div class="mobile-top-nav">
                    <ul class="top-nav-list">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:catalog.section.list",
                            "menu_mob",
                            Array(
                                "IBLOCK_TYPE" => "catalog",
                                "IBLOCK_ID" => 17,
                                "SECTION_ID" => "",
                                "SECTION_CODE" => "",
                                "SECTION_URL" => "",
                                "COUNT_ELEMENTS" => "Y",
                                "TOP_DEPTH" => "1",
                                "SECTION_FIELDS" => array("DESCRIPTION", "PICTURE"),
                                "SECTION_USER_FIELDS" => array(""),
                                "ADD_SECTIONS_CHAIN" => "Y",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "",
                                "CACHE_GROUPS" => "Y"
                            ),
                        false
                        );?>
                    </ul>
                </div>
                <div class="mobile-top-user">
                    <a class="iconic icon-fav <?=$favactive?>" href="/personal/wishlist/">Избранное (<span class="js-favotites-count"><?=$countFavorites?></span>)</a>
                    <?if ($USER->isAuthorized()):?>
                        <a class="iconic icon-user <?=$peractive?>" href="/personal/"><?=$USER->GetFullName()?>/<?=$USER->GetEMAIL()?></a>
                        <a class="iconic icon-logout" href="?logout=yes">Выйти</a>
                    <?else:?>
                        <a class="iconic icon-user" href="/auth/">Войти</a>
                    <?endif?>
                    <a class="iconic icon-cart" href="/personal/cart/">Корзина</a>
                </div>
            </div>
        </div>
        <!-- Для адаптивной версии -->
        <div class="top-search-cnt">
            <div class="<?=$curprefix?>content-wrapper">
                <a class="close-top-search js-close-search" href="#">Закрыть</a>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:search.form",
                    "search",
                    Array(),
                    false
                );?>
            </div>
        </div>
        <div class="site-header">
            <div class="top-cnt">
            <div class="top-row">
                <div class="<?=$curprefix?>content-wrapper">
                    <div class="top-links fleft">
                        <a href="/payment-and-shipping/" class="<?=$payactive?>">Оплата и доставка</a>
                        <a href="/salons/" class="<?=$slonsactive?>">Купить в салоне</a>
                    </div>
                    <div class="top-user fright">
                        <a class="iconic icon-fav <?=$favactive?>" href="/personal/wishlist/">Избранное (<span class="js-favotites-count"><?=$countFavorites?></span>)</a>
                        <?if ($USER->isAuthorized()):?>
                            <a class="iconic icon-user <?=$peractive?>" href="/personal/"><?=$USER->GetFullName()?>/<?=$USER->GetEMAIL()?></a>
                            <a class="iconic icon-logout" href="?logout=yes">Выйти</a>
                        <?else:?>
                            <a class="iconic icon-user fancy-popup" href="#auth-form">Войти</a>
                        <?endif?>
                    </div>
                </div>
            </div>
            <div class="fix-header">
                <div class="fix-top">
                    <div class="<?=$curprefix?>content-wrapper">
                        <div class="phone-cnt">
                            <p class="phone">8 (800) 775-40-48</p>
                            <p class="meta">Бесплатно по России</p>
                            <!--a class="fancy-popup" href="#callback-form" onclick="ga('send', 'event', 'call-me-please-form', 'open'); return true;">Прошу перезвонить</a-->
							<p class="head-mail">по России бесплатно</p>
                        </div>
                        <div class="phone-cnt">
                            <p class="phone">8 (495) 255-21-51</p>
                            <p class="meta">телефон в москве</p>
							<p class="head-mail"><a href="mailto:info@arteva.ru">info@arteva.ru</a></p>
                        </div>
                        <div class="top-cart-btn">
                            <a class="<?if ($curpage != "/personal/cart/"):?>js-cart-trigger<?endif?>" data-overlay="cart" <?if ($curpage != "/personal/cart/"):?>href="/personal/cart/"<?endif;?> onclick="ga('send', 'event', 'cart', 'open'); return true;">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:sale.basket.basket.small",
                                    "header_cart",
                                    Array(
                                        "PATH_TO_BASKET" => "/personal/cart/",
                                        "PATH_TO_ORDER" => "/personal/order/make/",
                                        "SHOW_DELAY" => "Y",
                                        "SHOW_NOTAVAIL" => "Y",
                                        "SHOW_SUBSCRIBE" => "Y"
                                    )
                                );?>
                            </a>
                        </div>
                        <div class="mobile-menu">
                            <a class="js-mobile-menu-trigger" data-overlay="mobile-menu" href="#"></a>
                        </div>
                        <?if ($curpage == "/"):?>
                            <div class="logo"><img src="/img/logo.png" alt="logo" class="print-show"/></div>
                        <?else:?>
                            <a class="logo" href="/"><img src="/img/logo.png" alt="logo" class="print-show"/></a>
                        <?endif?>
                    </div>
                </div>
            </div>
            </div>
            <div class="top-nav">
                <div class="<?=$curprefix?>content-wrapper acenter">
                    <ul class="top-nav-list">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:catalog.section.list",
                            "menu",
                            Array(
                                "IBLOCK_TYPE" => "catalog",
                                "IBLOCK_ID" => 17,
                                "SECTION_ID" => "",
                                "SECTION_CODE" => "",
                                "SECTION_URL" => "",
                                "COUNT_ELEMENTS" => "Y",
                                "TOP_DEPTH" => "2",
                                "SECTION_FIELDS" => array("DESCRIPTION", "PICTURE"),
                                "SECTION_USER_FIELDS" => array(
									0 => "UF_GOTO_LINK" ),
                                "ADD_SECTIONS_CHAIN" => "Y",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "",
                                "CACHE_GROUPS" => "Y"
                            ),
                        false
                        );?>
                    </ul>
                    <a class="search-trigger js-search-trigger" data-overlay="search" href="#"></a>
                </div>
            </div>
        </div>
		
		<?if ($curpage != "/"){?>
			<div class="fx_mb"></div>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"warning_main",
				Array(
					"IBLOCK_TYPE" => "main",
					"IBLOCK_ID" => "26",
					"NEWS_COUNT" => "1",
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"SORT_BY2" => "ACTIVE_FROM",
					"SORT_ORDER2" => "DESC",
					"FILTER_NAME" => "",
					"FIELD_CODE" => array("NAME","PREVIEW_TEXT","PREVIEW_PICTURE","DETAIL_TEXT","DETAIL_PICTURE","DATE_ACTIVE_FROM",""),
					"PROPERTY_CODE" => array(""),
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "3600000",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "Y",
					"PREVIEW_TRUNCATE_LEN" => "",
					"ACTIVE_DATE_FORMAT" => "d.M.Y",
					"SET_STATUS_404" => "Y",
					"SET_TITLE" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "Y",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"INCLUDE_SUBSECTIONS" => "Y",
					"DISPLAY_DATE" => "Y",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "Y",
					"PAGER_TEMPLATE" => "page",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"PAGER_TITLE" => "Новости",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
					"PAGER_SHOW_ALL" => "N"
				)
			);
		}?>