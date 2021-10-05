<?php namespace App\Controllers;

use App\Controllers\BaseController;


class ReporteController extends BaseController {

    //FUNCIÓN PARA OBTENER LA DATA DE LOS GRÁFICOS. (PARA SOLICITUD ASÍNCRONA DE AJAX).
	public function obtenerDataGraficos() {

		//LLAMA A LA FUNCIÓN QUE OBTIENE LA CANTIDADES DE CADA NOMBRE SIMILAR.
        $data1 = $this->container->get('modelo_encuesta')->obtenerCantidadesNombre();

        //LLAMA A LA FUNCIÓN QUE OBTIENE LA CANTIDADES DE CADA GÉNERO.
        $data2 = $this->container->get('modelo_encuesta')->obtenerCantidadesGenero();

        //LLAMA A LA FUNCIÓN QUE OBTIENE LA CANTIDADES DE CADA HOBBY.
        $data3 = $this->container->get('modelo_encuesta')->obtenerCantidadesHobby();

        //LLAMA A LA FUNCIÓN QUE OBTIENE LOS TIEMPOS PROMEDIOS DE CADA HOBBY.
        $data4 = $this->container->get('modelo_encuesta')->obtenerTiemposPromediosHobby();

        $codigo_http = 200;  //Código de estado de respuesta HTTP, Ok.
        $respuesta = array(
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
            'data4' => $data4
        );

		$this->response->setStatus($codigo_http);
		$this->response->write(json_encode($respuesta));
		$this->response->headers->set('Content-Type', 'application/json');
	}


    //FUNCIÓN PARA OBTENER LA DATA DE LA TABLA. (PARA SOLICITUD ASÍNCRONA DE AJAX).
	public function obtenerDataTabla() {

		//LLAMA A LA FUNCIÓN QUE OBTIENE TODOS LAS ENCUESTAS REGISTRADAS.
        $respuesta['data'] = $this->container->get('modelo_encuesta')->obtenerTodo();
        $codigo_http = 200;  //Código de estado de respuesta HTTP, Ok.

		$this->response->setStatus($codigo_http);
		$this->response->write(json_encode($respuesta));
		$this->response->headers->set('Content-Type', 'application/json');
	}
}