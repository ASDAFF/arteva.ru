<?php
/**
* 
*/
class AddProducts
{
	/**
	 * [$arPropertiesIblock description]
	 * @var array
	 */
	protected $arPropertiesIblock = array();
	/**
	 * [getIblockId description]
	 * @return integer iblock id catalog bitrix
	 */
	protected function getIblockId(){
		return 17;
	}
	/**
	 * [getPropertyIblock description]
	 * @return array all products on iblock
	 */
	protected function getPropertyIblock(){
		if (!CModule::IncludeModule("iblock")):
			return false;
		endif;
		$properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$this->getIblockId()));
		while ($prop_fields = $properties->GetNext())
		{
			if ($prop_fields["PROPERTY_TYPE"] == "L"):
				$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$this->getIblockId(), "CODE"=>$prop_fields["CODE"]));
				while($enum_fields = $property_enums->GetNext())
				{
				  	$prop_fields["ENUM_LIST"][] = $enum_fields;
				}
			endif;
			$arProperties[] = $prop_fields;
		}
		return $arProperties;
	}
	/**
	 * [findProduct description]
	 * @param  string $code
	 * @return int id product
	 */
	protected function findProduct($code){
		$arSelect = Array("ID", "CODE");
		$arFilter = Array(
			"IBLOCK_ID"=>$this->getIblockId(), 
			//"CODE" => $code
			"PROPERTY_ID_PROD" => $code
			);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		if($ob = $res->GetNextElement())
		{
		 	$arItem = $ob->GetFields();
		 	return intval($arItem["ID"]);
		}
		return false;
	}
	/**
	 * [findSection description]
	 * @param  string $id1c product->Группы->Ид
	 * @return int id catalog section
	 */
	protected function getSectionIblock($id1c){
		if (!CModule::IncludeModule("iblock")):
			return false;
		endif;
		$arSelect = array("ID");
		$arFilter = Array('IBLOCK_ID'=>$this->getIblockId(), "UF_1C_ID" => $id1c);
		$db_list = CIBlockSection::GetList(Array(), $arFilter, true, $arSelect);
		if($ar_result = $db_list->GetNext())
		{
			return intval($ar_result["ID"]);
		}
		return false;
	}
	/**
	 * [removeImages description]
	 * @param  int $id
	 * @return true
	 */
	protected function removeImages($id){
		if (!CModule::IncludeModule("iblock")):
			return false;
		endif;
		$db_props = CIBlockElement::GetProperty($this->getIblockId(), $id, array("sort" => "asc"), Array("CODE"=>"IMAGES"));
		while($ar_props = $db_props->Fetch()):
			if ($ar_props["PROPERTY_VALUE_ID"]):
				$arFile["MODULE_ID"] = "iblock";
				$arFile["del"] = "Y";
				CIBlockElement::SetPropertyValueCode($id, "IMAGES", Array ($ar_props["PROPERTY_VALUE_ID"] => Array("VALUE"=>$arFile)));
				CFile::Delete($ar_props["PROPERTY_VALUE_ID"]);
			endif;
		endwhile;
		return true;
	}
	/**
	 * [bildArrayLoadProp description]
	 * @param  object $product
	 * @return array
	 */
	protected function bildArrayLoadProp($product){
		if (!CModule::IncludeModule("iblock")):
			return false;
		endif;
		$PROP = array();
		$PROP["ID_PROD"] = (string)$product->Ид;
		$XML_ID = (string)$product->Ид;
		foreach ($product->ЗначенияСвойств->ЗначенияСвойства as $key => $value) :
			foreach ($this->arPropertiesIblock as $key => $arProp) :
				if ($arProp["CODE"] == (string)$value->Ид):
					if ($arProp["PROPERTY_TYPE"] == "L"):
						foreach ($arProp["ENUM_LIST"] as $key => $arEnum) :
							if ((string)$value->Значение == $arEnum["VALUE"]):
								$PROP[(string)$value->Ид][] = $arEnum["ID"];
							endif;
						endforeach;
					elseif ($arProp["MULTIPLE"] == "Y" && $arProp["PROPERTY_TYPE"] == "F"):
						foreach ($value->Значение as $pathImg) :
							$PROP[(string)$value->Ид][] = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/upload/1c_catalog/".$pathImg);
						endforeach;
					elseif ($arProp["PROPERTY_TYPE"] == "S" && $arProp["MULTIPLE"] == "N"):
						$PROP[(string)$value->Ид] = trim((string)$value->Значение);
					endif;
				endif;
			endforeach;
			if ((string)$value->Ид == "CML2_CODE"):
				$CODE = trim((string)$value->Значение);
			endif;
			if ((string)$value->Ид == "CML2_SORT"):
				$SORT = trim((string)$value->Значение);
			endif;
			if ((string)$value->Ид == "CML2_ACTIVE"):
				$ACTIVE = ($value->Значение != "false") ? "Y" : "N";
			endif;
			if ((string)$value->Ид == "CML2_PREVIEW_TEXT"):
				$PREVIEW_TEXT = trim((string)$value->Значение);
			endif;
			if((string)$value->Ид == "CML2_DETAIL_TEXT"):
				$DETAIL_TEXT = trim((string)$value->Значение);
			endif;
		endforeach;
		$IBLOCK_ID = $this->getIblockId();
		$NAME = (string)$product->Наименование;
		$IBLOCK_SECTION_ID = $this->getSectionIblock((string)$product->Группы->Ид);
		$PREVIEW_PICTURE = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/upload/1c_catalog/".$product->Картинка);
		return array(
			"IBLOCK_SECTION_ID" => $IBLOCK_SECTION_ID,
			"IBLOCK_ID"         => $IBLOCK_ID,
			"PROPERTY_VALUES"   => $PROP,
			"NAME"              => $NAME,
			"CODE"              => $CODE,
			"ACTIVE"            => $ACTIVE,
			"SORT"              => $SORT,
			"PREVIEW_PICTURE"   => $PREVIEW_PICTURE,
			"PREVIEW_TEXT"      => $PREVIEW_TEXT,
			"DETAIL_TEXT"       => $DETAIL_TEXT,
			"XML_ID"            => $XML_ID
			);
	}
	/**
	 * [addProductsIblock description]
	 * @param object $objProducts
	 * @return bool
	 */
	protected function addProductsIblock($objProducts){
		if (!CModule::IncludeModule("iblock")):
			return false;
		endif;
		global $APPLICATION;
		foreach ($objProducts->Товар as $product):
			$el = new CIBlockElement;
			$arLoadProductArray = $this->bildArrayLoadProp($product);
			if (is_array($arLoadProductArray)):
				$ID = $this->findProduct($arLoadProductArray["PROPERTY_VALUES"]["ID_PROD"]);
				if ($ID <= 0):
					$ID = $el->Add($arLoadProductArray);
					$res = ($ID>0);
				elseif ($ID > 0):
					$this->removeImages($ID); // очищаем свойство Картинки, чтобы не было дубликатов
					$res = $el->Update($ID, $arLoadProductArray);
				else:
					return false;
				endif;
				if (!$res):
					return false;
				endif;
			else:
				return false;
			endif;
		endforeach;
		return true;
	}
	/**
	 * [readProducts description]
	 * @param  objects $objProducts 
	 * @return bool
	 */
	public function readProducts($objProducts){
		// вытаскиваем свойства инфоблока
		$this->arPropertiesIblock = $this->getPropertyIblock();
		// добавление (обновление) продуктов каталога
		$result = $this->addProductsIblock($objProducts);
		return $result;
	}
}
?>