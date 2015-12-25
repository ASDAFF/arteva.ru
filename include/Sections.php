<?php
/**
 * Created by PhpStorm.
 * User: Rasul
 * Date: 24.12.2015
 * Time: 20:49
 */

//namespace IntSys;


class Sections
{
    /**
     * @param array $arFilter
     * Required keys are IBLOCK_ID and SECTION_ID.
     * It can contain key PROPERTY with array value of
     * property name and value pairs.
     * Example: Array("IBLOCK_ID" => 17, "SECTION_ID" => 687,
     * "PROPERTY" => Array("BRAND" => Array(41522, 41523, 41524)))
     * @return array
     */
    public static function GetNonEmpty($arFilter)
    {
        if (CModule::IncludeModule('iblock')) {
            $arSelect = Array("IBLOCK_ID", "NAME", "SECTION_PAGE_URL", "PICTURE");
            //$arFilter = Array("IBLOCK_ID" => 17, "SECTION_ID" => 687, "PROPERTY" => Array("BRAND" => Array(41522, 41523, 41524)));

            $items = CIBlockSection::GetList(array("SORT" => "asc"), $arFilter, true, $arSelect);
            $sections = Array();
            while ($arSection = $items->GetNext()) {
                $sections[]=$arSection;
            }
            return $sections;
        }

    }

    /**
     * Returns non empty subsections of section with SECTION_ID in infoblock with IBLOCK_ID
     * @param array $arFilter Required keys are IBLOCK_ID and SECTION_ID
     * @return array
     */
    public static function GetNonEmpty2($arFilter)
    {
        // TODO sections with nonempty subsections
        if (CModule::IncludeModule('iblock')) {
            $arSelect = Array("IBLOCK_SECTION_ID");
            $arFilter = array_merge(Array("INCLUDE_SUBSECTIONS"=>"Y"), $arFilter);

            $items = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
            $sections = Array();

            while ($arSection = $items->GetNext())
            {
                $sections[]=$arSection["IBLOCK_SECTION_ID"];
            }

            $arSelect = Array("IBLOCK_ID", "NAME", "SECTION_PAGE_URL", "PICTURE");
            $arFilter = Array("IBLOCK_ID" => $arFilter["IBLOCK_ID"], "SECTION_ID"=>$arFilter["SECTION_ID"],"ID" => $sections);

            $items = CIBlockSection::GetList(array("SORT" => "asc"), $arFilter, false, $arSelect);
            $sections = Array();
            while ($arSection = $items->GetNext()) {
                $sections[]=$arSection;
            }
            return $sections;
        }
    }

    /**
     * Returns non empty subsections of section with SECTION_ID in infoblock with IBLOCK_ID
     * @param array $arFilter Required keys are IBLOCK_ID and SECTION_ID
     * @return array
     */
    public static function GetNonEmpty3($arFilter)
    {
        if (CModule::IncludeModule('iblock')) {
            $arSelect = Array("IBLOCK_ID", "NAME", "SECTION_PAGE_URL", "PICTURE");
            $arFilterSections = Array("IBLOCK_ID" => $arFilter["IBLOCK_ID"], "SECTION_ID"=>$arFilter["SECTION_ID"]);

            $sections = CIBlockSection::GetList(array("SORT" => "asc"), $arFilterSections, false, $arSelect);
            $arFilter = array_merge($arFilter, Array("INCLUDE_SUBSECTIONS"=>"Y"));
            $nonEmptySections = Array();
            while ($arSection = $sections->GetNext()) {
                $sectionId = $arSection['ID'];
                $arFilter['SECTION_ID'] = $sectionId;
                $count = CIBlockElement::GetList(array("SORT"=>"ASC"), $arFilter, array(), false, array());
                if ($count>0)
                    $nonEmptySections[]=$arSection;
            }
            return $nonEmptySections;
        }
    }

    /**
     * @param array $sections Each item should contain ID key
     * @param array $arFilter
     * @return array
     */
    public static function RemoveEmptySections($sections, $arFilter)
    {
        $arFilter = array_merge($arFilter, Array("INCLUDE_SUBSECTIONS"=>"Y"));
        $nonEmptySections = Array();
        foreach($sections as $arSection) {
            $sectionId = $arSection['ID'];
            $arFilter['SECTION_ID'] = $sectionId;
            $count = CIBlockElement::GetList(array("SORT"=>"ASC"), $arFilter, array(), false, array());
            if ($count>0)
                $nonEmptySections[]=$arSection;
        }
        return $nonEmptySections;
    }

    public static function GenerateMarkup($sections)
    {
        ob_start(); ?>
        <ul class="item-cards-list matrix categories">
            <?foreach ($sections as $key => $arSections) :?>
                <li class="item-card-item">
                    <a href="<?=$arSections["SECTION_PAGE_URL"]?>">
                        <div class="img-cnt">
                            <img src="/img/img_dummy.png" data-src="<?=CFIle::GetPath($arSections["~PICTURE"])?>" alt=""/></div>
                        <div class="item-info">
                            <p class="category"><?=$arSections["NAME"]?></p>
                        </div>
                    </a>
                </li>
            <?endforeach?>
        </ul>

        <?
        $html = ob_get_contents();
        ob_end_clean();
        return $html;

    }
}