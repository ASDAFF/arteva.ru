<?php
    /**
     * Created by PhpStorm.
     * User: Asus-
     * Date: 24.11.2015
     * Time: 18:12
     */
    include($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

    CModule::IncludeModule('iblock');

    class siteMap
    {

        private $filename;
        const SITEMAP_NAME = 'sitemap.xml';

        public function __construct($document_root)
        {
            $this->filename=$document_root .'/'. self::SITEMAP_NAME;
        }

        public function build()
        {
            file_put_contents(
                $this->filename,
                '<?xml version="1.0" encoding="UTF-8" ?>
                <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
                      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                            xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                                        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'
            );

            $tree = $this->buildDirTree();
            array_map(
                'write',
                $tree
            );
            function write($section)
            {
                file_put_contents(
                    $this->filename,'<url><loc>'.$_SERVER['SERVER_NAME'].$section['dir'].'</loc><priority>'.$section['PRIORITY'].'</priority></url>',FILE_APPEND);
            }
        }


        public static function buildIblockTree($code)
        {
            $sections = [];
            $res = CIBlockSection::GetTreeList(
                [],
                ['IBLOCK_CODE' => $code]
            );
            while ($section = $res->Fetch())
            {
                $sections[ $section['ID'] ] = [
                    'ID'     => $section['ID'],
                    'CODE'   => $section['CODE'],
                    'NAME'   => $section['NAME'],
                    'PARENT' => $section['IBLOCK_SECTION_ID'],
                ];
            }

            /* полное дерево папок инфоблока */

            return self::get_section_children($sections);
        }

        /* Рекурсивная функция для построения дерева папок */
        public static function get_section_children(&$sections, $parent = false)
        {
            $result = [];

            /* Проход по всем элементам массива */
            foreach ($sections AS $id => $item)
            {
                /* Уровень вложенности элемента должен совпадат с искомым */
                if ($item['PARENT'] == $parent)
                {
                    $item['children'] = self::get_section_children(
                        $sections,
                        $id
                    );
                    $result[ $item['CODE'] ] = $item;
                }
            }

            return $result;
        }


        public static function buildDirTree($folder)
        {
            $arDirProperties = [];
            /* Получаем полный список файлов и каталогов внутри $folder */
            $files = scandir($folder);
            if (!in_array(
                    '.section.php',
                    $files
                ) || !in_array(
                    'index.php',
                    $files
                )
            ) return false;
            include($folder . '/.section.php');
            $result[] = [
                'dir'      => str_replace(
                        $_SERVER['DOCUMENT_ROOT'],
                        '',
                        $folder
                    ) . '/',
                'PRIORITY' => explode(
                                  '/',
                                  $arDirProperties['PRIORITY']
                              )[0]
            ];

            foreach ($files as $file)
            {
                /* Отбрасываем текущий и родительский каталог */
                if (($file == '.') || ($file == '..')) continue;
                $f0 = $folder . '/' . $file; //Получаем полный путь к файлу
                /* Если это директория */
                if (is_dir($f0))
                {
                    $res = self::buildDirTree(
                        $f0
                    );
                    if ($res)
                    {
                        $result [] = $res;
                    }
                }
            }

            return $result;
        }
    }

?>
<pre>
    <? $sitemap= new siteMap($_SERVER['DOCUMENT_ROOT']);
        var_dump($sitemap); ?>
</pre>




