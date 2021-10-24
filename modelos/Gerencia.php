<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Gerencia
{
	//Implementamos constructor
	public function __construct()
	{

	}

	//método insertar registros
	public function insertar($nombre_gerencia)
	{
		$sql="INSERT INTO gerencia (nombre_gerencia,condicion)
		VALUES ('$nombre_gerencia','1')";
		return ejecutarConsulta($sql);
	}

	//método editar registros 
	public function editar($idGerencia,$nombre_gerencia)
	{
		$sql="UPDATE gerencia SET nombre_gerencia='$nombre_gerencia' WHERE idGerencia='$idGerencia'";
		return ejecutarConsulta($sql);
	}

	//método  desactivar
	public function desactivar($idGerencia)
	{
		$sql="UPDATE gerencia SET condicion='0' WHERE idGerencia='$idGerencia'";
		return ejecutarConsulta($sql);
	}

	// método activar 
	public function activar($idGerencia)
	{
		$sql="UPDATE gerencia SET condicion='1' WHERE idGerencia='$idGerencia'";
		return ejecutarConsulta($sql);
	}

	//método mostrar los datos de un registro a modificar
	public function mostrar($idGerencia)
	{
		$sql="SELECT * FROM gerencia WHERE idGerencia='$idGerencia'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM gerencia";
		return ejecutarConsulta($sql);		
	}

	///método para listar los registros de gerencia
	public function selectGerencia()
	{
		$sql="SELECT * FROM gerencia WHERE condicion=1";
		return ejecutarConsulta($sql);		
	}

}

?>