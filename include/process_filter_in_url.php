<?php


class UrlFilter
{

    // Filter is always located in the last segment of url
    // Filter in url consist of two parts: filter name and filter value with symbol '-' between them
    // EXAMPLE: ../../color-red/


    //===============================
    // keeps correspondence between real filter name like "COLOR_BASE"
    // and its representation in url (for example, "color-base")
    private static $UrlFilterRules = Array(
        "brand" => "BRAND",
        "style" => "STYLE",
        "color" => "COLOR",
        "color-base" => "COLOR_BASE",
        "place" => "PLACE_MOUTING",
        "replica" => "REPLICA",
        "material" => "#SECTION_MATERIAL#"
    );

    public static function UrlToRealFilterName($urlFilterName, $sectionCode)
    {
        if ($urlFilterName=="material")
        {
            switch ($sectionCode) {
                case 'svetilniki':
                    return "SVET_MATERIAL";
                    break;
                case 'mebel':
                    return "MEBEL_MATERIAL";
                    break;
                case 'predmety-interera':
                    return "INTERIER_MATERIAL";
                    break;
                default:
                    return false;
                    break;
            }
        }

        return self::$UrlFilterRules[$urlFilterName];
    }

    public static function RealToUrlFiltername($realFilterName)
    {
        if (stripos($realFilterName,"MATERIAL")!==false)
            return "material";

        return array_flip(self::$UrlFilterRules)[$realFilterName];
    }
    //==========================

    public static function ConvertToUrlForm($propName, $propValue)
    {
        if (CModule::IncludeModule("iblock")) {
            // check if infoblock contains conversion
            $arSelect = Array("ID", "NAME","CODE", "PROPERTY_CATEGORY");
            $arFilter = Array("IBLOCK_ID"=>37, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_CATEGORY_VALUE"=>$propName, "NAME"=>$propValue);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            $ob = $res->GetNext();
            if ($ob)
                return $ob["CODE"];

            // if no, make convertion and add to infoblock
            $urlForm = CUtil::translit($propValue,"ru", array("replace_space"=>"-","replace_other"=>"-"));
            $el = new CIBlockElement;
            $res = $el->Add(array(
                "IBLOCK_ID"=>37,
                "NAME"=>$propValue,
                "CODE"=>$urlForm,
                "PROPERTY_VALUES"=>array("CATEGORY"=>$propName)
            ));
            return $urlForm;
        }
    }

    public static function ConvertFromUrlForm($propName, $propUrlForm)
    {
        if (CModule::IncludeModule("iblock")) {
            // check if infoblock contains conversion
            $arSelect = Array("ID", "NAME", "CODE", "PROPERTY_CATEGORY");
            $arFilter = Array("IBLOCK_ID" => 37, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_CATEGORY_VALUE" => $propName, "CODE" => $propUrlForm);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            $ob = $res->GetNext();
            if ($ob)
                return $ob["NAME"];
            AddMessage2Log("No conversion for value $propUrlForm of property $propName!");
        }
    }



    private static $filter = false;
    public static function GetFilter($sectionCode)
    {

        $filterMod = self::$filter;

        if ($filterMod === false)
            return false;

        if ($filterMod && strpos($filterMod['name'],"#SECTION_MATERIAL#") === 0)
        {
            switch ($sectionCode) {
                case 'svetilniki':
                    $filterMod['name'] = "SVET_MATERIAL";
                    break;
                case 'mebel':
                    $filterMod['name'] = "MEBEL_MATERIAL";
                    break;
                case 'predmety-interera':
                    $filterMod['name'] = "INTERIER_MATERIAL";
                    break;
                default:
                    $filterMod['name'] = "";
                    break;
            }

        }
        $filterMod['query-name'] = "PROPERTY_" . $filterMod["name"] . "_VALUE";
        $filterMod['value'] = self::ConvertFromUrlForm($filterMod['name'],$filterMod['url-value']);
        return $filterMod;
    }

    public static function ProcessFilterInRequestURI()
    {
        self::$filter = self::ProcessFilterInUrl($_SERVER["REQUEST_URI"]);

        if (self::$filter)
        {
            // change REQUEST_URI

            //$filterQuery = self::$filter['name'] . '=' . self::$filter['value'];
            //if (!empty($_SERVER["QUERY_STRING"]))
                //$filterQuery = "&" . $filterQuery;
            //$_SERVER["QUERY_STRING"] = $_SERVER["QUERY_STRING"] . $filterQuery;
            $_SERVER["REQUEST_URI"] = self::$filter["base-url"].'?'.$_SERVER["QUERY_STRING"];
        }
    }
    /**
     * Checks if there filter expression in url.
     * It is supposed that filter is located in the last segment of url.
     * $UrlFilter array is used to detect if last segment is filter expression.
     * @param $url
     * @return filter name, url form of filter value and
     * base url (url without query string and filter expression portion)
     * or false if there is no filter expression
     */
    public static function ProcessFilterInUrl($url)
    {
        //==Get last segment==
        // remove query string portion
        list($url,$query) = explode("?",$url);
        // remove last "/" if exists
        $url = rtrim($url, "/");

        $chunks = explode("/", $url);
        $lastSegment = current(array_slice($chunks, -1));

        // remove filter portion from url
        //if (!empty($query)) $query="?".$query;
        $urlWithoutFilterExpr = substr($url,0,strrpos($url,'/')+1);//.$query;

        foreach (self::$UrlFilterRules as $key => $value) {
            // if $key=brand the $lastSegment must start with 'brand-'
            if (strpos($lastSegment, $key."-") === 0) {
                // last segment contains filter expression
                // so to get value we need to cut off count($key)+1 symbols from beginning
                $value = substr($lastSegment, strlen($key) + 1);
                return Array("name" => self::$UrlFilterRules[$key], "url-value" => urldecode($value), "base-url" => $urlWithoutFilterExpr);
            }
        }

        return false;
    }

    public static function AddFilterExpressionToUrl($realFilterName, $filterValue, $url)
    {
        // remove current filter expression if it is presented
        $filter = self::ProcessFilterInUrl($url);
        list(,$query)= explode("?",$url);
        if (!empty($query)) $query = '?'.$query;

        return $filter["base-url"].'/'.self::RealToUrlFiltername($realFilterName).'-'
            .self::ConvertToUrlForm($realFilterName, $filterValue).'/'.$query;
    }

    public static function RemoveFilterExpressionFromUrl($url)
    {
        $filter = self::ProcessFilterInUrl($url);
        list(,$query)= explode("?",$url);
        if (!empty($query)) $query = '?'.$query;
        return $filter["base-url"].$query;
    }

    public static function GetUrlFilterExpression($realFilterName,$filterValue)
    {
        //AddMessage2Log($realFilterName);
        return self::RealToUrlFiltername($realFilterName).'-'
            .self::ConvertToUrlForm($realFilterName, $filterValue);
    }

}