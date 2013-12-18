<?php
/**
 * 
 *
 */
return [
	'editor' => [
		'path'   => 'updateSavePath(["upload"]);',
		'config' => [
                'path' => DOCROOT.'upload',
                'randomize' => true,
                'ext_whitelist' => ['img', 'jpg', 'jpeg', 'gif', 'png'],
            ],
	],
];