<?php
//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '<ul class="breadcrumbs">';

for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	if($arResult[$index]["LINK"] <> "" && $index < (count($arResult) - 1))
		$strReturn .= '<li class="bc-item"><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a></li>';
	else
		$strReturn .= '<li class="bc-item"><a>'.$title.'</a></li>';
}

$strReturn .= '</ul>';
return $strReturn;
?>