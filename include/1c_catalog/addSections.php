<?php
/**
 * 
 */
class AddSectionIblock
{
	/**
	 * [$arSectionsIblock description]
	 * @var array
	 */
	protected $arSectionsIblock = array();
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
			"change_case" => "L", // буквы преобразуются к нижнему регистру
			"replace_space" => "-", // меняем пробелы на нижнее подчеркивание
			"replace_other" => "", // меняем левые символы на нижнее подчеркивание
			"delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
			"use_google" => "false", // отключаем использование google
	    );
	}
	/**
	 * [delSection description]
	 * @param  int $id
	 * @return bool
	 */
	protected function delSection($id){
		return CIBlockSection::Delete($id);
	}
	/**
	 * [getSections description]
	 * @return array sections catalog iblock
	 */
	protected function getSectionsIblock(){
		if (!CModule::IncludeModule("iblock")):
			return array("result" => false);
		endif;
		$arFilter = Array('IBLOCK_ID'=>$this->getIblockId(), 'GLOBAL_ACTIVE'=>'Y');
		$db_list = CIBlockSection::GetList(Array("SORT" => "ASC"), $arFilter, true);
		while($ar_result = $db_list->GetNext())
		{
			$arSections[] = $ar_result;
		}
		$this->arSectionsIblock = $arSections;
	}
	/**
	 * [findSection description]
	 * @param  string $name
	 * @return int
	 */
	protected function findSection($name){
		if (!CModule::IncludeModule("iblock")):
			return array("result" => false);
		endif;
		$translitParams = $this->translitParams();
		$arFilter = Array('IBLOCK_ID'=>$this->getIblockId(), "NAME" => $name, "CODE" => CUtil::translit($name, "ru", $translitParams));
		$db_list = CIBlockSection::GetList(Array(), $arFilter, true);
		while($ar_result = $db_list->GetNext())
		{
			return intval($ar_result["ID"]);
		}
	}
	/**
	 * [addSectionIblock description]
	 * @param  object $section
	 * @param  int $lvl
	 * @return array
	 */
	protected function addSection($section, $lvl, $idParent, $sort){
		if (!CModule::IncludeModule("iblock")):
			return array("result" => false);
		endif;
		$bs = new CIBlockSection;
		$IBLOCK_ID = 17;
		$NAME = $section->Наименование;
		$id1c = $section->Ид;
		$ID = $this->findSection($NAME);
		$translitParams = $this->translitParams();
		$arFields = Array(
			"ACTIVE" => "Y",
			"IBLOCK_SECTION_ID" => $idParent,
			"IBLOCK_ID" => $this->getIblockId(),
			"NAME" => $NAME,
			"CODE" => CUtil::translit($NAME, "ru", $translitParams),
			"DEPTH_LEVEL" => $lvl,
			"SORT" => $sort,
			"UF_1C_ID" => $id1c,
			"PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/upload/1c_catalog/".$section->Картинка)
			);
		if($ID <= 0):
			$ID = $bs->Add($arFields);
			$res = ($ID>0);
		else:
			$res = $bs->Update($ID, $arFields);
		endif;
		if(!$res):
			return array("result" => false);
		else:
			return array("result" => true, "id" => $ID);
		endif;
	}
	/**
	 * [bildSections description]
	 * @param  object $section
	 * @param  int $lvl
	 * @return array
	 */
	protected function bildSections($section, $lvl, $idParent){
		$s = intval($lvl);
		$i = 1;
		foreach ($section->Группа as $sec) :
			//set_time_limit(10);
			$sort = $sec->CML2_SORT;
			$code = CUtil::translit($sec->Наименование, "ru", $this->translitParams());
			foreach ($this->arSectionsIblock as $key => $arSections) :
				if ($code == $arSections["CODE"] && $idParent == $arSections["IBLOCK_SECTION_ID"]):
					unset($this->arSectionsIblock[$key]);
				endif;
			endforeach;
			$rec = $this->addSection($sec, $s, $idParent, $sort);
			if ($rec["result"] === true):
				$result[] = $rec;
				if (!empty($sec->Группы) && isset($sec->Группы)):
					$s++;
					$this->bildSections($sec->Группы, $s, $rec["id"]);
				endif;
			endif;
			$i++;
		endforeach;
		return $result;
	}
	/**
	 * [readSection description]
	 * @param  object $objSection
	 * @return array
	 */
	public function readSection($objSection){
		$this->getSectionsIblock();
		$bool = false;
		// добавление (обновление) разделов каталога
		$result = $this->bildSections($objSection, 1, 0);
		// удаление разделов каталога, которых нет в выгрузке
		foreach ($this->arSectionsIblock as $key => $arSections) :
			$this->delSection($arSections["ID"]);
		endforeach;
		// проверка результатов
		if (is_array($result)):
			$bool = true;
		endif;
		return $bool;
	}
}
?>