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
				3 => '005_create_members',
				4 => '008_create_orders',
				5 => '009_create_member_infos',
				6 => '010_create_lotteries',
				7 => '011_create_member_addresses',
				8 => '012_create_posts',
				9 => '013_create_comments',
				10 => '014_create_member_addresses',
				11 => '027_create_cates',
				12 => '031_create_logs',
				13 => '032_create_member_moneylogs',
				14 => '032_create_phases',
				15 => '033_create_member_addresses',
				16 => '034_create_member_addresses',
				17 => '040_create_posts',
				18 => '041_create_phases',
				19 => '042_create_items',
				20 => '043_create_notices',
				21 => '044_create_orders',
				22 => '044_create_posts',
				23 => '045_create_lotteries',
				24 => '046_create_notices',
				25 => '047_create_orders',
				26 => '048_create_posts',
				27 => '049_create_ads',
				28 => '050_create_member_sms',
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
