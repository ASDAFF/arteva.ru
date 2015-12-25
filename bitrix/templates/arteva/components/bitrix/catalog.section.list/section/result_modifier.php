<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$sectionId = $arResult["SECTION"]["ID"];
$iblockId =$arParams["IBLOCK_ID"];
$arFilter = Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$iblockId);

$properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), $arFilter);

require_once($_SERVER["DOCUMENT_ROOT"]."/include/section_props.php");
//AddMessage2Log($GLOBALS[$arParams["FILTER_NAME"]]);
$nonEmptyProps = GetNonEmptyPropsValues($iblockId, $sectionId, array_merge($arFilter,$GLOBALS[$arParams["FILTER_NAME"]]));

while ($prop_fields = $properties->GetNext())
{
    if ($prop_fields["PROPERTY_TYPE"] == "L"):
        $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblockId, "CODE"=>$prop_fields["CODE"]));
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
//AddMessage2Log($arProperties);

?>