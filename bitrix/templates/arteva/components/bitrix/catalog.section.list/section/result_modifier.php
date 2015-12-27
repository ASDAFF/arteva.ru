<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$sectionId = $arResult["SECTION"]["ID"];
$iblockId =$arParams["IBLOCK_ID"];
$arFilter = Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$iblockId);
$propFilter = $GLOBALS[$arParams["FILTER_NAME"]];
$properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), $arFilter);

require_once($_SERVER["DOCUMENT_ROOT"]."/include/section_props.php");

AddMessage2Log($propFilter);
$nonEmptyPropsValues = GetNonEmptyPropsValues($iblockId, $sectionId, array_merge($arFilter,$propFilter));

// count($GLOBALS[$arParams["FILTER_NAME"]]) can be 0 or 1
if (count($propFilter)>0) {
    // if filter by some property is set, then
    // we should reset that filter to retrieve nonempty values of that prop
    foreach ($propFilter as $key => $value) {
        // we use foreach despite of the fact that $GLOBALS[$arParams["FILTER_NAME"]] can
        // have at most 1 element because it is the one the fastest ways to get key and value

        // get prop code
        $start = strpos($key, '_')+1;
        $end = strrpos($key,'_');
        $propCode = substr($key, $start, $end-$start);


        $valuesOfPropWithFilter = GetNonEmptyValuesForProp($iblockId, $sectionId, $propCode);
        //AddMessage2Log($nonEmptyPropsValues);
        //$nonEmptyPropsValues[$propCode] = array_merge($nonEmptyPropsValues[$propCode],$valuesOfPropWithFilter[$propCode]);
        $nonEmptyPropsValues[$propCode] = $valuesOfPropWithFilter[$propCode];
        AddMessage2Log($nonEmptyPropsValues);
    }
}

while ($prop_fields = $properties->GetNext())
{
    if ($prop_fields["PROPERTY_TYPE"] == "L"):
        $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$iblockId, "CODE"=>$prop_fields["CODE"]));
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
//AddMessage2Log($arProperties);

?>