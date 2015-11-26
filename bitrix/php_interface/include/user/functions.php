<?php
function getUserPhone($idUser){
    if (!CModule::IncludeModule('iblock')):
        return false;
    endif;
    if ($idUser):
        $rsUser = CUser::GetByID($idUser);
        $arUser = $rsUser->Fetch();
        return $arUser["PERSONAL_PHONE"];
    endif;
    return false;
}
/**
 * [getAddressUser description]
 * @param  int $idUser
 * @return string or false
 */
function getAddressUser($idUser){
    if (!CModule::IncludeModule('iblock')):
        return false;
    endif;
    if ($idUser):
        $rsUser = CUser::GetByID($idUser);
        $arUser = $rsUser->Fetch();
        return $arUser["PERSONAL_STREET"];
    endif;
    return false;
}
/**
 * [getSale description]
 * @param  int $idUser
 * @return string or false
 */
function getSaleUser($idUser){
    if (!CModule::IncludeModule('iblock')):
        return false;
    endif;
    if ($idUser):
        $rsUser = CUser::GetByID($idUser);
        $arUser = $rsUser->Fetch();
        return $arUser["UF_SALE"];
    endif;
    return false;
}
/**
 * [upPass description]
 * @param  array $arParams
 * @return bool
 */
function upPass($arParams){
    global $USER;
    $id = $USER->GetID();
    $pass = $arParams["USER_PASSWORD"];
    $confirm_pass = $arParams["USER_CONFIRM_PASSWORD"];
    if (isset($id) && isset($pass) && isset($confirm_pass)):
        $user = new CUser;
        $fields = Array( 
            "PASSWORD" => $pass,
            "CONFIRM_PASSWORD" => $confirm_pass
            );
        if ($user->Update($id, $fields)):
            return true;
        endif;
    endif;
}
/**
 * [unsubscribeUser description]
 * @param  array $arParams
 * @return bool
 */
function unsubscribeUser($arParams){
    CModule::IncludeModule("subscribe");
    $subscr = CSubscription::GetList(
        array("ID"=>"ASC"),
        array("CONFIRMED"=>"Y", "ACTIVE"=>"Y", "ID" => $arParams["ID"])
    );
    if ($arSubUser = $subscr->Fetch()):
        if ($arParams["CONFIRM_CODE"] == $arSubUser["CONFIRM_CODE"]):
            if (CSubscription::Delete($arSubUser["ID"])):
                return true;
            endif;
        endif;
    endif;
    return false;
}
/**
 * [subscribeRegUser description]
 * @param  str $email
 * @return bool
 */
function subscribeRegUser($email){
    //require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    CModule::IncludeModule("subscribe");
    $EMAIL = $email;
    global $USER;
    /* получим значение пользователя */
    if ($USER->IsAuthorized()):
        $USER = $USER->GetID();
    else:
       $USER = NULL ;
    endif;
    /* определим рубрики активные рубрики подписок */
    $RUB_ID = array();
    $rub = CRubric::GetList(array(), array("ACTIVE"=>"Y"));
    while($rub->ExtractFields("r_")):
        $RUB_ID = array($r_ID) ;
    endwhile;
    $RUB_ID = array('0' => '2');
    /* создадим массив на подписку */
    $subscr = new CSubscription;
    $arFields = Array(
        "USER_ID" => $USER,
        "FORMAT" => "html/text",
        "EMAIL" => $EMAIL,
        "ACTIVE" => "Y",
        "RUB_ID" => $RUB_ID,
        "SEND_CONFIRM" => "Y",
        "CONFIRMED" => "Y"
    );
    if ($subscr->Add($arFields)) return true;
    return false;
}

AddEventHandler("main", "OnAfterUserAuthorize", Array("userAuthorized", "OnAfterUserAuthorizeHandler"));

class userAuthorized
{
    // создаем обработчик события "OnAfterUserAuthorize"
    function OnAfterUserAuthorizeHandler($arUser)
    {
        $userId = intval($arUser["ID"]);
        $rsUser = CUser::GetByID($userId);
        $arUser = $rsUser->Fetch();
        $arFavorites = $arUser["UF_FAVORITES"];
        $arSessionFavorites = $_SESSION["FAVORITES_PRODUCTS"];
        if (is_array($arFavorites) && is_array($arSessionFavorites)):
            foreach ($arSessionFavorites as $key => $itemId) :
                if (!in_array($itemId, $arFavorites)):
                    array_push($arFavorites, $itemId);
                endif;
            endforeach;            
        elseif (is_array($arSessionFavorites)):
            $arFavorites = $arSessionFavorites;
        endif;
        $user = new CUser;
        $fields = Array( 
            "UF_FAVORITES" => $arFavorites, 
        );
        if ($user->Update($userId, $fields)):
            $_SESSION["FAVORITES_PRODUCTS"] = $arFavorites;
        endif;
    }
}
?>