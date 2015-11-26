<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

// свойства инфобока для фильтра
$arFilter = Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arResult["IBLOCK_ID"]);
$properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), $arFilter);
while ($prop_fields = $properties->GetNext())
{
	if ($prop_fields["PROPERTY_TYPE"] == "L"):
		$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$arResult["IBLOCK_ID"], "CODE"=>$prop_fields["CODE"]));
		while($enum_fields = $property_enums->GetNext())
		{
		  	$prop_fields["ENUM_LIST"][] = $enum_fields;
		}
	endif;
	$arProperties[$prop_fields["CODE"]] = $prop_fields;
}
$arResult["PROPERTIES_IBLOCK"] = $arProperties;

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
//echo "<pre>";print_r($arResult);echo "</pre>";



$SUB_SECTION = array();
$SECTION_ID = (isset($_GET["SECTION"]))? $_GET["SECTION"] : 664 ;	
$arFilter = array('IBLOCK_ID' => 17, "ACTIVE" => "Y",  "DEPTH_LEVEL"  => 2, "SECTION_ID" => $SECTION_ID, );
$rsSections = CIBlockSection::GetList( array('id' => 'DESC'), $arFilter , false, array() );
while ($arSection = $rsSections->GetNext())
	$SUB_SECTION[] = $arSection;

$arResult["SUB_SECTION"] = $SUB_SECTION;
// PR($arResult["SUB_SECTION"]);
?>