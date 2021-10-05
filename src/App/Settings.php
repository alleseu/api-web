<?php

//CONFIGURACIÓN DE LOS AMBIENTES PARA LA BASE DE DATOS.
$app->container->set('database', function() {
	return (object) array(
		'productivo' => array(
			"DB_HOST" => 'localhost',
			"DB_NAME" => 'api-web',
			"DB_USER" => 'root',
			"DB_PASS" => '',
			"DB_CHAR" => 'utf8'
		),
		'desarrollo' => array(
			"DB_HOST" => 'localhost',
			"DB_NAME" => 'api-web-dev',
			"DB_USER" => 'root',
			"DB_PASS" => '',
			"DB_CHAR" => 'utf8'
		)
	);
});
