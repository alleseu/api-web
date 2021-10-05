<?php namespace App\Controllers;

use App\Controllers\BaseController;


class EncuestaController extends BaseController {

	//FUNCIÓN PARA PROCESAR LA VISUALICACIÓN DE LA ENCUESTA.
	public function mostrar() {

        //COMPRUEBA SI DEBE MOSTRAR LA VISTA DE LA ENCUESTA O REPORTE.
        if (isset($_SESSION['reporte_ok'])) {

            $respuesta = array(
                'titulo' => "REPORTE"
            );
            $this->app->render('reporte', $respuesta);
        }
        else {

            //LLAMA A LA FUNCIÓN QUE OBTIENE TODOS LOS HOBBY REGISTRADOS.
            $data = $this->container->get('modelo_hobby')->obtenerTodo();

            if (!empty($data)) {

                $respuesta = array(
                    'titulo' => "ENCUESTA",
                    'hobbys' => $data
                );
                $this->app->render('encuesta', $respuesta);
            }
            else {

                $respuesta = array(
                    'titulo' => "ERROR 400",
                    'mensaje' => "No existen Hobbys registrados."
                );
                $this->app->render('error', $respuesta);
            }
        }
	}


    //FUNCIÓN PARA PROCESAR EL REGISTRO DE LA ENCUESTA.
	public function registrar() {

        //Se obtienen los parámetros enviados por método POST.
        $post = $this->request->post();

        //Se define arreglo con las claves de los parámetros a validar.
		$claves = array('nombre', 'genero', 'hobby');

		//LLAMA A LA FUNCIÓN QUE VÁLIDA QUE LOS PARÁMETROS NO SEAN NULOS.
		$validacion_nonulo = $this->validarParametrosNoNulo($claves, $post);

		if ($validacion_nonulo['resultado']) {

            //Se define arreglo con las claves de los parámetros y su cantidad máxima de carácteres permitidos.
            $claves = array('nombre' => 100);

            //LLAMA A LA FUNCIÓN QUE VÁLIDA LA CANTIDAD MÁXIMA DE CARÁTERES PERMITIDOS PARA LOS PARÁMETROS.
            $validacion_largo = $this->validarLargoParametros($claves, $post);

            if ($validacion_largo['resultado']) {

                //Se define arreglo con las claves de los parámetros y sus rangos permitidos.
                $claves = array('genero' => array(1, 2), 'tiempo' => array(1, 720));

                $validacion_rango = $this->validarRangoParametrosNumericos($claves, $post);

                if ($validacion_rango['resultado']) {

                    //LLAMA A LA FUNCIÓN QUE BUSCA UN IDENTIFICADOR DE HOBBY ESPECÍFICO.
                    $busqueda = $this->container->get('modelo_hobby')->buscarId($post['hobby']);

                    //Comprueba que el hobby está registrado.
					if ($busqueda != 0) {

                        //LLAMA A LA FUNCIÓN PARA INSERTAR UNA NUEVA ENCUESTA.
                        $this->container->get('modelo_encuesta')->insertar(
                            $post['nombre'],
                            $post['genero'],
                            $post['hobby'],
                            $post['tiempo']
                        );

                        //REDIRECCIONA AL ENDPOINT PARA MOSTRAR EL REPORTE.
                        $_SESSION['reporte_ok'] = true;
                        $this->response->redirect("/api-web/encuesta", 303);
                    }
                    else {

                        $respuesta = array(
                            'titulo' => "ERROR 400",
                            'mensaje' => "Parámetro inválido. El parámetro hobby no está registrado."
                        );
                        $this->app->render('error', $respuesta);
                    }
                }
                else {

                    $respuesta = array(
                        'titulo' => "ERROR 400",
                        'mensaje' => $validacion_rango['error']
                    );
                    $this->app->render('error', $respuesta);
                }
            }
            else {

                $respuesta = array(
                    'titulo' => "ERROR 400",
                    'mensaje' => $validacion_largo['error']
                );
                $this->app->render('error', $respuesta);
            }
        }
        else {

            $respuesta = array(
                'titulo' => "ERROR 400",
                'mensaje' => $validacion_nonulo['error']
            );
            $this->app->render('error', $respuesta);
        }
    }
}