<?
	function getTitle($arItem)
	{
		$title = $arItem["PREVIEW_PICTURE"]["TITLE"];
		if($title == "")
			return $arItem["NAME"];

		return $title;
	}

    function getAlt($arItem)
    {
        $title = $arItem["PREVIEW_PICTURE"]["ALT"];
        if($title == "")
            return $arItem["NAME"];

        return $title;
    }
?>