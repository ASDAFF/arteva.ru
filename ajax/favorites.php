<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'):
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	/**
	 * $_POST["id"] = id products
	 * $_POST["user"] = id users
	 */
	if (CModule::IncludeModule('iblock')):
		if (!$_POST["user"] && !$_POST["id"]):
			json_encode(array("result" => false));
		elseif ($_POST["action"] == "remove"):
			$result = json_encode(array("result" => false));
			$arFavorites = NULL;
			if ($_POST["id"]):
				$itemId = intval($_POST["id"]);
				if ($_POST["user"]):
			    	$userId = intval($_POST["user"]);
					$arFavorites = getFavoriteItemsId($userId);
					if ($arFavorites):
						if (in_array($itemId, $arFavorites)):
							foreach ($arFavorites as $key => $item) :
								if ($item == $itemId):
									//$arItems[] = $item;
									unset($arFavorites[$key]);
									break;
								endif;
							endforeach;
						endif;
					endif;
					$user = new CUser;
					$fields = Array( 
						"UF_FAVORITES" => $arFavorites, 
					);
					if ($user->Update($userId, $fields)):
						$_SESSION["FAVORITES_PRODUCTS"] = $arFavorites; 
						$result = json_encode(array("result" => true));
					endif;
				else:
					$arFavorites = $_SESSION["FAVORITES_PRODUCTS"];
					if ($arFavorites):
						if (in_array($itemId, $arFavorites)):
							foreach ($arFavorites as $key => $item) :
								if ($item == $itemId):
									unset($arFavorites[$key]);
									break;
								endif;
							endforeach;
						endif;
					endif;
					$_SESSION["FAVORITES_PRODUCTS"] = $arFavorites;
					if (is_array($_SESSION["FAVORITES_PRODUCTS"])):
						$result = json_encode(array("result" => true));
					endif;
				endif;
			endif;
			echo $result;
		else:
			$result = json_encode(array("result" => false));
			$arFavorites = NULL;
			if ($_POST["id"]):
				$itemId = intval($_POST["id"]);
				if ($_POST["user"]):
			    	$userId = intval($_POST["user"]);
			    	$arFavorites = getFavoriteItemsId($userId);
					if ($arFavorites):
						if (!in_array($itemId, $arFavorites)):
							array_push($arFavorites, $itemId);
						endif;
					else:
						$arFavorites = array($itemId);
					endif;
					$user = new CUser;
					$fields = Array( 
						"UF_FAVORITES" => $arFavorites, 
					);
					if ($user->Update($userId, $fields)):
						$_SESSION["FAVORITES_PRODUCTS"] = $arFavorites; 
						$result = json_encode(array("result" => true));
					endif;
				else:
					$arFavorites = $_SESSION["FAVORITES_PRODUCTS"];
					if ($arFavorites):
						if (!in_array($itemId, $arFavorites)):
							array_push($arFavorites, $itemId);
						endif;
					else:
						$arFavorites = array($itemId);
					endif;
					$_SESSION["FAVORITES_PRODUCTS"] = $arFavorites;
					if (is_array($_SESSION["FAVORITES_PRODUCTS"])):
						$result = json_encode(array("result" => true));
					endif;
				endif;
			endif;
			echo $result;
		endif;
	endif;
endif;
?>