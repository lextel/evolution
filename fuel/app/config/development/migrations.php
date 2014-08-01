<?php
return array(
	'version' => 
	array(
		'app' => 
		array(
			'default' => 
			array(
				0 => '001_create_users',
				1 => '003_create_comments',
				2 => '004_create_cates',
				3 => '005_create_logs',
				4 => '006_create_orders',
				5 => '007_create_member_addresses',
				6 => '008_create_member_moneylogs',
				7 => '009_create_notices',
				8 => '010_create_ads',
				9 => '011_create_member_sms',
				10 => '012_create_posts',
				11 => '013_create_items',
				12 => '015_create_members',
				13 => '016_create_shippings',
				14 => '017_create_member_emails',
				15 => '018_create_shippings',
				16 => '019_create_invitcodes',
				17 => '020_add_is_delete_to_invitcodes',
				18 => '021_create_member_mobiles',
				19 => '023_create_member_invits',
				20 => '024_create_member_brokerages',
				21 => '025_create_gifts',
				22 => '026_create_goods',
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
