<?php

AddEventHandler('form', 'onBeforeResultAdd', 'manSpeconBeforeResultAdd');
function manSpeconBeforeResultAdd($WEB_FORM_ID, $arFields, &$arrVALUES){
    if ($WEB_FORM_ID == 2) :
        global $APPLICATION;
        $idSpec = $arrVALUES["form_text_11"]; // вытаскиваем спецификацию
        $pathFile = getPdfFile($idSpec); // формируем файл
        if ($pathFile):
            $arrVALUES["form_text_6"] = $pathFile;
        else:
            $APPLICATION->ThrowException('Не удалось свормировать файл спецификации. Попробуйте позже.');
        endif;
    endif;
}
/**
 * [getIblockSpecifications description]
 * @return int id iblock
 */
function getIblockSpecifications(){
	return 19;
}
/**
 * [translitParams description]
 * @return array
 */
function translitParams(){
    return Array(
        "max_len" => "100", // обрезает символьный код до 100 символов
        "change_case" => "L", // буквы преобразуются к нижнему регистру
        "replace_space" => "_", // меняем пробелы на нижнее подчеркивание
        "replace_other" => "_", // меняем левые символы на нижнее подчеркивание
        "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
        "use_google" => "false", // отключаем использование google
    );
}
/**
 * [getPdfFile generate and save PDF file]
 * @param  int $idSpec
 * @return str or false
 */
