<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//delayed function must return a string
if(empty($arResult))
	return "";

//test_dump($arResult);

$strReturn = '<ul vocab="http://schema.org/" typeof="BreadcrumbList" class="breadcrumbs">';

for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{
//	if($index > 0)
//		$strReturn .= '&nbsp;&gt;&nbsp;';
//	test_dump($arResult[$index]);
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
//	test_dump($arResult[$index]["TITLE"]);

	if($arResult[$index]["LINK"] <> "" && $index < (count($arResult) - 1))
		$strReturn .= '<li class="bc-item" property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" href="'.$arResult[$index]["LINK"].'" title="'.$title.'"><span property="name">'.$title.'</span></a> <meta property="position" content="'.($index+1).'"></li>';
	else
		$strReturn .= '<li class="bc-item"><a property="item" typeof="WebPage"><span property="name">'.$title.'</span></a><meta property="position" content="'.($index+1).'"></li>';
}

$strReturn .= '</ul>';
//return $strReturn;
echo $strReturn;
?>