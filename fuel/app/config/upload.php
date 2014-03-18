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
        'path' => DOCROOT.'upload',
        'randomize' => true,
        'ext_whitelist' => ['jpg', 'jpeg', 'gif', 'png'],
		    'savePath'   => 'updateSavePath(["upload"]);',
    ],
    'mutilcsv' => [
        'path' => DOCROOT.'upload'.DS.'csv',
        'randomize' => true,
        'ext_whitelist' => ['csv'],
    ],
    'upload' => [
        'auto_process' => true,
    ]
];
