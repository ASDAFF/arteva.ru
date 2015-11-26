<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");

$str = "<?xml version='1.0' encoding='UTF-8'?>";
if(isset($_REQUEST["xml"]) || isset($_REQUEST["date"]))
{
	// file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/actionpay/___loge.php", print_r($_REQUEST, true));
	if(isset($_REQUEST["xml"]))
	{
		$xml = $_REQUEST["xml"]; 
		/*  $xml = "<?xml version='1.0' encoding='UTF-8'?><items><item>34989</item><item>10549</item><item>32839</item></items>";  */
		
		$xml_result = objectToArray( simplexml_load_string($xml) );
		
		
		if( !empty($xml_result["item"]) )
		{
			$filter = array("ACCOUNT_NUMBER" => $xml_result["item"]);
		}
		// PR($xml_result["item"]); // массив номеров заказов
	}
	elseif(isset($_REQUEST["date"]))
	{
		$DateFrom = $_REQUEST["date"] . " 00:00:00";
		$DateTo = $_REQUEST["date"] . " 23:59:59";
		$filter = array(
			">=DATE_INSERT" => $DateFrom,
			"<=DATE_INSERT" => $DateTo,
		);
	}
	else{
		$filter = array("=DATE_INSERT" => date('d.m.Y'));
	}

		$str .= "<items>";
		$items = CSaleOrder::GetList(array("DATE_INSERT" => "DESC"), $filter);
		while($item = $items->fetch())
		{
			$actionpay_prop = CSaleOrderPropsValue::GetList(array(), array("ORDER_ID" => $item["ID"], "ORDER_PROPS_ID" => 21))->Fetch();		
			// Устнавливаем статус
			if( !empty($actionpay_prop["VALUE"]) || isset($actionpay_prop["VALUE"]) ) 
			{
				if($item["STATUS_ID"] == "S") 
					$status = "1";  //принят
				elseif($item["STATUS_ID"] == "D") 
					$status = "3"; //отклонен
				else
					$status = "2"; //в обработке
				
				$click = stristr($actionpay_prop["VALUE"], ".", true); //  actionpay до точки
				$source = trim(stristr($actionpay_prop["VALUE"], "."), "."); // actionpay после точки

				$str .= "<item>";
					$str .= "<id>" . $item["ACCOUNT_NUMBER"] . "</id>";
					$str .= "<click>" . $click . "</click>";
					$str .= "<source>" . $source . "</source>";
					$str .= "<price>" . $item["PRICE"] . "</price>";
					$str .= "<status>" . $status . "</status>";
				$str .= "</item>";
				
			}
			else{
				$status = "4"; // не существует
				
			}


			
		}
		
		$str .= "</items>";
		header('Content-Type: text/xml; charset=utf-8');
		echo $str;
}


// $DateFrom = "17.11.2015 00:00:00";
// $DateTo = "17.11.2015 23:59:59";
// $filter = array(
	// ">=DATE_INSERT" => $DateFrom,
	// "<=DATE_INSERT" => $DateTo,
// );
// $items = CSaleOrder::GetList(array("DATE_INSERT" => "DESC"), $filter);
// while($item = $items->fetch())
// {
	// PR($item);
	// $actionpay_prop = CSaleOrderPropsValue::GetList(array(), array("ORDER_ID" => $item["ID"], "ORDER_PROPS_ID" => 21))->Fetch();	
	// $click = stristr($actionpay_prop["VALUE"], ".", true); //  actionpay до точки
	// $source = trim(stristr($actionpay_prop["VALUE"], "."), "."); // actionpay после точки
	// PR($actionpay_prop);
	// PR($source);
	// PR($click);
// } 





