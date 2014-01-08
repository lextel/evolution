<?php
return array(
	'version' => 
	array(
		'app' => 
		array(
			'default' => 
			array(
				0 => '001_create_users',
				1 => '005_create_members',
				2 => '013_create_comments',
				3 => '027_create_cates',
				4 => '031_create_logs',
				5 => '032_create_member_moneylogs',
				6 => '034_create_member_addresses',
				7 => '041_create_phases',
				8 => '042_create_items',
				9 => '046_create_notices',
				10 => '047_create_orders',
				11 => '048_create_posts',
				12 => '049_create_ads',
				13 => '050_create_member_sms',
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