function getPdfFile($idSpec){
    $arSpecification = getSpecification($idSpec);
    if ($arSpecification):
        $allSumSpec = "";
        foreach ($arSpecification["ITEMS"] as $key => $arItems) :
            $allSumSpec += $arItems["DISCOUNT"]["PRICE"]*$arItems["PROPERTY_COUNT_VALUE"];
            $totalPrice += $arItems["DISCOUNT"]["DISCOUNT_PRICE"]*$arItems["PROPERTY_COUNT_VALUE"];
            $allDisSpec += $arItems["DISCOUNT"]["PRICE"]-$arItems["DISCOUNT"]["DISCOUNT_PRICE"];
            $allSumminDisSpec += $arItems["DISCOUNT"]["DISCOUNT_PRICE"]*$arItems["PROPERTY_COUNT_VALUE"];
        endforeach;
        include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/tcpdf/tcpdf.php");
        $curDate = date("d.m.Y H:i:s");
        global $USER;
        $name = $USER->GetFirstName()."_".$USER->GetLastName()."_".str_replace(" ","_", $arSpecification["NAME"])."_".$curDate;
        $nameFile = CUtil::translit($name, "ru", translitParams());
        // create new PDF document
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $fontname = TCPDF_FONTS::addTTFfont($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/tcpdf/font_arial/arial.ttf", '', '', 32);
        // set document information
        $pdf->SetAuthor($USER->GetFirstName()." ".$USER->GetLastName());
        $pdf->SetTitle("Спецификация ".$arSpecification["NAME"]);
        // set font
        $pdf->SetFont($fontname, 'BI', 12);
        // add a page
        $pdf->AddPage();
        $text = "Спецификация: №".$arSpecification["ID"];
        $pdf->Write(0, $text, '', 0, 'L', true, 0, false, false, 0);
        $text = "Дизайнер: ".$USER->GetFirstName()." ".$USER->GetLastName();
        $pdf->Write(0, $text, '', 0, 'L', true, 0, false, false, 0);
        $text = "Название спецификации: ".$arSpecification["NAME"];
        $pdf->Write(0, $text, '', 0, 'L', true, 0, false, false, 0);
        $text = "Стоимость товаров: ".number_format($allSumSpec, 0, 0, " ")." руб.";
        $pdf->Write(0, $text, '', 0, 'L', true, 0, false, false, 0);
        $text = "Со скидкой: ".number_format($allSumminDisSpec, 0, 0, " ")." руб.";
        $pdf->Write(0, $text, '', 0, 'L', true, 0, false, false, 0);
        $text = "Экономия: ".number_format($allDisSpec, 0, 0, " ")." руб.";
        $pdf->Write(0, $text, '', 0, 'L', true, 0, false, false, 0);
        $text = "ИТОГО: ".number_format($totalPrice, 0, 0, " ")." руб.";
        $pdf->Write(0, $text, '', 0, 'L', true, 0, false, false, 0);
        $text = "Продукты:";
        $pdf->Write(0, $text, '', 0, 'L', true, 0, false, false, 0);
        foreach ($arSpecification["ITEMS"] as $key => $arItems) :
            $text = ($key+1).". Артикул: ".$arItems["PRODUCT"]["PROPERTY_ARTIKUL_VALUE"];
            $pdf->Write(0, $text, '', 0, 'L', true, 0, false, false, 0);
            $text = "    Идентификатор продукта: ".$arItems["PRODUCT"]["ID"];
            $pdf->Write(0, $text, '', 0, 'L', true, 0, false, false, 0);
            $text = "    Название: ".$arItems["PRODUCT"]["NAME"];
            $pdf->Write(0, $text, '', 0, 'L', true, 0, false, false, 0);
            $text = "    Цена: ".number_format($arItems["DISCOUNT"]["DISCOUNT_PRICE"], 0, 0, " ")." руб.";
            $pdf->Write(0, $text, '', 0, 'L', true, 0, false, false, 0);
            $text = "    Количество: ".$arItems["PROPERTY_COUNT_VALUE"];
            $pdf->Write(0, $text, '', 0, 'L', true, 0, false, false, 0);
        endforeach;
        $filePath = $_SERVER["DOCUMENT_ROOT"]."/upload/spec_files/".$nameFile.".pdf";
        $path = "/upload/spec_files/".$nameFile.".pdf";
        //Close and save PDF document
        $pdf->Output($filePath, 'F');
        return $path;
    endif;
    return false;
}
/**
 * [getSpecification description]
 * @param  int $id
 * @return array or false
 */
function getSpecification($id){
    if (!CModule::IncludeModule('iblock')):
        return false;
    endif;
    global $USER;
    $arFilterSec = Array('IBLOCK_ID'=>$IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y', "ID" => $id);
    $db_list = CIBlockSection::GetList(Array("TIMESTAMP_X" => "DESC"), $arFilterSec, true);
    if($ar_result = $db_list->GetNext())
    {
        $arSelect = Array("NAME", "ID", "PROPERTY_PRODUCT", "PROPERTY_COUNT");
        $arFilter = Array("IBLOCK_ID" => $IBLOCK_ID, "ACTIVE" => "Y", "SECTION_ID" => $ar_result["ID"]);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($ob = $res->GetNextElement())
        {
            $arItem = $ob->GetFields();
            $arItem["PRODUCT"] = getItemCart($arItem["PROPERTY_PRODUCT_VALUE"]);
            $dbPrice = CPrice::GetList(
                array("QUANTITY_FROM" => "ASC", "QUANTITY_TO" => "ASC", "SORT" => "ASC"),
                array("PRODUCT_ID" => $arItem["PROPERTY_PRODUCT_VALUE"]),
                false,
                false,
                array("ID", "CATALOG_GROUP_ID", "PRICE", "CURRENCY", "QUANTITY_FROM", "QUANTITY_TO")
            );
            if ($arPrice = $dbPrice->Fetch())
            {
                $arDiscounts = CCatalogDiscount::GetDiscountByPrice(
                        $arPrice["ID"],
                        $USER->GetUserGroupArray(),
                        "N",
                        SITE_ID
                    );
                $discountPrice = CCatalogProduct::CountPriceWithDiscount(
                        $arPrice["PRICE"],
                        $arPrice["CURRENCY"],
                        $arDiscounts
                    );
                $arPrice["DISCOUNT_PRICE"] = $discountPrice;
                $arItem["DISCOUNT"] = $arPrice;
            }
            $ar_result["ITEMS"][] = $arItem;
        }
        return $ar_result;
    }
    return false;
}
/**
 * [removeSpecification description]
 * @param  array $arParams
 * @return bool
 */
function removeSpecification($arParams){
    if (!CModule::IncludeModule('iblock')):
        return false;
    endif;
    $arSelect = Array("NAME", "ID");
    $arFilter = Array(
        "IBLOCK_ID" => getIblockSpecifications(), 
        "ACTIVE" => "Y", 
        "SECTION_ID" => intval($arParams["spec"])
        );
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement())
    {
        $arItems[] = $ob->GetFields();
    }
    foreach ($arItems as $key => $item) :
        if (!CIBlockElement::Delete($item["ID"])):
            return false;
        endif;
    endforeach;
    if (CIBlockSection::Delete($arParams["spec"])):
        return true;
    endif;
    return false;
}
/**
 * [removeItemSpecification description]
 * @param  array $arParams
 * @return bool
 */
function removeItemSpecification($arParams){
    if (!CModule::IncludeModule('iblock')):
        return false;
    endif;
    if (CIBlockElement::Delete($arParams["product"])):
        return true;
    endif;
    return false;
}
/**
 * [addSpecifications description]
 * @param array $arParams
 * @return bool
 */
function addSpecifications($arParams){
	if (!CModule::IncludeModule('iblock')):
        return false;
    endif;
    if (!$arParams["user"]):
        $arParams["user"] = $USER->GetId();
    endif;
    $bs = new CIBlockSection;
	$IBLOCK_ID = getIblockSpecifications();
	$NAME = $arParams["spec"];
	$arFields = Array(
		"ACTIVE" => "Y",
		"IBLOCK_SECTION_ID" => false,
		"IBLOCK_ID" => $IBLOCK_ID,
		"NAME" => $NAME,
		"CODE" => "",
		"DEPTH_LEVEL" => "",
		"SORT" => "",
		);
	$ID = $bs->Add($arFields);
	if($ID > 0):
        if ($arParams["product"]):
    		$res = addProductsSpecification($arParams, $ID);
    		if ($res):
    			$specUser = addSpecUser($arParams["user"], $ID);
    			if ($specUser):
    				return true;
    			endif;
    		endif;
        else:
            $specUser = addSpecUser($arParams["user"], $ID);
            if ($specUser):
                return true;
            endif;
        endif;
	endif;
    return false;
}
/**
 * [updateSpecifications description]
 * @param  array $arParams
 * @return bool
 */
function updateSpecifications($arParams){
	if (!CModule::IncludeModule('iblock')):
        return false;
    endif;
    $arSelect = Array("NAME", "ID", "PROPERTY_PRODUCT", "PROPERTY_COUNT");
    $arFilter = Array(
    	"IBLOCK_ID" => getIblockSpecifications(), 
    	"ACTIVE" => "Y", 
    	"SECTION_ID" => intval($arParams["spec"]), 
    	"PROPERTY_PRODUCT" => $arParams["product"]
    	);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    if($ob = $res->GetNextElement())
    {
        $arItem = $ob->GetFields();
    }
    if ($arItem):
        $countItems = ($arParams["count"]) ? $arParams["count"] : 1;
        $el = new CIBlockElement;
    	$PROP = array();
    	$PROP = array(
    		"COUNT" => intval($countItems) + intval($arItem["PROPERTY_COUNT_VALUE"]),
    		"PRODUCT" => $arParams["product"]
    		);
    	$arLoadProductArray = Array(
    		"IBLOCK_SECTION_ID" => intval($arParams["spec"]),
    		"IBLOCK_ID"         => getIblockSpecifications(),
    		"PROPERTY_VALUES"   => $PROP,
    		"NAME"              => $arItem["NAME"],
    		"ACTIVE"            => "Y",
    		);
    	if ($el->Update($arItem["ID"], $arLoadProductArray)):
    		return true;
    	endif;
    else:
        if (addProductsSpecification($arParams, $arParams["spec"])):
            return true;
        endif;
    endif;
    return false;
}
/**
 * [addSpecUser description]
 * @param int $idUser
 * @param int $SECTION_ID
 * @return bool
 */
function addSpecUser($idUser, $SECTION_ID){
	if (!CModule::IncludeModule('iblock')):
        return false;
    endif;
    if ($idUser && $SECTION_ID):
        $rsUser = CUser::GetByID($idUser);
        $arUser = $rsUser->Fetch();
        if (!in_array($SECTION_ID, $arUser["UF_SPECIFICATIONS"])):
        	$arSpecifications = $arUser["UF_SPECIFICATIONS"];
        	array_push($arSpecifications, $SECTION_ID);
        	$user = new CUser;
			$fields = Array( 
				"UF_SPECIFICATIONS" => $arSpecifications, 
			);
			if ($user->Update($idUser, $fields)):
				return true;
			endif;
        endif;
    endif;
	return false;
}
/**
 * [addProductsSpecification description]
 * @param int $idUser
 * @param int $SECTION_ID
 * @return bool
 */
function addProductsSpecification($arParams, $SECTION_ID){
	if (!CModule::IncludeModule('iblock')):
        return false;
    endif;
    $countItems = ($arParams["count"]) ? $arParams["count"] : 1;
    $el = new CIBlockElement;
	$PROP = array();
	$PROP = array(
		"COUNT" => $countItems,
		"PRODUCT" => $arParams["product"]
		);
	$arLoadProductArray = Array(
		"IBLOCK_SECTION_ID" => intval($SECTION_ID),
		"IBLOCK_ID"         => getIblockSpecifications(),
		"PROPERTY_VALUES"   => $PROP,
		"NAME"              => "Продукт ".$arParams["product"],
		"ACTIVE"            => "Y",
		);
	$PRODUCT_ID = $el->Add($arLoadProductArray);
	if ($PRODUCT_ID > 0):
		return true;
	endif;
    return false;
}
/**
 * [getSpecificationsList description]
 * @param  int $idUser
 * @return array or false
 */
function getSpecificationsList($idUser){
    if (!CModule::IncludeModule('iblock')):
        return false;
    endif;
    global $USER;
    if ($idUser):
    	$IBLOCK_ID = getIblockSpecifications();
        $rsUser = CUser::GetByID($idUser);
        $arUser = $rsUser->Fetch();
        $arSpecificationsId = $arUser["UF_SPECIFICATIONS"];
        foreach ($arSpecificationsId as $key => $id) :
            $arFilterSec = Array('IBLOCK_ID'=>$IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y', "ID" => $id);
            $db_list = CIBlockSection::GetList(Array("TIMESTAMP_X" => "DESC"), $arFilterSec, true);
            if($ar_result = $db_list->GetNext())
            {
                $ar_result["ITEMS"] = array();
                $arSelect = Array("NAME", "ID", "PROPERTY_PRODUCT", "PROPERTY_COUNT");
                $arFilter = Array("IBLOCK_ID" => $IBLOCK_ID, "ACTIVE" => "Y", "SECTION_ID" => $ar_result["ID"]);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                while($ob = $res->GetNextElement())
                {
                    $arItem = $ob->GetFields();
                    $arProdSpec = getItemCart($arItem["PROPERTY_PRODUCT_VALUE"]);
                    if ($arProdSpec && $arItem["PROPERTY_PRODUCT_VALUE"]):
                        $arItem["PRODUCT"] = $arProdSpec;
                        $dbPrice = CPrice::GetList(
                            array("QUANTITY_FROM" => "ASC", "QUANTITY_TO" => "ASC", "SORT" => "ASC"),
                            array("PRODUCT_ID" => $arItem["PROPERTY_PRODUCT_VALUE"]),
                            false,
                            false,
                            array("ID", "CATALOG_GROUP_ID", "PRICE", "CURRENCY", "QUANTITY_FROM", "QUANTITY_TO")
                        );
                        if ($arPrice = $dbPrice->Fetch())
                        {
                            $arDiscounts = CCatalogDiscount::GetDiscountByPrice(
                                    $arPrice["ID"],
                                    $USER->GetUserGroupArray(),
                                    "N",
                                    SITE_ID
                                );
                            $discountPrice = CCatalogProduct::CountPriceWithDiscount(
                                    $arPrice["PRICE"],
                                    $arPrice["CURRENCY"],
                                    $arDiscounts
                                );
                            $arPrice["DISCOUNT_PRICE"] = $discountPrice;
                            $arItem["DISCOUNT"] = $arPrice;
                        }
                        $ar_result["ITEMS"][] = $arItem;
                    elseif (!$arItem["PROPERTY_PRODUCT_VALUE"]):
                        $arParams["product"] = $arItem["ID"];
                        removeItemSpecification($arParams);
                    endif;
                }
                $arSections[] = $ar_result;
            }
        endforeach;
        return $arSections;
    endif;
    return false;
}
/**
 * [getSpecificationsName description]
 * @param  int $idUser
 * @return array or false
 */
function getSpecificationsName($idUser){
    if (!CModule::IncludeModule('iblock')):
        return false;
    endif;
    if ($idUser):
        $rsUser = CUser::GetByID($idUser);
        $arUser = $rsUser->Fetch();
        $arSpecificationsId = $arUser["UF_SPECIFICATIONS"];
        foreach ($arSpecificationsId as $key => $id) :
            $arFilter = Array('IBLOCK_ID'=>19, 'GLOBAL_ACTIVE'=>'Y', "ID" => $id);
            $db_list = CIBlockSection::GetList(Array("SORT" => "ASC"), $arFilter, true);
            if($ar_result = $db_list->GetNext())
            {
                $arSections[] = $ar_result;
            }
        endforeach;
        return $arSections;
    endif;
    return false;
}
/**
 * [getPopupSpecifications description]
 * @param  array $arSpecifications
 * @return string html
 */
function getPopupSpecifications($arSpecifications){
    $result .= '<div class="add-to-spec-form-cnt" id="add-to-spec-form">
                <p class="popup-header">Добавить в спецификацию</p>
                <form class="common-form add-to-spec-form" action="">';
    if ($arSpecifications):
        $result .= '<div class="row">
                    <div class="col12">
                    <fieldset>
                    <input type="radio" class="css-checkbox" name="typeSpec[]" id="spec-exist" value="exist" checked/>
                    <label class="cb-label" for="spec-exist">Выбрать существующую</label>
                    </fieldset>
                    </div>
                    <div class="col12">
                    <fieldset>
                    <select class="js-common-select-nosearch" name="SPECIFICATION" id="exist-spec-select">';
        foreach ($arSpecifications as $key => $arSpecification) :
            $result .= '<option value="'.$arSpecification["ID"].'">'.$arSpecification["NAME"].'</option>';
        endforeach;
        $result .='</select></fieldset></div></div>';
    endif;
    $result .= '<div class="row">
                <div class="col12">
                <fieldset>';
    if ($arSpecifications):
        $result .= '<input type="radio" class="css-checkbox" name="typeSpec[]" id="spec-new" value="new"/>
                    <label class="cb-label" for="spec-new">Создать новую</label>';
    else:
        $result .= '<label>Создать новую спецификацию</label>';
    endif;
    $result .= '</fieldset></div><div class="col12">
                <fieldset>';
    if ($arSpecifications):
        $dis = "disabled";
    endif;
    $result .= '<input type="text" name="NEW_SPECIFICATION" id="new-spec-name"'.$dis.'/>
                </fieldset>
                </div>
                </div>
                <div class="spec-submit-cnt acenter">
                <a class="btn important js-submit-spec" href="#">Добавить</a>
                </div>
                <div class="preload-overlay"><i></i></div>
                </form>
                </div>';
    return $result;
}
?>