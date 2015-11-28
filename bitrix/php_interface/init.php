<?
if( !empty($_GET['admitad_uid']) && isset( $_GET['admitad_uid'] ) ){
	setCookie('admitad_uid', $_GET['admitad_uid'], time() + 30 * 24 * 3600, '/', 'www.arteva.ru');
	// die();
}

if( !empty($_GET['actionpay']) && isset( $_GET['actionpay'] ) ){
	setCookie('actionpay', $_GET['actionpay'], time() + 30 * 24 * 3600, '/', 'www.arteva.ru');
}

function test_dump($v) {
	global $USER;
	if ($USER -> isAdmin()) {
		echo "<pre>";
		var_dump($v);
		echo "</pre>";
	}
}


/*
You can place here your functions and event handlers

AddEventHandler("module", "EventName", "FunctionName");
function FunctionName(params)
{
	//code
}
*/

// функции для дизайнеров
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/designer/projects.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/designer/specifications.php");
// функции для каталога
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/sale/functions.php");
// функции для избранных товаров
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/favorites/functions.php");
// функции для пользователя
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/user/functions.php");
//mobile detect
include_once($_SERVER["DOCUMENT_ROOT"]."/include/Mobile_Detect.php");



AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("ElementEventClass", "OnAfterIBlockElementUpdateHandler"));
AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("ElementEventClass", "OnAfterIBlockElementAddHandler"));
class ElementEventClass
{
    function OnAfterIBlockElementAddHandler(&$arFields)
    {
		CModule::IncludeModule('iblock');
        // Деактивация элементова помеченных в 1с как неактивные на сайте
		if($arFields["IBLOCK_ID"] == 17 && isset($arFields["PROPERTY_VALUES"]["CML2_ACTIVE"])){
			if( (string)$arFields["PROPERTY_VALUES"]["CML2_ACTIVE"] == "false" )
			{
				$arLoadProductArray = Array(
					"NAME" => $arFields["NAME"],
					"ACTIVE" => "N",
				);
				$PRODUCT_ID = $arFields["ID"];
				$res = $el->Update($PRODUCT_ID, $arLoadProductArray);
			}
		}
    }
	
    function OnAfterIBlockElementUpdateHandler(&$arFields)
    {
	 	// CModule::IncludeModule('iblock');
 		// global $USER;
		// $el = new CIBlockElement;
		// $arLoadProductArray = Array(
			// "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
			// "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
			// "IBLOCK_ID"      => 34,
			// "NAME"           => "Элемент " . date("Y-m-d G:i:s"),
			// "ACTIVE"         => "Т",            // активен
			// "PREVIEW_TEXT"   => print_r($arFields, true)
		  // );

		// $PRODUCT_ID = $el->Add($arLoadProductArray);
		
		
		// Деактивация элементова помеченных в 1с как неактивные на сайте
		if($arFields["IBLOCK_ID"] == 17 && isset($arFields["PROPERTY_VALUES"]["CML2_ACTIVE"])){
			if( (string)$arFields["PROPERTY_VALUES"]["CML2_ACTIVE"] == "false" )
			{
				$arLoadProductArray = Array(
					"NAME" => $arFields["NAME"],
					"ACTIVE" => "N",
				);
				$PRODUCT_ID = $arFields["ID"];
				$res = $el->Update($PRODUCT_ID, $arLoadProductArray);
			}
		}
	}
}


AddEventHandler("sale", "OnBeforeOrderAdd", "OnBeforeOrderAddHandler");
function OnBeforeOrderAddHandler(&$arFields)
{
	
}



function GetPriceWithDiscount($productID, $price = 0, $arNoDis = array())
{
	$arDiscounts = CCatalogDiscount::GetDiscountByProduct(
		$productID,
		array(1,2,3,4,5,6,7,8,10,11,12,13),
		"N",
		1,
		SITE_ID
	);

	$max = 0;
	$PRIORITY = 0;
	$discompl = false;
	// PR($arDiscounts);
	
	foreach($arDiscounts as $key => $val){
		if(!in_array($val["ID"], $arNoDis))
		{	
			if($val["PRIORITY"] > $max ){
				$PRIORITY = $key;
				$max = $val["PRIORITY"];
				
				$discompl = true;
			}
		}
	}	
	if($discompl){
		if( $arDiscounts[$PRIORITY]["VALUE_TYPE"] == "P" )
			return $price - ( $price * ( $arDiscounts[$PRIORITY]["VALUE"] / 100) );
		elseif( $arDiscounts[$PRIORITY]["VALUE_TYPE"] == "F" )
			return $price - $arDiscounts[$PRIORITY]["VALUE"];
		else
			return $arDiscounts[$PRIORITY]["VALUE"];
	}else{
		return $price;
	}
}






function CL($arr, $labelPhp = false)
{
	if($labelPhp)	
		echo "<script>console.log( { PHP: " . json_encode($arr) . " })</script>";
	else
		echo "<script>console.log(" . json_encode($arr) . ")</script>";
}

function PR($o, $bool = false)
{
	$bt =  debug_backtrace();
	$bt = $bt[0];
	$dRoot = $_SERVER["DOCUMENT_ROOT"];
	$dRoot = str_replace("/","\\",$dRoot);
	$bt["file"] = str_replace($dRoot,"",$bt["file"]);
	$dRoot = str_replace("\\","/",$dRoot);
	$bt["file"] = str_replace($dRoot,"",$bt["file"]);
	global $USER;
	if ($USER->isAdmin() || $bool){
	?>
	<div style='font-size:9pt; color:#000; background:#fff; border:1px dashed #000;'>
	<div style='padding:3px 5px; background:#99CCFF; font-weight:bold;'>File: <?=$bt["file"]?> [<?=$bt["line"]?>]</div>
	<pre style='padding:10px;'><?print_r($o)?></pre>
	</div>
	<?
	}
}


function GetAllParantsSection($idsec = 0){
	
	if(!isset($returnParantsSection)) global $returnParantsSection;
	
	$arFilter = Array('IBLOCK_ID'=> 2, 'GLOBAL_ACTIVE'=>'Y', "ID" => $idsec);
	$db_list = CIBlockSection::GetList(Array(), $arFilter, true, array("ID", "NAME", "IBLOCK_SECTION_ID", "CODE", "SECTION_PAGE_URL"));
	if($ar_result = $db_list->GetNext())
	{
		if(!empty($ar_result["IBLOCK_SECTION_ID"]))
		{	
			$returnParantsSection[] = $ar_result;
			GetAllParantsSection($ar_result["IBLOCK_SECTION_ID"]);
		}else{
			$returnParantsSection[] = $ar_result;	
		}
	}
	
	return $returnParantsSection;
}


function objectToArray($object)
{
    if(!is_object($object) && !is_array($object)){ 
        return $object;
    } 
    if(is_object($object)) 
    { 
        $object = get_object_vars( $object ); 
    } 
    return array_map( 'objectToArray', $object); 
}


define("TRACE_FILENAME",$_SERVER["DOCUMENT_ROOT"]."/log/trace_".date("Ymd").".log");

function Trace($object)
{
    if ($fp = @fopen(TRACE_FILENAME, "ab+"))
    {
        if (flock($fp, LOCK_EX))
        {
            @fwrite($fp,print_r($object,true));
            @fwrite($fp, "\r\n----------\r\n");
            @fflush($fp);
            @flock($fp, LOCK_UN);
            @fclose($fp);
        }
    }
}

?>
