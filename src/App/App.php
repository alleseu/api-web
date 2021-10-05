<?php

ini_set("display_errors", 1);

//INICIAL LA SESIÓN Y DESHABILITA EL LIMITADOR DE CACHÉ.
session_cache_limiter(false);
session_start();

//SE INCLUYE EL FRAMEWORK SLIM
require __DIR__ . '/../../vendor/autoload.php';

//SE CREA LA APLICACIÓN.
$app = new \Slim\Slim();

require __DIR__ . "/Settings.php";
require __DIR__ . "/Dependencies.php";
require __DIR__ . "/Loggers.php";
require __DIR__ . "/Errors.php";
require __DIR__ . "/Routes.php";
require __DIR__ . "/Models.php";
require __DIR__ . "/Views.php";

//ACTIVA O DESACTIVA EL DETALLE DEL ERROR Y AGREGA LAS VISTAS PERSONALIZADAS.
$app->config(array(
    'debug' => false,
    'view' => new CustomView()
));

//EN CASOS DE ERROR, GENERA UN ARCHIVO LOG O ENVIA EL ERROR POR MAIL A TRAVÉS DE $LOGGER DE MONOLOG
$logger = $app->container->get('logger_files');
$app->getLog()->setWriter($logger);

//SE INICIA LA APLICACIÓN.
$app->run();
