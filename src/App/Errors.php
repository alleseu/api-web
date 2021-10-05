<?php

//MANEJO PARA VISTAS DE ERRORES.

$app->error(function (\Exception $e) use ($app) {
    $respuesta = array(
        'titulo' => "ERROR 500",
        'mensaje' => "¡Upps! Hubo un error interno, intentelo de nuevo más tarde."
    );
    $app->render('error', $respuesta);
});

$app->notFound(function () use ($app) {
    $respuesta = array(
        'titulo' => "ERROR 404",
        'mensaje' => "¡Upps! La página que intenta acceder no existe."
    );
    $app->render('error', $respuesta);
});
