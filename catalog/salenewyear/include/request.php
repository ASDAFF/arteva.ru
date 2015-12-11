<?php 

$success_mess = "";
if(
	isset($_POST["name"]) && !empty($_POST["name"]) &&
	isset($_POST["phone"]) && !empty($_POST["phone"]) &&
	isset($_POST["comment"]) && !empty($_POST["comment"])
)
{
	CModule::IncludeModule('iblock');
	$el = new CIBlockElement;

	$arLoadProductArray = Array(
		"IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
		"IBLOCK_ID"      => 35,
		// "PROPERTY_VALUES"=> $PROP,
		"DATE_ACTIVE_FROM" => date('d.m.Y H:i:s'),
		"NAME"           => $_POST["name"],
		"ACTIVE"         => "N",            // активен
		"PREVIEW_TEXT"   => $_POST["comment"],
		"CODE"   => $_POST["phone"],
		"DETAIL_TEXT"    => ""
	);

	if($PRODUCT_ID = $el->Add($arLoadProductArray)){
		$success_mess = "<span class='success_mess'>Спасибо! Ваша заявка принята</span>";
		
		$arEventField = array(
			"NAME" => $_POST["name"],
			"PHONE" => $_POST["phone"],
			"COMMENT" => $_POST["comment"]
		);
		CEvent::SendImmediate("REQUEST_CALL_BACK", "s1", $arEventField, "N", 47);
	}

	
}
if(
	isset($_POST["name"]) && 
	isset($_POST["phone"]) &&
	isset($_POST["comment"])
){
	if(empty($_POST["name"])) $name_empt = true;
	if(empty($_POST["phone"])) $phone_empt = true;
	if(empty($_POST["comment"])) $comment_empt = true;
}
if( 
	isset($_POST["emailsend"]) && !empty($_POST["emailsend"])
)
{
	CModule::IncludeModule('iblock');
	$el = new CIBlockElement;

	$arLoadProductArray = Array(
		"IBLOCK_SECTION_ID" => false,
		"IBLOCK_ID"      => 36,
		// "PROPERTY_VALUES"=> $PROP,
		"DATE_ACTIVE_FROM" => date('d.m.Y H:i:s'),
		"NAME"           => $_POST["emailsend"],
		"ACTIVE"         => "N",
		"DETAIL_TEXT"    => ""
	);

	if($PRODUCT_ID = $el->Add($arLoadProductArray))
		$success_mess_email_send = "<span class='success_mess'>Спасибо! Ваша заявка принята</span>";
	
		?>
	<script>
		rrApiOnReady.push(function() { rrApi.setEmail("<?=$_POST["emailsend"]?>");	});
	</script>
	<?
}