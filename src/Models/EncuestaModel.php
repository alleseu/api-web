<?php namespace App\Models;


class EncuestaModel {

	protected $pdo;

	//CONSTRUCTOR DEL MODELO.
	public function __construct($db) {

		$this->pdo = $db;
	}


	//FUNCIÓN PARA INSERTAR UNA NUEVA ENCUESTA.
	public function insertar($nombre, $genero, $hobby, $tiempo) {

		//SI EL DATO DEL TIEMPO ESTÁ VACÍO, LO CAMBIA POR NULO.
		$tiempo = (empty($tiempo) ? NULL : $tiempo);

		$sql = "INSERT INTO encuesta (nombre, genero, hobby, tiempo, fecha)
				VALUES (?, ?, ?, ?, ?)";

		$sentencia = $this->pdo->prepare($sql);  //Prepara una sentencia para su ejecución y devuelve un objeto sentencia.

		//Vincula los valores a los parámetros de sustitución con signo de interrogación de la sentencia SQL.
		$sentencia->bindValue(1, $nombre);
		$sentencia->bindValue(2, $genero);
		$sentencia->bindValue(3, $hobby);
        $sentencia->bindValue(4, $tiempo);
		$sentencia->bindValue(5, date('Y-m-d H:i:s'));

		$sentencia->execute();  //Ejecuta una sentencia preparada.
	}


	//FUNCIÓN QUE OBTIENE TODOS LAS ENCUESTAS REGISTRADAS.
	public function obtenerTodo() {

		$sql = "SELECT e.id AS id,
					   e.nombre AS nombre,
					   (CASE e.genero WHEN 1 THEN 'Mujer' ELSE 'Hombre' END) AS genero,
					   h.descripcion AS hobby,
					   IFNULL(e.tiempo, '-') AS tiempo,
					   DATE_FORMAT(e.fecha,'%d-%m-%Y %H:%i:%s') AS fecha
				FROM encuesta e,
					 hobby h
				WHERE e.hobby = h.id
				ORDER BY e.id DESC";

		$query = $this->pdo->query($sql);  //Ejecuta una sentencia SQL, devolviendo un conjunto de resultados como un objeto PDOStatement.
		
		return $query->fetchAll();  //Devuelve un array que contiene todas las filas del conjunto de resultados.
	}


	//FUNCIÓN QUE OBTIENE LA CANTIDADES DE CADA NOMBRE SIMILAR.
	public function obtenerCantidadesNombre() {

		$sql = "SELECT UPPER(nombre) AS nombre,
					   COUNT(nombre) AS cantidad
				FROM encuesta
				GROUP BY nombre";

		$query = $this->pdo->query($sql);  //Ejecuta una sentencia SQL, devolviendo un conjunto de resultados como un objeto PDOStatement.
								
		return $query->fetchAll();  //Devuelve un array que contiene todas las filas del conjunto de resultados.
	}


	//FUNCIÓN QUE OBTIENE LA CANTIDADES DE CADA GÉNERO.
	public function obtenerCantidadesGenero() {

		$sql = "SELECT (CASE genero WHEN 1 THEN 'Mujer' ELSE 'Hombre' END) AS genero,
					   COUNT(genero) AS cantidad
				FROM encuesta
				GROUP BY genero";

		$query = $this->pdo->query($sql);  //Ejecuta una sentencia SQL, devolviendo un conjunto de resultados como un objeto PDOStatement.
								
		return $query->fetchAll();  //Devuelve un array que contiene todas las filas del conjunto de resultados.
	}


	//FUNCIÓN QUE OBTIENE LA CANTIDADES DE CADA HOBBY.
	public function obtenerCantidadesHobby() {

		$sql = "SELECT h.descripcion AS hobby,
					   COUNT(e.hobby) AS cantidad
				FROM encuesta e,
					 hobby h
				WHERE e.hobby = h.id
				GROUP BY hobby";

		$query = $this->pdo->query($sql);  //Ejecuta una sentencia SQL, devolviendo un conjunto de resultados como un objeto PDOStatement.
						
		return $query->fetchAll();  //Devuelve un array que contiene todas las filas del conjunto de resultados.
	}


	//FUNCIÓN QUE OBTIENE LOS TIEMPOS PROMEDIOS DE CADA HOBBY.
	public function obtenerTiemposPromediosHobby() {

		$sql = "SELECT h.descripcion AS hobby,
					   AVG(e.tiempo) AS tiempo_promedio
				FROM encuesta e,
					hobby h
				WHERE e.hobby = h.id
				GROUP BY hobby";

		$query = $this->pdo->query($sql);  //Ejecuta una sentencia SQL, devolviendo un conjunto de resultados como un objeto PDOStatement.
						
		return $query->fetchAll();  //Devuelve un array que contiene todas las filas del conjunto de resultados.
	}
}