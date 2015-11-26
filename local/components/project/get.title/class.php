<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main;
use \Bitrix\Main\Localization\Loc as Loc;

class FeedBack extends \CBitrixComponent
{
    protected $modules = array('iblock');

    protected $filter = array();

    /**
     * подготавливает входные параметры
     * @param array $arParams
     * @return array
     */
    public function onPrepareComponentParams($params)
    {
        $result = array(
            'IBLOCK_TYPE' => trim($params['IBLOCK_TYPE']),
            'IBLOCK_ID' => intval($params['IBLOCK_ID']),
        );

        return $result;
    }

    protected function checkModules()
    {
        foreach ($this->modules as $module)
        {
            if(!Main\Loader::includeModule($module))
            {
                throw new Main\LoaderException('молуль инфоблоков не подключен');
            }
        }
    }

    /**
     * проверяет заполнение обязательных параметров
     * @throws SystemException
     */
    protected function checkParams()
    {
        if ($this -> arParams['IBLOCK_ID'] <= 0)
            throw new Main\ArgumentNullException('IBLOCK_ID');

        if (check_bitrix_sessid())
        {
            return false;
        }
    }

    protected function prepareFilter()
    {

    }

    /**
     * получение результатов
     */
    protected function getResult()
    {
        global $APPLICATION;
        $uri = $APPLICATION->GetCurUri();
        $page = $APPLICATION->GetCurPage();

        $filter = Array(
            'IBLOCK_TYPE'=> $this -> arParams['IBLOCK_TYPE'],
            'IBLOCK_ID' => $this -> arParams['IBLOCK_ID'],
            'PREVIEW_TEXT' => $_SERVER['REQUEST_URI'],
            //'PREVIEW_TEXT' => 'привет',
        );

        $select = array(
            'NAME',
            'ID',
            'PREVIEW_TEXT'
        );

        $db_list = CIBlockElement::GetList(Array(), $filter, false, false, $select);

        if($ar_result = $db_list -> Fetch())
        {
            $APPLICATION->SetTitle($ar_result['NAME']);
            return $ar_result['NAME'];
        }else{
            return false;
        }

    }

    /**
     * выполняет логику работы компонента
     */
    public function executeComponent()
    {
        $this -> checkModules();
        $this -> checkParams();
        $this -> title = $this -> getResult();
        return $this -> title;
    }
}
?>
