<?php
return array(
	'version' => 
	array(
		'app' => 
		array(
			'default' => 
			array(
				0 => '002_create_users',
				1 => '003_create_items',
				2 => '017_create_phases',
				3 => '018_create_posts',
				4 => '020_create_accounts',
				5 => '021_create_tasks',
				6 => '022_create_sditems',
				7 => '023_create_friends',
				8 => '024_create_orders',
				9 => '025_create_member_infos',
				10 => '026_create_member_addresses',
			),
		),
		'module' => 
		array(
		),
		'package' => 
		array(
			'auth' => 
			array(
				0 => '001_auth_create_usertables',
				1 => '002_auth_create_grouptables',
				2 => '003_auth_create_roletables',
				3 => '004_auth_create_permissiontables',
				4 => '005_auth_create_authdefaults',
				5 => '006_auth_add_authactions',
				6 => '007_auth_add_permissionsfilter',
				7 => '008_auth_create_providers',
				8 => '009_auth_create_oauth2tables',
				9 => '010_auth_fix_jointables',
			),
		),
	),
	'folder' => 'migrations/',
	'table' => 'migration',
);
