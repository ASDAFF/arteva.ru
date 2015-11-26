<?
// параметры
error_reporting(0);
$dataID = $_REQUEST["SHARE"];
$dataHash = $_REQUEST["HASH"];
$dataURL = 'http://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
$basicURL = 'http://' . $_SERVER["HTTP_HOST"];
$referralUrl = '';

if ($dataID == 4) {
    $referralUrl = $basicURL.'/'.$dataHash;
} else {
    $referralUrl = $basicURL;
}

?>

<?
$result = array(
    array(
        'imgLink' => 'http://' . $_SERVER["HTTP_HOST"].'/upload/sertification/img_sign.jpg',
        'title' => 'Арктическая нефть подождет! Подпиши обращение к президенту России на сайте Часа Земли.',
        'description' => 'В этом году в рамках акции «Час Земли» WWF России проводит кампанию «Время думать иначе», призывая заморозить экологически опасные и дорогостоящие проекты в Арктике. Наш Фонд собирает подписи под обращением к президенту России с просьбой о введении десятилетнего моратория на разработку новых нефтяных месторождений на арктическом шельфе.'
    ),
    array(
        'imgLink' => 'http://' . $_SERVER["HTTP_HOST"].'/upload/sertification/img_candle.jpg',
        'title' => 'Зажги свою свечу на карте Часа Земли - 2015!',
        'description' => 'Час Земли – международная акция, в ходе которой WWF призывает своих сторонников выключить свет и бытовые электроприборы на один час в знак неравнодушия к будущему планеты. В это же время гаснет подсветка самых известных зданий и памятников мира. В этом году Час Земли пройдет в...'
    ),
    array(
        'imgLink' => 'http://' . $_SERVER["HTTP_HOST"].'/upload/sertification/img_join.jpg',
        'title' => 'Я выключу свет в Час Земли. А ты?',
        'description' => 'Час Земли – международная акция, в ходе которой WWF призывает своих сторонников выключить свет и бытовые электроприборы на один час в знак неравнодушия к будущему планеты. В это же время гаснет подсветка самых известных зданий и памятников мира. В этом году Час Земли пройдет в...'
    ),
    array(
        'imgLink' => 'http://' . $_SERVER["HTTP_HOST"].'/upload/sertification/'. $dataHash .'.jpg',
        'title' => 'Я - участник акции Час Земли! А ты?',
        'description' => 'Час Земли – международная акция, в ходе которой WWF призывает своих сторонников выключить свет и бытовые электроприборы на один час в знак неравнодушия к будущему планеты. В это же время гаснет подсветка самых известных зданий и памятников мира. В этом году Час Земли пройдет в...'
    ),
    array(
        'imgLink' => 'http://' . $_SERVER["HTTP_HOST"].'/upload/sertification/img_ambas.jpg',
        'title' => 'Я участвую в конкурсе WWF "Стань послом Часа Земли"!',
        'description' => 'Помогите мне стать послом акции и выиграть призы от WWF! Час Земли – международная акция, в ходе которой WWF призывает своих сторонников выключить свет и бытовые электроприборы на один час в знак неравнодушия к будущему планеты. В этом году Час Земли пройдет в субботу, 28 марта, в 20:30.'
    )
);

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?=$result[$dataID]['title']?></title>
    <meta name="keywords" content="" />
    <meta name="description" content="<?=$result[$dataID]['description']?>" />
    <meta property="og:url" content="<?=$dataURL?>" />
    <meta property="og:site_name" content="WWF" />
    <meta property="og:title" content="<?=$result[$dataID]['title']?>" />
    <meta property="og:description" content="<?=$result[$dataID]['description']?>" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="<?=$result[$dataID]['imgLink']?>" />
</head>
<body>
<div style="display:block;position:relative;width:1px;height:1px;overflow:hidden;">
    <h1><?=$result[$dataID]['title']?></h1>
    <p>
        <img src="<?=$result[$dataID]['imgLink']?>" alt="<?=$result[$dataID]['title']?>" />
        <?=$result[$dataID]['description']?>
    </p>
</div>
<script>location.href="<?=$referralUrl?>";</script>
</body>
</html>