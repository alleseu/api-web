<?php namespace App\Models;


class HobbyModel {

	protected $pdo;

	//CONSTRUCTOR DEL MODELO.
	public function __construct($db) {

		$this->pdo = $db;
	}


	//FUNCIÓN QUE BUSCA UN IDENTIFICADOR DE HOBBY ESPECÍFICO.
	public function buscarId($id) {

		$sql = "SELECT descripcion
				FROM hobby
				WHERE id = ?";

		$sentencia = $this->pdo->prepare($sql);  //Prepara una sentencia para su ejecución y devuelve un objeto sentencia.

		//Vincula un valor al parámetro de sustitución con signo de interrogación de la sentencia SQL.
		$sentencia->bindValue(1, $id);

		$sentencia->execute();  //Ejecuta una sentencia preparada.

		return $sentencia->rowCount();  //Devuelve el número de filas afectadas por la última sentencia SQL.
	}


	//FUNCIÓN QUE OBTIENE TODOS LOS HOBBY REGISTRADOS.
	public function obtenerTodo() {

		$sql = "SELECT id AS id,
					   descripcion AS descripcion
				FROM hobby";

        $query = $this->pdo->query($sql);  //Ejecuta una sentencia SQL, devolviendo un conjunto de resultados como un objeto PDOStatement.
                
        return $query->fetchAll();  //Devuelve un array que contiene todas las filas del conjunto de resultados.
	}
}