<?php
return array (
    'exception_handling' =>
        array (
            'value' =>
                array (
                    'debug' => true,
                    'handled_errors_types' =>   E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED,
                    'exception_errors_types' =>   E_ALL & E_NOTICE & ~E_STRICT & ~E_DEPRECATED,
                    'ignore_silence' => false,
                    'assertion_throws_exception' => true,
                    'assertion_error_type' => 256,
                    'log' => array (
                        'settings' =>
                            array (
                                'file' => '/home/bitrix/www/log/exceptions.log',
                                'log_size' => 1000000,
                            ),
                    ),
                ),
            'readonly' => false,
        ),


);