<?php
/**
* 
*/
class ProductsXML
{
	/**
	 * [getIblockId description]
	 * @return integer iblock id catalog bitrix
	 */
	protected function getIblockId(){
		return 17;
	}
	protected function bildXML($arProducts){
		$xml .= "<?xml version='1.0' encoding='UTF-8'?>";
		$xml .= "<import>";
			$xml .= "<fields>";
				$xml .= "<id_bx>Идентификатор Bitrix</id_bx>";
				$xml .= "<id_1c>Идентификатор 1С</id_1c>";
			$xml .= "</fields>";
			$xml .= '<records>';
		foreach ($arProducts as $key => $prod) :
			$xml .= "<row>";
			$xml .= "<id_bx>".$prod["ID"]."</id_bx>";
			$xml .= "<id_1c>".$prod["PROPERTY_ID_PROD_VALUE"]."</id_1c>";
			$xml .= "</row>";
		endforeach;
			$xml .= "</records>";
		$xml .= "</import>";
		return $xml;
	}
	protected function getProducts(){
		if (!CModule::IncludeModule("iblock")):
			return false;
		endif;
		$arSelect = Array("ID", "PROPERTY_ID_PROD");
		$arFilter = Array("IBLOCK_ID"=>$this->getIblockId());
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
		 	$arProducts[] = $ob->GetFields();
		}
		return $arProducts;
	}
	public function getXML(){
		$arProducts = $this->getProducts();
		$xml = $this->bildXML($arProducts);
		return $xml;
	}
}
?>