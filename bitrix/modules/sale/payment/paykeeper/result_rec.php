<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die("No prolog included");?><?

$iPaymentId = (int)$_POST['id'];
$iUserId = (int)$_POST['clientid'];
$fSum = (float)$_POST['sum'];
$iOrderId = (int)$_POST['orderid'];
$strHash = $_POST['key'];

$APPLICATION->RestartBuffer();

if($iPaymentId == 0)
{
  echo "No payment specified!\n";
  die();
}

$bCorrectPayment = True;


if (!($arOrder = CSaleOrder::GetByID($iOrderId)))
        $bCorrectPayment = False;


if ($bCorrectPayment)
        CSalePaySystemAction::InitParamArrays($arOrder, $arOrder["ID"]);

$strSecretKey =  CSalePaySystemAction::GetParamValue("TMG_PK_SECRET_KEY");

$strCheck = md5($iPaymentId.number_format($fSum, 2, '.', '').$iUserId.$iOrderId.$strSecretKey);

if ($bCorrectPayment && strtoupper($strHash) != strtoupper($strCheck))
        $bCorrectPayment = False;

if($bCorrectPayment)
{
        $arFields = array(
                        "PS_STATUS" => "Y",
                        "PS_STATUS_CODE" => "Success",
                        "PS_STATUS_DESCRIPTION" => "Payment accepted",
                        "PS_STATUS_MESSAGE" => "Payment id: $iPaymentId",
                        "PS_SUM" => $fSum,
                        "PS_CURRENCY" => "",
                        "PS_RESPONSE_DATE" => Date(CDatabase::DateFormatToPHP(CLang::GetDateFormat("FULL", LANG))),
                );

        if ((float)$arOrder["PRICE"] == (float)($fSum))
        {
                CSaleOrder::PayOrder($arOrder["ID"], "Y");
                if(CSaleOrder::Update($arOrder["ID"], $arFields))
                        echo "OK ".md5($iPaymentId.$strSecretKey);
                die();
        }
        else
          die("Incorrect sum");
}
else
  die("Incorrect payment");
?>
