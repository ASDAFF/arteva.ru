<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('catalog');  
CModule::IncludeModule('sale');  
$xml = simplexml_load_file($_SERVER["DOCUMENT_ROOT"] . "/api/discount/discount.xml");
$xml = objectToArray($xml);

if( !empty($xml["Item"]) && count($xml["Item"]) > 0	)
{
	$Ids = array();
	foreach($xml["Item"] as $item)
	{
		// Скидка для товаров у которых поле привязка (id_prop = 466) заполнено с $item["discount_id"]
		$arLogic = array(
			"CLASS_ID" => "CondGroup",
			"DATA" => array(
				"All" => "AND",
				"True" => "True",
			),
			"CHILDREN" => array(
				array(
					"CLASS_ID" => "CondIBProp:17:466",
					"DATA" => array(
						"logic" => "Equal",
						"value" => $item["discount_id"]
					)
				)
			)
		);
		
		// PR($item);
		$dbProductDiscounts = CCatalogDiscount::GetList(array(), array("NOTES" => $item["discount_id"]), false, false, array())->Fetch();
		if(empty($dbProductDiscounts))
		{
			$arFields = array(
				"SITE_ID" => "s1",
				"NAME" => "Скидка из 1с " . $item["discount_name"],
				"CURRENCY" => "RUB",
				"PRIORITY" => 100,
				"VALUE_TYPE" => $item["discount_type"],
				"VALUE" => $item["discount_value"],
				"NOTES" => $item["discount_id"],
				"CONDITIONS" => serialize($arLogic),
			);
			$Ids[] = CCatalogDiscount::Add($arFields);
		}
		else
		{
			$arFields2 = array(
				"NAME" => "Скидка из 1с " . $item["discount_name"],
				"VALUE_TYPE" => $item["discount_type"],
				"VALUE" => $item["discount_value"],
				"NOTES" => $item["discount_id"],
				"CONDITIONS" => serialize($arLogic),
			);
			CCatalogDiscount::Update($dbProductDiscounts["ID"], $arFields2);
		}
	}
	PR($Ids);
}
