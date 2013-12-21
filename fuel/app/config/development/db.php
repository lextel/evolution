<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
    'default' => array(
        'connection'  => array(
            'dsn'        => 'mysql:host=localhost;dbname=llt_dev',
            'username'   => 'root',
            'password'   => '1',
        ),
        'profiling' => true,
    ),
);
