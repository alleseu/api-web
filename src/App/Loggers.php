<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\NativeMailerHandler;
use Monolog\Formatter\LineFormatter;
use Flynsarmy\SlimMonolog\Log\MonologWriter;


$app->container->set('logger_files', function() {

	//El formato de fecha predeterminada es: "Y-m-d\TH:i:sP".
	$dateFormat = "Y-m-d H:i:s";

	//El formato de salida predeterminado es: "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n".
	$output = "[%datetime%] %level_name% %message% %context% %extra%\n";

	//Definición del directorio y nombre de archivo del registrador.
	$directory = __DIR__ . '/../../log/';
	$file = date('Y-m-d') . '.log';

	//Crea el formato.
	$formatter = new LineFormatter($output, $dateFormat, true, true);

	//Crea el manipulador. Registra registros en cualquier secuencia PHP, use esto para archivos de registro.
	$handler = new StreamHandler($directory.$file, Logger::WARNING);
	$handler->setFormatter($formatter);

	//Se manda el manipulador a la matriz de controladores del MonoLogWriter de SlimMonolog.
	$logger = new MonologWriter(array('handlers' => array($handler)));

	return $logger;
});


$app->container->set('logger_mails', function() {

	//El formato de fecha predeterminada es: "Y-m-d\TH:i:sP".
	$dateFormat = "Y-m-d H:i:s";

	//El formato de salida predeterminado es: "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n".
	$output = "[%datetime%] %level_name% %message% %context% %extra%\n";

	//Definición de los correos y asunto.
	$email_to = 'alejandro.sanchez@kastor.cl';
	$email_subject = 'API-CONSERJERÍA: Log de error';
	$email_from = 'soluciones@kastor.cl';

	//Crea el formato.
	$formatter = new LineFormatter($output, $dateFormat, true, true);

	//Crea el manipulador. Envía correos electrónicos utilizando la función mail() de PHP.
	$handler = new NativeMailerHandler($email_to, $email_subject, $email_from, Logger::WARNING);

	$handler->setFormatter($formatter);

	//Se manda el manipulador a la matriz de controladores del MonoLogWriter de SlimMonolog.
	$logger = new MonologWriter(array('handlers' => array($handler)));

	return $logger;
});
