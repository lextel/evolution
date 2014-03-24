<?php
/**
 * 上传配置
 *
 */
return [
    'item' => [
        'path' => DOCROOT.'upload'.DS.'item',
        'randomize' => true,
        'ext_whitelist' => ['jpg', 'jpeg'],
    ],
    'ad' => [
        'path' => DOCROOT.'upload'.DS.'ad',
        'randomize' => true,
        'ext_whitelist' => ['jpg', 'jpeg'],
    ],
    'avatar' => [
        'path' => DOCROOT.'upload'.DS.'avatar',
        'randomize' => true,
        'ext_whitelist' => ['img', 'jpg', 'jpeg', 'png'],
    ],
    'post' => [
        'path' => DOCROOT.'upload'.DS.'post',
        'randomize' => true,
        'ext_whitelist' => ['img', 'jpg', 'jpeg', 'png'],
    ],
    'editor' => [
        'path' => DOCROOT.'upload'.DS.'item'.DS.'desc',
        'randomize' => true,
        'ext_whitelist' => ['jpg', 'jpeg', 'gif', 'png'],
		    'savePath'   => 'updateSavePath(["upload'.DS.'item'.DS.'desc'.'"]);',
    ],
    'mutil' => [
        'path' => DOCROOT.'upload'.DS.'multi',
        'randomize' => false,
        'ext_whitelist' => ['jpg'],
        'auto_rename' => false,
    ],
    'csv' => [
        'path' => DOCROOT.'upload'.DS.'csv',
        'randomize' => false,
        'ext_whitelist' => ['csv'],
        'auto_rename' => false,
    ],
    'upload' => [
        'auto_process' => true,
    ]
];
