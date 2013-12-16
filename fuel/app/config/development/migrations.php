<?php
return array(
	'version' => 
	array(
		'app' => 
		array(
			'default' => 
			array(
				0 => '001_create_project_entries',
				1 => '003_create_posts',
				2 => '004_create_tests',
				3 => '005_rename_table_users_to_accounts',
				4 => '006_add_bio_to_accounts',
				5 => '007_delete_bio_from_accounts',
				6 => '008_add_topimage_to_posts',
				7 => '009_add_images_to_posts',
				8 => '012_rename_table_accounts_to_users',
				9 => '013_delete_topimage_from_posts',
				10 => '014_add_topimage_to_posts',
				11 => '015_create_adminsms',
				12 => '016_delete_group_from_users',
				13 => '017_add_group_to_users',
				14 => '019_create_accouts',
				15 => '021_create_tasks',
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
