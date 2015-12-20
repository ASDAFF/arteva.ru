<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

// свойства инфобока для фильтра
$arFilter = Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arResult["IBLOCK_ID"]);

$properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), $arFilter);

require($_SERVER["DOCUMENT_ROOT"]."/include/section_props.php");
//AddMessage2Log(array_merge($arFilter,$GLOBALS[$arParams["FILTER_NAME"]]));
$nonEmptyProps = GetNonEmptyPropsValues($arResult["IBLOCK_ID"], $arResult["ID"], array_merge($arFilter,$GLOBALS[$arParams["FILTER_NAME"]]));
//AddMessage2Log($arResult["IBLOCK_ID"]);
//AddMessage2Log($arResult["ID"]);
//AddMessage2Log($nonEmptyProps);

while ($prop_fields = $properties->GetNext())
{
	if ($prop_fields["PROPERTY_TYPE"] == "L"):
		$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$arResult["IBLOCK_ID"], "CODE"=>$prop_fields["CODE"]));
		while($enum_fields = $property_enums->GetNext())
		{
			//AddMessage2Log('PROPERTY_'.$enum_fields['PROPERTY_CODE'].'_VALUE');
			//AddMessage2Log();
			if (in_array('PROPERTY_'.$enum_fields['PROPERTY_CODE'].'_VALUE',array_keys($GLOBALS[$arParams["FILTER_NAME"]])) ||
			in_array($enum_fields["VALUE"], $nonEmptyProps[$enum_fields["PROPERTY_CODE"]]))
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
?>