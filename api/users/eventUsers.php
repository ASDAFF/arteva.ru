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
        "ACTIVE" => "N",
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
        $user = new CUser;
        $fields = Array( 
            "ACTIVE" => "Y", 
            );
        if ($user->Update($arUser["ID"], $fields)):
            if (CUser::SendUserInfo($arUser["ID"], SITE_ID, "")):
                echo "Сообщение отправлено на email:".$arUser["EMAIL"]."<br/>";
            else:
                echo $user->LAST_ERROR."<br/>";
            endif;
        endif;
    else:
        echo "false";
    endif;
endif;
?>