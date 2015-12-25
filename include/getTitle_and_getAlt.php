<?
	function getTitle($arItem)
	{
		$title = $arItem["PREVIEW_PICTURE"]["TITLE"];
		if($title == "" || $title == "8")
			return $arItem["NAME"];

		return $title;
	}

    function getAlt($arItem)
    {
        $title = $arItem["PREVIEW_PICTURE"]["ALT"];
        if($title == "" || $title == "8")
            return $arItem["NAME"];

        return $title;
    }
?>