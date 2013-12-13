<?php
return array(
	'version' => 
	array(
		'app' => 
		array(
			'default' => 
			array(
				0 => '001_create_project_entries',
				1 => '002_create_users',
				2 => '003_create_items',
				3 => '015_create_adminsms',
				4 => '016_create_posts',
				5 => '017_create_phases',
				6 => '005_rename_table_users_to_accounts',
				7 => '006_add_bio_to_accounts',
				8 => '007_delete_bio_from_accounts',
				9 => '008_add_topimage_to_posts',
				10 => '009_add_images_to_posts',
				11 => '012_rename_table_accounts_to_users',
				12 => '013_delete_topimage_from_posts',
				13 => '014_add_topimage_to_posts',
				14 => '015_create_adminsms',
				15 => '016_delete_group_from_users',
				16 => '017_add_group_to_users',
				17 => '020_create_accounts',
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
