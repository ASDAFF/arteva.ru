<?
$_SERVER["DOCUMENT_ROOT"] = "/var/www/vhosts/arteva.ru/httpdocs";

$xml = "qweasdzxc123" . date("Y-m-d G:i:s");
file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/cronlog.php", $xml);











