<?php

//CONEXIÓN PARA LA BASE DE DATOS.
$app->container->set('db', function() use ($app) {

	$setting = $app->container->get('database')->productivo;
	
	$DB_HOST = $setting['DB_HOST'];
	$DB_NAME = $setting['DB_NAME'];
	$DB_USER = $setting['DB_USER'];
	$DB_PASSWORD = $setting['DB_PASS'];
	$DB_CHARSET = $setting['DB_CHAR'];

	$DSN = "mysql:host=". $DB_HOST .";dbname=". $DB_NAME .";charset=". $DB_CHARSET;
	
	$options = array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	);

	return new PDO($DSN, $DB_USER, $DB_PASSWORD, $options);
});
