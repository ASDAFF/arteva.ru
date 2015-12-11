<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?$APPLICATION->ShowTitle()?></title>
    <?$APPLICATION->ShowHead();?>
    <meta name="viewport" content="width=device-width">
    <meta name="cmsmagazine" content="9fd15f69c95385763dcf768ea3b67e22" />
	<script src="/js/libs/jquery-1.11.1.min.js"></script>
	
	<link rel="stylesheet" href="/css/plugins/jquery.fancybox3.css"/>
    <link rel="stylesheet" href="/css/plugins/jquery.fancybox-thumbs.css"/>
	<script src="/js/plugins/fancybox3/jquery.fancybox.js"></script>
	<script src="/js/plugins/fancybox3/jquery.fancybox-thumbs.js"></script>
<?//    <link rel="stylesheet" href="/css/main.css"> ?>

    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/oldstyle.css">
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/style.css">
	
	
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

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter23092420 = new Ya.Metrika({
                    id:23092420,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true,
                    ecommerce:"dataLayer"
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/23092420" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


    <script src="/js/init.js"></script>
</head>
<body>
<?
	$APPLICATION->ShowPanel();
	$curpage = $APPLICATION->GetCurPage();
?>
<div class="mconteiner">
	<header>
		<div class="top_header_line">
			<a href="/" class="logo_a">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/logo.png">
			</a>
			<div class="header_right">
				<div class="head_phone"><span>+7 (495) 255-21-51</span></div>
				<div class="head_phone"><span>8 (800) 775-40-48</span></div>
				<a href="#feed_back" class="call_back_head">Закажите обратный звонок</a>			
			</div>
		</div>
		
		<div class="action_date_head_line">
			<span class="line_top_date">
			Экономия <span class="bef">от</span> <span class="sale_price">-30%</span> <span class="aft">до</span> <span class="sale_price">-75%</span> на подарки
			</span>
			<span class="desc">Arteva Home предлагает дизайнерские подарки на новый год. <br/>
Мебель и разнообразные светильники, всегда нужны и гармонично будут смотреться в современном интерьере.</span>
		</div>
	</header>
