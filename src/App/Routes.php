<?php

//ENDPOINTS PARA LA GESTIÓN DE LA ENCUESTA Y REPORTE.

$app->get('/', function () use ($app) {

    //LIBERA LAS VARIABLE DE SESIÓN Y LAS DESTRUYE.
    session_unset();
    session_destroy();

    //REDIRECCIONA AL ENDPOINT PARA MOSTRAR LA ENCUESTA.
    $app->response->redirect("/api-web/encuesta", 303);
});

$app->get('/encuesta', 'App\Controllers\EncuestaController:mostrar');
$app->post('/encuesta', 'App\Controllers\EncuestaController:registrar');
$app->post('/reporte/graficos', 'App\Controllers\ReporteController:obtenerDataGraficos');
$app->post('/reporte/tabla', 'App\Controllers\ReporteController:obtenerDataTabla');
