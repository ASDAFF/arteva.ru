<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

// свойства инфобока для фильтра
$arFilter = Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arResult["IBLOCK_ID"]);
$propFilter = $GLOBALS[$arParams["FILTER_NAME"]];

$properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), $arFilter);

require($_SERVER["DOCUMENT_ROOT"]."/include/section_props.php");
$nonEmptyPropsValues = GetNonEmptyPropsValues($arResult["IBLOCK_ID"], $arResult["ID"], array_merge($arFilter,$propFilter));

// count($GLOBALS[$arParams["FILTER_NAME"]]) can be 0 or 1
if (count($propFilter)>0)
{
	// if filter by some property is set, then
	// we should reset that filter to retrieve nonempty values of that prop
	foreach($propFilter as $key => $value)
	{
		// we use foreach despite of the fact that $GLOBALS[$arParams["FILTER_NAME"]] can
		// have at most 1 element because it is the one the fastest ways to get key and value

		// get prop code
		$start = strpos($key, '_')+1;
		$end = strrpos($key,'_');
		$propCode = substr($key, $start, $end-$start);

		$valuesOfPropWithFilter = GetNonEmptyValuesForProp($arResult["IBLOCK_ID"], $arResult["ID"], $propCode);
		//AddMessage2Log($nonEmptyPropsValues);
		//$nonEmptyPropsValues[$propCode] = array_merge($nonEmptyPropsValues[$propCode],$valuesOfPropWithFilter[$propCode]);
		$nonEmptyPropsValues[$propCode]=$valuesOfPropWithFilter[$propCode];
		//AddMessage2Log($nonEmptyPropsValues);
	}
}


//AddMessage2Log($arFilter);
//AddMessage2Log($GLOBALS[$arParams["FILTER_NAME"]]);

while ($prop_fields = $properties->GetNext())
{
	if ($prop_fields["PROPERTY_TYPE"] == "L"):
		$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$arResult["IBLOCK_ID"], "CODE"=>$prop_fields["CODE"]));
		while($enum_fields = $property_enums->GetNext())
		{
			//AddMessage2Log('PROPERTY_'.$enum_fields['PROPERTY_CODE'].'_VALUE');
			//AddMessage2Log();
			if (in_array($enum_fields["VALUE"], $nonEmptyPropsValues[$enum_fields["PROPERTY_CODE"]]))
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