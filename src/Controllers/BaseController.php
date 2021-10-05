<?php namespace App\Controllers;


abstract class BaseController {
	protected $app;
	protected $container;
	protected $response;  // Returns instance of \Slim\Http\Response
	protected $request;  // Returns instance of \Slim\Http\Request


	//CONSTRUCTOR DEL CONTROLADOR.
	public function __construct() {

		global $app;
		$this->app = $app;
		$this->container = $app->container;
		$this->response = $app->response;
		$this->request = $app->request;
	}


	//FUNCIÓN QUE VÁLIDA QUE LOS PARÁMETROS NO SEAN NULOS.
	protected function validarParametrosNoNulo($claves, $valores) {

		//Se define el arreglo para los parámetros vacíos.
		$parametros = array();

		foreach ($claves as $clave) {
			if (empty($valores[$clave])) {
				$parametros[] = $clave;
			}
		}

		//Obtiene la cantidad de parámetros vacíos.
		$cantidad = count($parametros);

		switch ($cantidad) {
			case 0:
				$respuesta['resultado'] = true;
				break;

			case 1:
				$respuesta['resultado'] = false;
				$respuesta['error'] = 'Parámetro nulo. El parámetro '. $parametros[0] .' está vacío.';
				break;

			default:
				//Une los elementos del arreglo en un string, y los separa por coma.
				$string_parametros = implode(", ", $parametros);

				$respuesta['resultado'] = false;
				$respuesta['error'] = 'Parámetro nulo. Los parámetros: '. $string_parametros .' están vacíos.';
				break;
		}

		return $respuesta;
	}


	//FUNCIÓN QUE VÁLIDA LA CANTIDAD MÁXIMA DE CARÁTERES PERMITIDOS PARA LOS PARÁMETROS.
	protected function validarLargoParametros($claves_largos, $valores) {

		//Se define el arreglo para los parámetros con largos no permitidos y el arreglo para las cantidades de carácteres permitidos como máximo.
		$parametros = array();
		$caracteres = array();

		foreach ($claves_largos as $clave => $largo) {

			//Solo si el parámetro no está vacío, comprueba su longitud.
			if (!empty($valores[$clave])) {

				if(strlen($valores[$clave]) > $largo) {
					$parametros[] = $clave;
					$caracteres[] = $largo;
				}
			}
		}

		//Obtiene la cantidad de parámetros con largos no permitidos.
		$cantidad = count($parametros);

		switch ($cantidad) {
			case 0:
				$respuesta['resultado'] = true;
				break;

			case 1:
				$respuesta['resultado'] = false;
				$respuesta['error'] = 'Longitud inválida. El parámetro '. $parametros[0] .' permite '. $caracteres[0] .' carácteres como máximo.';
				break;

			default:
				//Une los elementos de los arreglos en strings, y los separa por coma.
				$string_parametros = implode(", ", $parametros);
				$string_caracteres = implode(", ", $caracteres);

				$respuesta['resultado'] = false;
				$respuesta['error'] = 'Longitud inválida. Los parámetros: '. $string_parametros .'; permiten como máximo: '. $string_caracteres .' carácteres respectivamente.';
				break;
		}

		return $respuesta;
	}


	//FUNCIÓN QUE VÁLIDA LOS PARÁMETROS DE TIPO NUMÉRICO.
	protected function validarParametrosNumericos($claves, $valores) {

		//Se define el arreglo para los parámetros no numéricos.
		$parametros = array();

		foreach ($claves as $clave) {

			//Solo si el parámetro no está vacío, comprueba si es numérico.
			if (!empty($valores[$clave])) {

				settype($valores[$clave], "string");

				if (!ctype_digit($valores[$clave])) {
					$parametros[] = $clave;
				}
			}
		}

		//Obtiene la cantidad de parámetros no numéricos.
		$cantidad = count($parametros);

		switch ($cantidad) {
			case 0:
				$respuesta['resultado'] = true;
				break;

			case 1:
				$respuesta['resultado'] = false;
				$respuesta['error'] = 'Parámetro inválido. El parámetro '. $parametros[0] .' no es númerico.';
				break;

			default:
				//Une los elementos del arreglo en un string, y los separa por coma.
				$string_parametros = implode(", ", $parametros);

				$respuesta['resultado'] = false;
				$respuesta['error'] = 'Parámetro inválido. Los parámetros: '. $string_parametros .' no son numéricos.';
				break;
		}

		return $respuesta;
	}


