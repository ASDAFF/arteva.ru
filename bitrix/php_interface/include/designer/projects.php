<?php
/**
 * [getIblockProjects description]
 * @return int id iblock
 */
function getIblockProjects(){
	return 8;
}
/**
 * [removeProjects description]
 * @param  int $id
 * @return bool
 */
function removeProjects($id){
    if (!CModule::IncludeModule('iblock')):
        return false;
    endif;
    return CIBlockElement::Delete($id);
}
/**
 * [getProjects description]
 * @param int $idUser
 * @return  array or false
 */
function getProjects($idUser){
	if (!CModule::IncludeModule('iblock')):
        return false;
    endif;
    if ($idUser):
        $rsUser = CUser::GetByID($idUser);
        $arUser = $rsUser->Fetch();
        if ($arUser["UF_PROJECTS"]):
            foreach ($arUser["UF_PROJECTS"] as $key => $id) :
                $arSelect = Array("NAME", "ID", "PREVIEW_PICTURE", "DETAIL_PAGE_URL");
                $arFilter = Array(
                    "IBLOCK_ID" => getIblockProjects(), 
                    "ACTIVE" => "Y",
                    "ID" => $id
                    );
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                while($ob = $res->GetNextElement())
                {
                    $arItems[] = $ob->GetFields();
                }
                return $arItems;
            endforeach;
        endif;
    endif;
    return false;
}
?>