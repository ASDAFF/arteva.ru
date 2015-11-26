<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?><?
include(GetLangFileName(dirname(__FILE__)."/", "/payment.php"));

function either($a, $b)  {  if ($a != NULL) return $a; return $b;}

$TMG_PK_SERVER_ADDR = CSalePaySystemAction::GetParamValue("TMG_PK_SERVER_ADDR");

$user_id = (int)$GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["USER_ID"];
$sum = (float)either(
    CSalePaySystemAction::GetParamValue("SHOULD_PAY"), 
    $GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["SHOULD_PAY"]);
$orderid = (int)either(
    CSalePaySystemAction::GetParamValue("ORDER_ID"), 
    $GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["ID"]);
$email = either($GLOBALS["SALE_INPUT_PARAMS"]["PROPERTY"]["EMAIL"], $GLOBALS["SALE_INPUT_PARAMS"]["ORDER"]["USER_EMAIL"]);
$phone = htmlspecialchars($GLOBALS['SALE_INPUT_PARAMS']['PROPERTY']['PHONE']);

// --- BEGIN --- костыль для arteva
$arOrder = getOrder($orderid);
$user_id = $arOrder["ACCOUNT_NUMBER"]; // вместо пользователя передаём номер заказа (не ID)
// --- END ---

$opts = array ("sum"=>$sum, "user_id"=>$user_id);
$payment_parameters = array("clientid"=>$user_id, "orderid"=>$orderid, "sum"=>$sum, "phone"=>$phone, "email"=>$email);
$query = http_build_query($payment_parameters);
$err_num = $err_text = NULL;

$form = QueryGetData($TMG_PK_SERVER_ADDR, 80, "/external/", $query, $err_num, $err_text);

if ($form  == "")
  $form = "<h3>Произошла ошибка при инциализации платежа</h3><p>$err_num: ".htmlspecialchars($err_text)."</p>";
?>
<div id='tmg_pk_form_container'>
<?=$form?>
</div>
