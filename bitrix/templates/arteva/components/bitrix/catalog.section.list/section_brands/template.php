<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$CURRENT_BRAND = GetBrandByXmlId($arResult["BRAND"]);
//test_dump($CURRENT_BRAND);
$list = CIBlockSection::GetList(
    array(),
    array(
        "IBLOCK_ID" => "17",
        "DEPTH_LEVEL" => "2"
    )
);
$list_subsections = array();
while ($i = $list -> Fetch()) {
    $list_subsections[] = $i;
}
$list_subsections_filtered = array();
foreach ($list_subsections as $l) {
    $elements = CIBlockElement::GetList(
        array(),
        array(
            "IBLOCK_ID" => "17",
            "SECTION_CODE" => $l["CODE"],
            "PROPERTY_BRAND_VALUE" => $CURRENT_BRAND["VALUE"]
        )
    );
    $element = $elements -> Fetch();

//    test_dump($CURRENT_BRAND);

//    test_dump($element);

    $sect = GetIBlockSection($element["IBLOCK_SECTION_ID"]);

//    test_dump($section);

//    test_dump($l);
//    test_dump($element != false);
    if ($element != false) {
        $list_subsections_filtered[] = $sect;
    }
}
?>
<h1><?=$CURRENT_BRAND["VALUE"]?></h1>
<div class="item-cards-list-cnt">
    <ul class="item-cards-list matrix categories">
        <?foreach ($list_subsections_filtered as $subsection) :
            $url = strtolower($subsection["SECTION_PAGE_URL"] . $CURRENT_BRAND["XML_ID"] . "/");

            ?>
            <li class="item-card-item">
                <a href="<?=$url?>">
                    <div class="img-cnt">
                        <img src="/img/img_dummy.png" data-src="<?=CFIle::GetPath($subsection["~PICTURE"])?>" alt=""/></div>
                    <div class="item-info">
                        <p class="category"><?=$subsection["NAME"]?></p>
                    </div>
                </a>
            </li>
        <?endforeach?>
    </ul>
</div>
