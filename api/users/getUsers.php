<?php
ini_set("max_execution_time", 3600);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
if (!$USER->isAuthorized() && !in_array(1, $USER->GetUserGroupArray())):
    LocalRedirect("/bitrix/");
    exit;
else:
    if (!CModule::IncludeModule("iblock")):
    	return false;
    endif;
    $arFilter = Array(
        "ID" => "",
        "ACTIVE" => "Y",
        "LOGIN" => "",
        "NAME" => "",
        "EMAIL" => "",
        "!GROUPS_ID" => array(1)
    );
    $rsUsers = CUser::GetList(($by = ""), ($order = ""), $arFilter);
    while ($arUser = $rsUsers->Fetch()) {
        $arUsers[] = $arUser;
    }
    if ($arUsers):
        foreach ($arUsers as $key => $arUser) :
            foreach ($arUser as $prop => $value) :
                $arHeaders[$prop] = $prop;
            endforeach;
        endforeach;
        $arHead = array_unique($arHeaders);
        $data = array($arHead);
        foreach ($arUsers as $key => $arUser):
            array_push($data, $arUser);
        endforeach;
        $fp = fopen($_SERVER["DOCUMENT_ROOT"].'/upload/fileusers.csv', 'w');
        foreach ($data as $fields) {
            fputcsv($fp, $fields, ";");
        }
        fclose($fp);
        echo "true";
    else:
        echo "false";
    endif;
endif;
?>