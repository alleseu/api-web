<?php

use App\Models\HobbyModel;
use App\Models\EncuestaModel;


$app->container->set('modelo_hobby', function() use ($app) {
	return new HobbyModel($app->container->get('db'));
});

$app->container->set('modelo_encuesta', function() use ($app) {
	return new EncuestaModel($app->container->get('db'));
});
