<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'):
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
    if (!CModule::IncludeModule("subscribe")):
        return false;
    endif;
    $result = null;
    if ($_POST["email"] && $_POST["action"] == "add"):
        $EMAIL = $_POST["email"];
        /* получим значение пользователя */
        if ($USER->IsAuthorized()):
            global $USER;
            $USER = $USER->GetID();
        else:
            $USER = NULL;
        endif;
        $subscription = CSubscription::GetByEmail($_POST["email"]);
        if($subscription->ExtractFields("str_")): 
            $ID = (integer)$str_ID;
        endif;
        if ($ID > 0):
            $subscr = new CSubscription;
            if($subscr->Update($ID, array("ACTIVE"=>"Y"))):
                $result = json_encode(
                    array(
                        "result" => true,
                        "value" => "Спасибо, вы подписались на рассылку",
                        "action" => "subscribe"
                    )
                );
            endif;
        else:
            /* определим рубрики активные рубрики подписок */
            $RUB_ID = array();
            $rub = CRubric::GetList(array(), array("ACTIVE" => "Y"));
            while ($rub->ExtractFields("r_")):
                $RUB_ID = array($r_ID);
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
            if ($idsubrscr = $subscr->Add($arFields)):
                $result = json_encode(
                    array(
                        "result" => true,
                        "value" => "Спасибо, вы подписались на рассылку",
                        "action" => "subscribe"
                    )
                );
            else:
                $result = json_encode(
                    array(
                        "result" => false,
                        "value" => "Данный адрес уже был подписан на рассылку",
                        "action" => "subscribe"
                    )
                );
            endif;
        endif;
    elseif ($_POST["email"] && $_POST["action"] == "remove"):
        $subscription = CSubscription::GetByEmail($_POST["email"]);
        if($subscription->ExtractFields("str_")): 
            $ID = (integer)$str_ID;
        endif;
        $subscr = new CSubscription;
        if($subscr->Update($ID, array("ACTIVE"=>"N"))):
            $result = json_encode(
                array(
                    "result" => true,
                    "value" => "Вы отписались на рассылки",
                    "action" => "unsubscribe"
                )
            );
        else:
            $result = json_encode(
                array(
                    "result" => false,
                    "value" => "Произошла ошибка. ПОпробуйте позже",
                    "action" => "unsubscribe"
                )
            );
        endif;
    endif;
    echo $result;
endif;
?>