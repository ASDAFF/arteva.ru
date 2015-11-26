<?php
/**
* 
*/
class RemoveFiles
{
	protected function removeDir($dir){
		$searchFiles = scandir($dir);
		array_shift($searchFiles); // удаляем из массива '.'
		array_shift($searchFiles); // удаляем из массива '..'
		if (!is_array($searchFiles) && !$searchFiles):
			rmdir($dir);
		endif;
		return true;
	}
	public function clearUpload(){
		if (!CModule::IncludeModule("iblock")):
			return false;
		endif;
		$res = CFile::GetList(array(), array("MODULE_ID"=>"iblock"));
		while($res_arr = $res->GetNext()){
			$arFilesDB[$res_arr["SUBDIR"]][] = $res_arr["FILE_NAME"];
		}
		foreach ($arFilesDB as $dir => $arFile) :
			$dirUpload = $_SERVER["DOCUMENT_ROOT"]."/upload/".$dir."/"; 
			$arDirUpload = scandir($dirUpload);
			array_shift($arDirUpload); // удаляем из массива '.'
			array_shift($arDirUpload); // удаляем из массива '..'
			$arrayDiff = array_diff($arDirUpload, $arFile);
			if (is_array($arrayDiff)):
				foreach ($arrayDiff as $key => $fileName) :
					$dirUnlinkFiles = $dirUpload.$fileName;
					unlink($dirUnlinkFiles);
				endforeach;
			endif;
			$this->removeDir($dirUpload);
		endforeach;
		return true;
	}	
}
?>