<?php
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

/**
 * Get all props values for each of which there is at least one element
 * (i.e. filter by such property value would return non empty list).
 * This function takes into account current filter ($arFilter argument)
 * @param $iblockId
 * @param $sectionId
 * @return array
 */
function GetNonEmptyPropsValues($iblockId, $sectionId, $arFilter = Array())
{
    if (CModule::IncludeModule("iblock")) {
        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_*");
        $arFilter = array_merge(
            Array(
                "IBLOCK_ID" => IntVal($iblockId),
                "SECTION_ID" => $sectionId,
                "INCLUDE_SUBSECTIONS" => "Y",
                "ACTIVE_DATE" => "Y",
                "ACTIVE" => "Y"),
            $arFilter
        );

        // Get all elements from given section and collect all properties and their values
        $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
        $props = Array();
        while ($ob = $res->GetNextElement()) {
            $arProps = $ob->GetProperties();
            foreach($arProps as $code=>$prop)
            {
                if ($prop["PROPERTY_TYPE"]=='L' && $prop['VALUE'] !== false)
                {
                    if ($props[$code] == null)
                        $props[$code] = Array();
                    if ($prop["MULTIPLE"]=='Y')
                        $props[$code] = array_merge($props[$code], $prop["VALUE"]);
                    else
                        $props[$code][] = $prop["VALUE"];
                }
            }
            //print_r($arProps);
        }


        foreach($props as $code=>$vals)
            $props[$code] = array_values(array_unique($props[$code]));

        return $props;
    }
}


/**
 * Get all values for current property that with conditions (set by $arFilter) on other properties
 * would return non empty list
 * @param $iblockId
 * @param $sectionId
 * @param $propCode
 * @param array $arFilter
 * @return array
 */
function GetNonEmptyValuesForProp($iblockId, $sectionId, $propCode, $arFilter = Array())
{
    if (CModule::IncludeModule("iblock")) {
        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_".$propCode);
        // exclude filter condition on property which values we want to find
        unset($arFilter["PROPERTY_".$propCode."_VALUE"]);
        $arFilter = array_merge(
            Array(
                "IBLOCK_ID" => IntVal($iblockId),
                "SECTION_ID" => $sectionId,
                "INCLUDE_SUBSECTIONS" => "Y",
                "ACTIVE_DATE" => "Y",
                "ACTIVE" => "Y"),
            $arFilter
        );

        // Get all elements from given section and collect all properties and their values
        $res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
        $props = Array();
        $props[$propCode] = Array();
        while ($ob = $res->GetNextElement()) {
// additional request
//            $arProp = $ob->GetProperty($propCode);
//            if ($arProp["MULTIPLE"]=='Y')
//                $props[$propCode] = array_merge($props[$propCode], $arProp["VALUE"]);
//            else
//                $props[$propCode][] = $arProp["VALUE"];
            //AddMessage2Log($ob);
            $propValue = $ob->GetFields()["PROPERTY_".$propCode."_VALUE"];
            if (is_array($propValue))
                $props[$propCode] = array_merge($props[$propCode], $propValue);
            else
                $props[$propCode][] = $propValue;
        }

        $props[$propCode] = array_values(array_unique($props[$propCode]));

        return $props;
    }
}

function GetNonEmptyValuesForProps($iblockId, $sectionId, $propsCodes, $arFilter = Array())
{
    $props = Array();
    foreach($propsCodes as $propCode)
    {
        $props = array_merge($props,
            GetNonEmptyValuesForProp($iblockId,$sectionId,$propCode, $arFilter));
    }
    return $props;
}

