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
        private $document_root;
        const SITEMAP_NAME = 'sitemap.xml';

        public function __construct($document_root)
        {
            $this->filename = $document_root . '/' . self::SITEMAP_NAME;
            $this->document_root = $document_root;
        }

        public function build()
        {
            file_put_contents(
                $this->filename,
                '<?xml version="1.0" encoding="UTF-8" ?>
                <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'
            );

            $tree[] = $this->buildDirTree($this->document_root);

            array_walk(
                $tree,
                [
                    'self',
                    'write_tree'
                ]
            );
            file_put_contents(
                $this->filename,
                "\n</urlset>",
                FILE_APPEND
            );
        }

        public static function write_tree($section)
        {

            file_put_contents(
                $_SERVER['DOCUMENT_ROOT'] . '/' . self::SITEMAP_NAME,
                "\n<url>\n<loc>" . $_SERVER['SERVER_NAME'] . $section['dir'] . "</loc>\n<priority>" . $section['PRIORITY'][0] . "</priority>\n</url>",
                FILE_APPEND
            );
            $sec = explode(
                '/',
                $section['dir']
            );
            $sec = $sec[ count($sec) - 2 ];
            if ($sec != '')
            {
                $iblock_tree = self::buildIblockTree(
                    $sec,
                    $section['dir'],
                    $section['PRIORITY']
                );

                array_walk(
                    $iblock_tree,
                    [
                        'self',
                        'write_iblock_tree'
                    ]
                );

            }

            if (count($section['children']) > 0)
            {
                array_walk(
                    $section['children'],
                    [
                        'self',
                        'write_tree'
                    ]
                );
            }
        }

        public static function write_iblock_tree($tree)
        {
            $_SERVER['DOCUMENT_ROOT'] . '/' . self::SITEMAP_NAME;
            file_put_contents(
                $_SERVER['DOCUMENT_ROOT'] . '/' . self::SITEMAP_NAME,
                "\n<url>\n<loc>" . $_SERVER['SERVER_NAME'] . $tree['path'] . "</loc>\n<priority>" . $tree['priority'] . "</priority>\n</url>",
                FILE_APPEND
            );
            if (is_array($tree['children']) && count($tree['children']) > 0)
            {
                $tree['children']['priority'] = $tree['priority'];
                array_walk(
                    $tree['children'],
                    [
                        'self',
                        'write_iblock_tree'
                    ]
                );
            }
        }

        public static function buildIblockTree($code, $path, $priority)
        {
            echo 'path=';
            var_dump($path);
            $sections = [];
            $res = CIBlockSection::GetTreeList(
                ['IBLOCK_CODE' => $code],
                []
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
            $res = CIBlockElement::GetList(
                [],
                [
                    'IBLOCK_CODE' => $code,
                    '!CODE'       => false
                ]
            );
            while ($element = $res->Fetch())
            {
                $sections[ $element['ID'] ] = [
                    'ID'     => $element['ID'],
                    'CODE'   => $element['CODE'],
                    'NAME'   => $element['NAME'],
                    'PARENT' => $element['IBLOCK_SECTION_ID'],
                ];
            }

            /* полное дерево папок инфоблока */

            return self::get_section_children(
                $sections,
                $path,
                $priority
            );
        }

        /* Рекурсивная функция для построения дерева папок */
        public static function get_section_children(&$sections, $path, $priority, $parent = false, $depth = 1)
        {
            $result = [];

            /* Проход по всем элементам массива */
            foreach ($sections AS $id => $item)
            {
                $item['depth'] = $depth;
                /* Уровень вложенности элемента должен совпадат с искомым */
                if ($item['PARENT'] == $parent)
                {
                    $item['path'] = $path . $item['CODE'].'/' ;
                    $item['priority'] = self::getPriority(
                        $priority,
                        $depth
                    );
                    $item['children'] = self::get_section_children(
                        $sections,
                        $item['path'],
                        $priority,
                        $id,
                        $depth + 1
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
                        $children[] = $res;
                    }
                }
            }


            return [
                'dir'      => str_replace(
                        $_SERVER['DOCUMENT_ROOT'],
                        '',
                        $folder
                    ) . '/',
                'PRIORITY' => explode(
                    '/',
                    $arDirProperties['PRIORITY']
                ),
                'children' => $children
            ];
        }

        public static function getPriority(array $priority, $depth)
        {
            $res = ($depth > count($priority) - 1) ? $priority[ count($priority) - 1 ] : $priority[ $depth ];

            return $res;
        }
    }

?>
<pre>
    <? $sitemap = new siteMap($_SERVER['DOCUMENT_ROOT']);
        $sitemap->build();

    ?>
</pre>




