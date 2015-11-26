<?php
/**
 * [getFavoriteItemsId description]
 * @param  int $idUser
 * @return array or false
 */
function getFavoriteItemsId($idUser){
    if (!CModule::IncludeModule('iblock')):
        return false;
    endif;
    if (intval($idUser) > 0):
        $rsUser = CUser::GetByID($idUser);
        $arUser = $rsUser->Fetch();
        if ($arUser["UF_FAVORITES"]):
            foreach ($arUser["UF_FAVORITES"] as $key => $id) :
                $arSelect = Array("ID");
                $arFilter = Array("IBLOCK_ID" => 17, "ACTIVE" => "Y", "ID" => $id);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                if($ob = $res->GetNextElement()):
                    $item = $ob->GetFields();
                    $arItemsActive[] = $item["ID"];
                endif;
            endforeach;
            return $arItemsActive;
        endif;
    else:
        if ($_SESSION["FAVORITES_PRODUCTS"]):
            foreach ($_SESSION["FAVORITES_PRODUCTS"] as $key => $id) :
                $arSelect = Array("ID");
                $arFilter = Array("IBLOCK_ID" => 17, "ACTIVE" => "Y", "ID" => $id);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                if($ob = $res->GetNextElement()):
                    $item = $ob->GetFields();
                    $arItemsActive[] = $item["ID"];
                endif;
            endforeach;
            return $arItemsActive;
        endif;
    endif;
    return false;
}
/**
 * [getFavoriteProducts description]
 * @param  array $arFavorites
 * @return array products
 */
function getFavoriteProducts($arFavorites){
    global $USER;
    foreach ($arFavorites as $key => $id) :
        $arSelect = Array();
        $arFilter = Array("IBLOCK_ID" => 17, "ACTIVE" => "Y", "ID" => $id);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        if($ob = $res->GetNextElement()):
            $arItems = $ob->GetFields();
            $arItems["PROPERTIES"] = $ob->GetProperties();
            $dbPrice = CPrice::GetList(
                array("QUANTITY_FROM" => "ASC", "QUANTITY_TO" => "ASC", "SORT" => "ASC"),
                array("PRODUCT_ID" => $arItems["ID"]),
                false,
                false,
                array("ID", "CATALOG_GROUP_ID", "PRICE", "CURRENCY", "QUANTITY_FROM", "QUANTITY_TO")
                );
            if($arPrice = $dbPrice->Fetch()):
                $arDiscounts = CCatalogDiscount::GetDiscountByPrice($arPrice["ID"], $USER->GetUserGroupArray(), "N", SITE_ID);
                $discountPrice = CCatalogProduct::CountPriceWithDiscount($arPrice["PRICE"], $arPrice["CURRENCY"], $arDiscounts);
                $arPrice["DISCOUNT_VALUE"] = $discountPrice;
                $arItems["PRICES"] = $arPrice;
            endif;
        endif;
        if ($arItems):
            $arFav[] = $arItems;
        endif;
    endforeach;
    return $arFav;
}
/**
 * [getFavorites description]
 * @param  int $idUser
 * @return array
 */
function getFavorites($idUser){
    if ($idUser && CModule::IncludeModule('iblock')):
        $rsUser = CUser::GetByID(intval($idUser));
        $arUser = $rsUser->Fetch();
        if ($arUser["UF_FAVORITES"]):
            return array(
                "result" => true,
                "items" => $arUser["UF_FAVORITES"]
                );
        endif;
    endif;
    return array("result" => false);
}
?>