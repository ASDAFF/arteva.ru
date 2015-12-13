<?php 
    /**
     * Created by PhpStorm. 
     * User: Asus-
     * Date: 24.11.2015
     * Time: 18:12
    */

      function chm($folder)
        {
            /* Получаем полный список файлов и каталогов внутри $folder */
            $files = scandir($folder);

            foreach ($files as $file)
            {
                /* Отбрасываем текущий и родительский каталог */
                if (($file == '.') || ($file == '..')) continue;
                $f0 = $folder . '/' . $file; //Получаем полный путь к файлу
                var_dump(chmode($f0,0777));
                /* Если это директория */
                if (is_dir($f0))
                {
                    $res = chm(
                        $f0
                    );
                    if ($res)
                    {
                        $result [] = $res;
                    }
                }
            }
        }

chm($_SERVER['DOCUMENT_ROOT']);





