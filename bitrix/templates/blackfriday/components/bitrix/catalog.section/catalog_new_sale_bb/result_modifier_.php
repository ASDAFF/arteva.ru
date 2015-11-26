<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
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

//echo "<pre>";print_r($arResult);echo "</pre>";
?>