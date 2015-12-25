<?
include_once($_SERVER['DOCUMENT_ROOT']."/include/trace.php");
include_once($_SERVER['DOCUMENT_ROOT']."/include/process_filter_in_url.php");


UrlFilter::ProcessFilterInRequest();


include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
if(file_exists($_SERVER['DOCUMENT_ROOT'].'/404.php'))
	include_once($_SERVER['DOCUMENT_ROOT'].'/404.php');
?>