	//FUNCIÓN QUE VÁLIDA SI VALOR ESTÁ EN EL RANGO PERMITIDO PARA CADA PARÁMETRO.
	protected function validarRangoParametrosNumericos($claves_rangos, $valores) {

		//Se define el arreglo para los parámetros con rangos erroneos y el arreglo para los rangos permitidos.
		$parametros = array();
		$rangos = array();

		foreach ($claves_rangos as $clave => $rango) {

			//Solo si el parámetro no está vacío, comprueba su rango.
			if (!empty($valores[$clave])) {
				if ($valores[$clave] < $rango[0] || $valores[$clave] > $rango[1]) {
					$parametros[] = $clave;
					$rangos[] = implode(", ", $rango);
				}
			}
		}

		//Obtiene la cantidad de parámetros con rangos erroneos.
		$cantidad = count($parametros);

		switch ($cantidad) {
			case 0:
				$respuesta['resultado'] = true;
				break;

			case 1:
				$respuesta['resultado'] = false;
				$respuesta['error'] = 'Rango inválido. El parámetro '. $parametros[0] .' tiene un rango entre '. $rangos[0] .'.';
				break;

			default:
				//Une los elementos de los arreglos en strings, y los separa por coma.
				$string_parametros = implode(", ", $parametros);
				$string_rangos = implode("; ", $rangos);

				$respuesta['resultado'] = false;
				$respuesta['error'] = 'Rango inválido. Los parámetros: '. $string_parametros .'; tienen rangos entre: '. $string_rangos .' respectivamente.';
				break;
		}

		return $respuesta;
	}


	//FUNCIÓN QUE VÁLIDA UNA FECHA EN FUNCIÓN A SU FORMATO PREDETERMINADO O ENVIADO POR PARÁMETRO.
	private function validarFecha($fecha, $formato='Y-m-d H:i:s') {

		//Analiza una cadena de fecha según un formato especificado.
		$date_time = date_create_from_format($formato, $fecha);
		return $date_time && date_format($date_time, $formato) == $fecha;
	}


	//FUNCIÓN QUE VÁLIDA LOS PARÁMETROS DE TIPO FECHA.
	protected function validarParametrosFechas($claves, $valores) {

		//Se define el arreglo para los parámetros de fechas no válidas.
		$parametros = array();

		foreach ($claves as $clave) {

			//Solo si el parámetro no está vacío, comprueba si la fecha es válida.
			if (!empty($valores[$clave])) {

				//LLAMA A LA FUNCIÓN QUE VÁLIDA UNA FECHA EN FUNCIÓN A SU FORMATO PREDETERMINADO O ENVIADO POR PARÁMETRO.
				$booleano = $this->validarFecha($valores[$clave]);

				if (!$booleano) {
					$parametros[] = $clave;
				}
			}
		}

		//Obtiene la cantidad de parámetros de fechas no válidas.
		$cantidad = count($parametros);

		switch ($cantidad) {
			case 0:
				$respuesta['resultado'] = true;
				break;

			case 1:
				$respuesta['resultado'] = false;
				$respuesta['error'] = 'Parámetro inválido. El parámetro '. $parametros[0] .' no es una fecha válida.';
				break;
				
			default:
				//Une los elementos del arreglo en un string, y los separa por coma.
				$string_parametros = implode(", ", $parametros);

				$respuesta['resultado'] = false;
				$respuesta['error'] = 'Parámetro inválido. Los parámetros: '. $string_parametros .' no son fechas válidas.';
				break;
		}

		return $respuesta;
	}


	//FUNCIÓN QUE VÁLIDA EL INTERVALO ENTRE DOS PARÁMETROS DE TIPO FECHA.
	protected function validarIntervaloParametrosFechas($clave1, $clave2, $valores) {

		if ($valores[$clave1] <= $valores[$clave2]) {
			$respuesta['resultado'] = true;
		}
		else {
			$respuesta['resultado'] = false;
			$respuesta['error'] = 'Intervalo de fecha inválido. El parámetro '. $clave1 .' debe ser menor o igual al parámetro '. $clave2 .'.';
		}

		return $respuesta;
	}


	//FUNCIÓN QUE VÁLIDA EL FORMATO DEL CORREO ELECTRÓNICO.
	protected function validarCorreo($correo) {

		//Comprueba que el correo tenga el formato correcto y que sea válido por la función especial de PHP.
		if (preg_match("/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/", $correo) && filter_var($correo, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		else {
			return false;
		}
	}


	//FUNCIÓN QUE GENERA UN CÓDIGO RANDOM DE UNA LONGITUD ESPECÍFICA PARA CONTRASEÑAS Y TOKEN.
	protected function generarCodigoRandom($longitud, $codigo="") {

		$caracteres = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-";

		for ($x=0; $x < $longitud; $x++) {

			$random = rand(0, strlen($caracteres)-1);
			$codigo .= substr($caracteres, $random, 1);
		}

		return $codigo;
	}
}