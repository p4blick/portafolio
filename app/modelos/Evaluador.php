<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Evaluador
{
	//Implementamos constructor
	public function __construct()
	{

	}

	//método insertar registros
	public function insertarEvaluador($idUsuario)
	{
		$sql="INSERT INTO evaluador (idUsuario)
		VALUES ('$idUsuario')";
		return ejecutarConsulta($sql);
	}

	public function editarEvaluador($idEvaluador,$idUsuario)
	{
		$sql="UPDATE cargo SET idEvaluador='$idEvaluador' WHERE idUsuario='$idUsuario'";
		return ejecutarConsulta($sql);
	}


	public function selectEvaluador()
	{
		$sql="SELECT * FROM usuario";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los permisos marcados
	public function listarDetalle($idUsuario)
	{
		$sql="SELECT * FROM detalle WHERE idUsuario='$idUsuario'";
		return ejecutarConsulta($sql);
	}



}

?>