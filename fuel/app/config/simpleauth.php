<?php

return array(
	'db_connection' => NULL,
	'table_name' => 'users',
	'table_columns' => array(
		0 => '*',
	),
	'guest_login' => true,
	'groups' => array(
		100  => array('name' => 'Administrador', 'roles' => array('admin')),
	),
	'roles' => array(
		// 'admin'  => array('users' => array('create', 'read')),
	),
	'login_hash_salt' => 'phpconf2012',
	'username_post_key' => 'username',
	'password_post_key' => 'password',
);