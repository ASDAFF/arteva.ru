<?php
/**
* 
*/
class AddProductsPrice
{
	/**
	 * [getIblockId description]
	 * @return integer iblock id catalog bitrix
	 */
	protected function getIblockId(){
		return 17;
	}
	/**
	 * [getProduct description]
	 * @param  string $id1c
	 * @return array or false
	 */
	protected function getProduct($id1c){
		if (!CModule::IncludeModule("iblock")):
			return false;
		endif;
		$arSelect = Array("ID");
		$arFilter = Array("IBLOCK_ID"=>$this->getIblockId(), "PROPERTY_ID_PROD" => $id1c);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		if($ob = $res->GetNextElement()):
		 	$arItem = $ob->GetFields();
		 	return $arItem["ID"];
		endif;
		return false;
	}
	protected function addCatalogProducts($arParams){
		if (!CModule::IncludeModule("iblock") && !CModule::IncludeModule("catalog") && !CModule::IncludeModule("sale")):
			return false;
		endif;
		$arFields = array(
			"ID" => $arParams["PRODUCT_ID"],
			"QUANTITY" => $arParams["BALANCE"],
			"CAN_BUY_ZERO" => "Y",
			"NEGATIVE_AMOUNT_TRACE" => "Y",
			"QUANTITY_TRACE" => "Y"
			);
		$db_res = CCatalogProduct::GetList(
			array(),
			array("ID" => $arParams["PRODUCT_ID"]),
			false,
			array()
			);
		if ($ar_res = $db_res->Fetch()):
			if (!CCatalogProduct::Update($ar_res["ID"], $arFields)):
				return false;
			endif;
		else:
			if(!CCatalogProduct::Add($arFields)):
				return false;
			endif;
		endif;
		return true;
	}
	/**
	 * [addPriceProducts description]
	 * @param array $arParams
	 * @return bool
	 */
	protected function addPriceProducts($arParams){
		if (!CModule::IncludeModule("iblock") && !CModule::IncludeModule("catalog") && !CModule::IncludeModule("sale")):
			return false;
		endif;
		$PRICE_TYPE_ID = 1; // идентификатор типы базовой цены
		$arFields = Array(
		    "PRODUCT_ID" => $arParams["PRODUCT_ID"],
		    "CATALOG_GROUP_ID" => $PRICE_TYPE_ID,
		    "PRICE" => $arParams["OLD_PRICE"],
		    "CURRENCY" => "RUB",
		    "QUANTITY_FROM" => 1,
		);
		$res = CPrice::GetList(
		        array(),
		        array(
	                "PRODUCT_ID" => $arParams["PRODUCT_ID"],
	                "CATALOG_GROUP_ID" => $PRICE_TYPE_ID
	            )
		    );
		if ($arr = $res->Fetch()):
		    if (!CPrice::Update($arr["ID"], $arFields)):
		    	return false;
		    endif;
		else:
		    if (!CPrice::Add($arFields)):
		    	return false;
		    endif;
		endif;
		if (!$this->addCatalogProducts($arParams)):
			return false;
		endif;
		return true;
	}
	/**
	 * [addPrice description]
	 * @param obj $objprice
	 * @return bool
	 */
	public function addPrice($objprice){
		foreach ($objprice as $key => $prod):
			//set_time_limit(10);
			unset($PRODUCT_ID);
			if ($PRODUCT_ID = $this->getProduct((string)$prod->Ид)):
				$arParams = array(
					"PRODUCT_ID" => $PRODUCT_ID,
					"ID_1C" => (string)$prod->Ид,
					"BALANCE" => (int)$prod->Balance,
					"OLD_PRICE" => (int)$prod->Old_price
					);
				if (!$this->addPriceProducts($arParams)):
					return false;
				endif;
			else:
				return false;
			endif;
		endforeach;
		return true;
	}
}
?>