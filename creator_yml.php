<?
$_SERVER["DOCUMENT_ROOT"] = "/var/www/vhosts/arteva.ru/httpdocs";
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

$iii = 1;

$date = date('Y-m-d H:i:s');
	$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
	<yml_catalog date=\"" . $date . "\">
	<shop>
		<name>Arteva - мебель, свет, предметы интерьера</name>
		<company>ООО НВС-груп</company>
		<url>http://www.arteva.ru</url>
		<platform>BITRIX</platform>
		<version>2.3</version>
		<agency>IT-lab</agency>
		<email>info@arteva.ru</email>
		<currencies>
			<currency id=\"RUR\" rate=\"1\"/>
		</currencies>
		<categories>";
		
		
	// Категории 
	$arFilter = Array('IBLOCK_ID'=>17,);
	$db_list = CIBlockSection::GetList(Array(), $arFilter, true, array("ID", "NAME", "IBLOCK_SECTION_ID"));
	while($ar_result = $db_list->GetNext())
	{
		if($ar_result["IBLOCK_SECTION_ID"] != "")
			$xml .= '<category id="' . $ar_result["ID"] . '" parentId="' . $ar_result["IBLOCK_SECTION_ID"] . '">' . $ar_result["NAME"] . '</category>';
		else
			$xml .= '<category id="' . $ar_result["ID"] . '">' . $ar_result["NAME"] . '</category>';			
	}
		
		$xml .= "</categories>
			<offers>";
		
		$xmlforInMyRoom = $xml;
		
	$arSelect = Array(
		"ID",
		"ACTIVE",
		"IBLOCK_ID",
		"NAME",
		"IBLOCK_SECTION_ID",
		"DETAIL_PAGE_URL",
		"SECTION_CODE",
		"CATALOG_GROUP_1",
		// "DATE_ACTIVE_FROM",
		"PREVIEW_PICTURE",
		"DETAIL_PICTURE",
		"PREVIEW_TEXT",
		"DETAIL_TEXT",
		"PROPERTY_ARTIKUL",
		"PROPERTY_BRAND",
		
		"PROPERTY_SVET_MATERIAL",
		"PROPERTY_MEBEL_MATERIAL",
		"PROPERTY_INTERIER_MATERIAL",

		"PROPERTY_COLOR",
		"PROPERTY_SIZE",
	);	
	// $arFilter = Array("IBLOCK_ID"=> 17, "ACTIVE"=>"Y", "ID" => 41077);
	$arFilter = Array("IBLOCK_ID"=> 17);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nTopCount"=> 10000), $arSelect);
	while($el = $res->GetNext())
	{

		$oldprice = round($el["CATALOG_PRICE_1"]);
		$price = round(GetPriceWithDiscount($el["ID"], $el["CATALOG_PRICE_1"], array(6,7,21)));
			
		// PR($oldprice);	
		// PR($price);	
		
		$url = "http://www.arteva.ru" . $el["DETAIL_PAGE_URL"];
		
		$pic1 = CFile::GetPath($el["PREVIEW_PICTURE"]); if(!empty($pic1)) $pic1 = "http://www.arteva.ru" . $pic1;		
		$pic2 = CFile::GetPath($el["DETAIL_PICTURE"]); if(!empty($pic2)) $pic2 = "http://www.arteva.ru" . $pic2;
	
		$name = str_replace("&", "", $el["~NAME"]);

		$description = htmlentities( str_replace("&", "", $el["DETAIL_TEXT"]) );	
		$arSpecChar = array("&lt;", "&gt;", "&rsquo;", "&", "lt;BRgt;");
		$description = str_replace($arSpecChar, "", $description);
		
		$article = $el["~PROPERTY_ARTIKUL_VALUE"];
		
		$vendor = trim(implode(", ", $el["PROPERTY_BRAND_VALUE"]), ", ");
		$color = trim(implode(", ", $el["PROPERTY_COLOR_VALUE"]), ", ");
		$size = trim(implode(", ", $el["PROPERTY_SIZE_VALUE"]), ", ");
		
		$mater = trim(implode(", ", $el["PROPERTY_SVET_MATERIAL_VALUE"]), ", ");
		if(empty($mater)) $mater = trim(implode(", ", $el["PROPERTY_MEBEL_MATERIAL_VALUE"]), ", ");
		if(empty($mater)) $mater = trim(implode(", ", $el["PROPERTY_INTERIER_MATERIAL_VALUE"]), ", ");

		
		$xml_item = "";
		$xml_item .= "<offer id=\"" . $el["ID"] . "\" available=\"true\">
				<url>" . $url . "</url>
				<price>" . $price . "</price>
				<oldprice>" . $oldprice . "</oldprice>
				<sales_notes>Оплата: нал, безнал, пластиковые карты без %</sales_notes>
				<currencyId>RUR</currencyId>
				<categoryId>" . $el["IBLOCK_SECTION_ID"] . "</categoryId>";
		
		if(!empty($pic1)) $xml_item .= "<picture>" . $pic1 . "</picture>";
		if(!empty($pic2)) $xml_item .= "<picture>" . $pic2 . "</picture>";
		
		$xml_item .= "<store>true</store>
				<pickup>true</pickup>
				<delivery>true</delivery>
				<name>" . $name . "</name>
				<description>" . $description . "</description>
				<vendor>" . $vendor . "</vendor>
				<vendorCode>" . $article . "</vendorCode>
				<param name=\"Материал\">" . $mater . "</param>
				<param name=\"Цвет\">" . $color . "</param>
				<param name=\"Размер\">" . $size . "</param>
			</offer>";
		
		$xml .= $xml_item;
		if($el["ACTIVE"] == "Y") $xmlforInMyRoom .= $xml_item;
		
			
		echo $iii; $iii++;
		echo PHP_EOL;
		ob_get_flush();
	}

	$xml .= "</offers></shop></yml_catalog>";
	$xmlforInMyRoom .= "</offers></shop></yml_catalog>";
	// header("Content-Type: text/xml");
	// echo $xml;

	
	file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/actionpay/actionpay.xml", $xml);
	file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/admitad/admitad.xml", $xml);
	file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/inmyroom/inmyroom.xml", $xmlforInMyRoom);











