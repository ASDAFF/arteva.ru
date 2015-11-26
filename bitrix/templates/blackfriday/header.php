<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?$APPLICATION->ShowHead();?>
	<title><?$APPLICATION->ShowTitle()?></title>
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
    <script src="/js/init.js"></script>
	
</head>
<body>
<?
	$APPLICATION->ShowPanel();
	$curpage = $APPLICATION->GetCurPage();
?>
<div class="mconteiner">
	<header>
		<div class="header_right">
			<a href="/" class="logo_a">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/logo.png">
			</a>
			<div class="head_phone"><span>+7 (495) 255-21-51</span></div>
			<div class="head_phone"><span>8 (800) 775-40-48</span></div>
			<a href="#feed_back" class="call_back_head">Закажите обратный звонок</a>
			<a href="/" class="site_href">Перейти на сайт</a>
			
		</div>
		<div class="action_date_head_line">
			<span>Акция действует с 26 по 29 ноября 2015. 4 дня тотальных распродаж!</span>
		</div>
	</header>
	<div class="mcontent">
