<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
// seo страницы
$arSelect = Array("ID", "NAME", "CODE", "PREVIEW_TEXT", "PREVIEW_PICTURE");
$arFilter = Array("IBLOCK_ID"=>22, "ACTIVE"=>"Y", "PROPERTY_SECTIONS" => $arResult["ID"]);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
	$seo_items = $ob->GetFields();
	$arSeoCode[] = $seo_items["CODE"];
	$arSeoPage[] = $seo_items;
}
$arResult["SEO_PAGES"] = $arSeoPage;
$arResult["SEO_PAGE_CODE"] = $arSeoCode;
// добавляем хлебную крошку и вытаскиваем продукты
foreach ($arResult["SEO_PAGES"] as $key => $arSeo) :
	if ($_REQUEST["page"] == $arSeo["CODE"]):
		$navChain = $arSeo;
		$arResult["CUR_SEO_PAGE"] = $arSeo;
		$arResult["SEO_PRODUCTS"] = getSeoProducts($arSeo);
		break;
	endif;
endforeach;
if ($arResult["SEO_PRODUCTS"]):
	$arResult["PATH"][] = $navChain;
endif;
//echo "<pre>";print_r($arResult["PATH"]);echo "</pre>";
?>