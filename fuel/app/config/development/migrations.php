<?php
return array(
	'version' => 
	array(
		'app' => 
		array(
			'default' => 
			array(
				0 => '001_create_users',
				1 => '002_create_items',
				2 => '003_create_phases',
				3 => '004_create_tasks',
				4 => '005_create_members',
				5 => '006_create_sditems',
				6 => '007_create_friends',
				7 => '008_create_orders',
				8 => '009_create_member_infos',
				9 => '010_create_lotteries',
				10 => '011_create_member_addresses',
				11 => '012_create_posts',
				12 => '013_create_comments',
				13 => '014_create_member_addresses',
				14 => '027_create_cates',
				15 => '031_create_logs',
				16 => '032_create_member_moneylogs',
				17 => '032_create_phases',
				18 => '033_create_member_addresses',
				19 => '034_create_member_addresses',
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
