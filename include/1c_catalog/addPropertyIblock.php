<?php
/**
 * 
 */
class AddPropertyIblock
{
	/**
	 * [getIblockId description]
	 * @return integer iblock id catalog bitrix
	 */
	protected function getIblockId(){
		return 17;
	}
	/**
	 * [translitParams description]
	 * @return array
	 */
	protected function translitParams(){
		return Array(
			"max_len" => "100", // обрезает символьный код до 100 символов
			"change_case" => "U", // буквы преобразуются к нижнему регистру
			"replace_space" => "_", // меняем пробелы на нижнее подчеркивание
			"replace_other" => "_", // меняем левые символы на нижнее подчеркивание
			"delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
			"use_google" => "false", // отключаем использование google
	    );
	}
    /**
     * [validateProp description]
     * @param  object $obprop
     * @return bool
     */
	protected function validateProp($obprop){
		$val = (!in_array((string)$obprop->Ид, array("CML2_CODE", "CML2_SORT", "CML2_ACTIVE", "CML2_DETAIL_TEXT", "CML2_PREVIEW_TEXT"))) ? true : false;
		return (!empty($obprop->Наименование) && !empty($obprop->Ид) && $val === true) ? true : false;
	}
	/**
	 * [getPropertiesIblock description]
	 * @return array
	 */
	protected function getPropertiesIblock(){
		if (!CModule::IncludeModule("iblock")):
			return false; 
		endif;
		$properties = CIBlockProperty::GetList(Array(), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$this->getIblockId()));
		while ($prop_fields = $properties->GetNext())
		{
			if (!in_array($prop_fields["CODE"], array("ID_PROD"))):
				$arProperties[$prop_fields["CODE"]] = $prop_fields;
			endif;
		}
		return $arProperties;
	}
	/**
	 * [findProperties description]
	 * @param  object $obprop
	 * @return bool
	 */
	protected function findProperties($obprop){
		if (!CModule::IncludeModule("iblock")):
			return false; 
		endif;
		$name = null; $id1c = null;
		$name = $obprop->Наименование;
		$id1c = $obprop->Ид;
		$properties = CIBlockProperty::GetList(Array(), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$this->getIblockId()));
		while ($prop_fields = $properties->GetNext())
		{
			$arProperties[] = $prop_fields;
		}
		foreach ($arProperties as $key => $prop) :
			if ($prop["NAME"] == $name && $prop["CODE"] == $id1c):
				return $prop;
			endif;
		endforeach;
		return false;
	}
	/**
	 * [bildArrFields description]
	 * @param  object $obprop
	 * @param  integer $sortKey
	 * @return array
	 */
	protected function bildArrFields($obprop, $sortKey){
		$name = null; $id1c = null;
		$name = $obprop->Наименование;
		$id1c = $obprop->Ид;
		$translitParams = $this->translitParams();
		$arFields = Array(
			"NAME" => (string)$name,
			"ACTIVE" => "Y",
			"SORT" => ($sortKey > 0)? ($sortKey * 10) + 500 : 500,
			"CODE" => (string)$id1c,
			"XML_ID" => CUtil::translit($name, "ru", $translitParams),
			"IBLOCK_ID" => $this->getIblockId(),
			"FILTRABLE" => "Y",
		);
	    if (!empty($obprop->ВариантыЗначений)):
	    	$propValues = $obprop->ВариантыЗначений;
	    	$s = 0;
	    	$arFields["PROPERTY_TYPE"] = "L";
	    	$arFields["MULTIPLE"] = "Y";
	    	$arFields["LIST_TYPE"] = "L"; // Может быть "L" - выпадающий список или "C" - флажки.
	    	foreach ($propValues->Вариант as $listvalue):
	    		if (!empty($listvalue->Ид) && !empty($listvalue->Значение)):
	    			$sort = ($s > 0)? ($s*100)+100 : 100;
			    	$arFields["VALUES"][] = Array(
						"VALUE" => (string)$listvalue->Значение,
						"DEF" => "N",
						"SORT" => $sort,
						"XML_ID" => CUtil::translit($listvalue->Значение, "ru", $translitParams)
					);
					$s++;
	    		endif;
	    	endforeach;
		elseif ($id1c == "IMAGES"):
			$arFields["PROPERTY_TYPE"] = "F";
			$arFields["MULTIPLE"] = "Y";
		elseif ($id1c == "ARTIKUL"):
			$arFields["SEARCHABLE"] = "Y";
		elseif ($id1c == "SORT_NEW" || $id1c == "SORT_SALE"):
			$arFields["PROPERTY_TYPE"] = "N";
		else:
			$arFields["PROPERTY_TYPE"] = "S";
		endif;
		return $arFields;
	}

	protected function delPropertiesInlock($arProperties){
		if (!CModule::IncludeModule("iblock")):
			return false; 
		endif;
		foreach ($arProperties as $key => $prop) :
			if (!CIBlockProperty::Delete($prop["ID"])):
				return false;
			endif;
		endforeach;
		return $res;
	}
	/**
	 * [updateProperties description]
	 * @param  object $obprop
	 * @param  integer $sortKey
	 * @return array
	 */
	protected function updateProperties($obprop, $prop, $sortKey){
		if (!CModule::IncludeModule("iblock")):
			return false; 
		endif;
		$arFields = array();
		$name = null; $id1c = null;
		$name = $obprop->Наименование;
		$id1c = $obprop->Ид;
		$arFields = $this->bildArrFields($obprop, $sortKey);
		$ibp = new CIBlockProperty;
		if(!$ibp->Update($prop['ID'], $arFields)):
			return false;
		endif;
		return true;
	}
	/**
	 * [addProperties description]
	 * @param object $obprop
	 * @return array
	 */
	protected function addProperties($obprop, $sortKey){
		if (!CModule::IncludeModule("iblock")):
			return false; 
		endif;
		$arFields = array();
		$name = null; $id1c = null;
		$name = $obprop->Наименование;
		$id1c = $obprop->Ид;
		if ($prop = $this->findProperties($obprop)):
			return $this->updateProperties($obprop, $prop, $sortKey);
		endif;
		$arFields = $this->bildArrFields($obprop, $sortKey);
		$ibp = new CIBlockProperty;
		$propID = $ibp->Add($arFields);
		if ($propID < 0):
			return false;
		endif;
		return true;
	}
	/**
	 * [readProp description]
	 * @param  object $objProps
	 * @return 
	 */
	public function readProp($objProps){
		$result = false;
		$sortKey = 0;
		$arProperties = $this->getPropertiesIblock();
		// оставляем в массиве arProperties не нужные свойства
		foreach ($arProperties as $key => $prop) :
			foreach ($objProps->Свойство as $obprop):
				if ($prop["CODE"] == $obprop->Ид):
					unset($arProperties[$key]);
				endif;
			endforeach;
		endforeach;
		// удаляем свойства
		$result[] = $this->delPropertiesInlock($arProperties);
		// добавление или обновление свойств
		foreach ($objProps->Свойство as $obprop):
			if ($this->validateProp($obprop)):
				if (!$this->addProperties($obprop, $sortKey)):
					return false;
				endif;
				$sortKey++;
			endif;
		endforeach;
		return true;
	}
}
?>