<?php
/**
 * The development database settings. These get merged with the global settings.
 */
return array(
    'default' => array(
        'connection'  => array(
            //'dsn'        => 'mysql:host=127.0.0.1;dbname=lltao',
            //'dsn'        => 'mysql:host=192.168.3.10;dbname=llt_dev',
            'dsn'        => 'mysql:host=192.168.3.170;dbname=llt_bro',
            'username'   => 'root',
            'password'   => '1',
        ),
        'profiling' => true,
    ),
);
