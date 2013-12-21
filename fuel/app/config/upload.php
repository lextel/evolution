<?php
/**
 * 
 *
 */
return [
    'item' => [
        'path' => DOCROOT.'upload'.DS.'item'.DS.'origin',
        'randomize' => true,
        'ext_whitelist' => ['img', 'jpg', 'jpeg', 'gif', 'png'],
    ],
    'avatar' => [
        'path' => DOCROOT.'upload'.DS.'avatar'.DS.'origin',
        'randomize' => true,
        'ext_whitelist' => ['img', 'jpg', 'jpeg', 'png'],
    ],
    'editor' => [
        'path' => DOCROOT.'upload',
        'randomize' => true,
        'ext_whitelist' => ['img', 'jpg', 'jpeg', 'gif', 'png'],
		    'savePath'   => 'updateSavePath(["upload"]);',
    ],
];
