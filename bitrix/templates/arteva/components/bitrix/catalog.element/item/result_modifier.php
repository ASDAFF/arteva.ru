<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
// добавляем хлебную крошку
if($arParams['ADD_SECTIONS_CHAIN'] && !empty($arResult['NAME'])):
    $arResult['SECTION']['PATH'][] = array(

        'NAME' => $arResult['NAME'],
        'PATH' => ''
    );
endif;
// добавляем показы элемента
CIBlockElement::CounterInc($arResult["ID"]);
// похожие товары
$arSimilarItems = explode(",", $arResult["PROPERTIES"]["SIMILAR_ITEMS"]["VALUE"]);
$arSimilarItems = array_filter($arSimilarItems, function($el){ return !empty($el); });
if ($arSimilarItems):
	foreach ($arSimilarItems as $key => $itemsId1c) :
		$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_CODE_COLOR", "PROPERTY_ID_PROD", "PROPERTY_COLOR");
		$arFilter = Array("IBLOCK_ID" => $arResult["IBLOCK_ID"], "ACTIVE" => "Y", "PROPERTY_ID_PROD" => trim($itemsId1c));
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
			$arItems = $ob->GetFields();
		}
		$arResult["SIMILAR_ITEMS"][] = $arItems;
	endforeach;
endif;
// если юзер - дизайнер
if (in_array(8, $USER->GetUserGroupArray())):
	$arResult["USER_DESIGNER"] = true;
endif;

//AddMessage2Log($arResult);

if(CModule::IncludeModule('iblock'))
{
	//AddMessage2Log($arResult["PROPERTIES"]["BRAND"]["VALUE"][0], '/log/');
	$rsElement = CIBlockElement::GetList(
			array(),
			array("IBLOCK_ID"=>6,"NAME"=>$arResult["PROPERTIES"]["BRAND"]["VALUE"][0]),
			false,
			false,
			array('ID','PREVIEW_PICTURE')
	);

	if($arElement = $rsElement->Fetch())
	{
		//AddMessage2Log($arElement);
		$arFile = CFile::GetFileArray($arElement["PREVIEW_PICTURE"]);
		$ipropValues = new Bitrix\Iblock\InheritedProperty\ElementValues(6, $arElement["ID"]);
		$arElement["IPROPERTY_VALUES"] = $ipropValues->getValues();
		AddMessage2Log($arElement);
		if($arFile)
			$arResult["BRAND_LOGO"] = $arFile["SRC"];
	}
}

//echo "<pre>";print_r($arSimilarItems);echo "</pre>";
?>