<?php
ini_set("max_execution_time", 3600);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
if (!$USER->isAuthorized() && !in_array(1, $USER->GetUserGroupArray())):
    LocalRedirect("/bitrix/");
else:
  if (!CModule::IncludeModule("iblock")):
      return false;
  endif;
  $i = 0;
  if (($handle = fopen($_SERVER["DOCUMENT_ROOT"].'/upload/fileusers.csv', "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 100000, ";")) !== FALSE) {
          if ($i == 0):
              $arHead = $data;
          else:
              $arValue[] = $data;
          endif;
          $i++;
      }
      fclose($handle);
  }
  foreach ($arValue as $keyuser => $user) :
      foreach ($user as $keyvalue => $value) :
          foreach ($arHead as $keyprop => $prop) :
              if ($keyprop == $keyvalue):
                  $arUser[$prop] = $value;
              endif;
          endforeach;
      endforeach;
      $arUsers[] = $arUser;
  endforeach;
  foreach ($arUsers as $arUser) :
      $user = new CUser;
      $NAME = $arUser["NAME"]." ".$arUser["LAST_NAME"];
      $arFields = Array(
        "NAME"              => trim($NAME),
        "LAST_NAME"         => "",
        "EMAIL"             => trim($arUser["EMAIL"]),
        "LOGIN"             => trim($arUser["EMAIL"]),
        "LID"               => "s1",
        "ACTIVE"            => "N",
        "GROUP_ID"          => array(5),
        "PASSWORD"          => trim($arUser["EMAIL"]),
        "CONFIRM_PASSWORD"  => trim($arUser["EMAIL"]),
      );
      $ID = $user->Add($arFields);
      if (intval($ID) > 0):
          echo "Пользователь: ".$arUser["EMAIL"]." успешно добавлен<br/>";
      else:
          echo $user->LAST_ERROR."<br/>";
      endif;
  endforeach;
endif;
?>