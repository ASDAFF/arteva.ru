<?php
/**
* 
*/
class ActionProducts
{
	/**
	 * [getIblockId description]
	 * @return integer iblock id catalog bitrix
	 */
	protected function getIblockId(){
		return 17;
	}
	/**
	 * [delProducts description]
	 * @param array $arProducts
	 * @return bool
	 */
	protected function delProducts($arProducts){
		if (!CModule::IncludeModule("iblock")):
			return false;
		endif;
		foreach ($arProducts as $key => $prod) :
			if (!CIBlockElement::Delete($prod["ID"])):
				return false;
			endif;
		endforeach;
		return true;	
	}
	/**
	 * [deactivatedProducts description]
	 * @param  array $arProducts
	 * @return bool
	 */
	protected function deactivatedProducts($arProducts){
		if (!CModule::IncludeModule("iblock")):
			return false;
		endif;
		$el = new CIBlockElement;
		$arLoadProductArray = Array("ACTIVE" => "N");
		foreach ($arProducts as $key => $prod) :
			if(!$el->Update($prod["ID"], $arLoadProductArray)):
				return false;
			endif;
		endforeach;
		return true;
	}
	/**
	 * [getProducts description]
	 * @param  array $arId1c
	 * @return array or false
	 */
	protected function getProducts($arId1c){
		if (!CModule::IncludeModule("iblock")):
			return false;
		endif;
		$arSelect = Array("ID", "NAME", "PROPERTY_ID_PROD", "CODE");
		$arFilter = Array("IBLOCK_ID"=>$this->getIblockId(), "!PROPERTY_ID_PROD" => $arId1c);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNextElement())
		{
		 	$arItems[] = $ob->GetFields();
		}
		return $arItems;
	}
	/**
	 * [otherProducts description]
	 * @param  object $objProducts
	 * @return array or false
	 */
	protected function otherProducts($objProducts){
		foreach ($objProducts->Товар as $product):
			$arId1c[] = (string)$product->Ид;
		endforeach;
		if ($arProducts = $this->getProducts($arId1c)):
			return $arProducts;
		endif;
		return false;
	}
	/**
	 * [removeProducts description]
	 * @param  object $objProducts
	 * @return bool
	 */
	public function removeProducts($objProducts){
		if ($arProducts = $this->otherProducts($objProducts)):
			if (!$this->delProducts($arProducts)): return false; endif;
		endif;
		return true;
	}
	/**
	 * [noActiveProducts description]
	 * @param  object $objProducts
	 * @return bool
	 */
	public function noActiveProducts($objProducts){
		if ($arProducts = $this->otherProducts($objProducts)):
			if (!$this->deactivatedProducts($arProducts)): return false; endif;
		endif;
		return true;
	}
}
?>