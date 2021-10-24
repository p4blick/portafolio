<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class SubGerencia
{
	//Implementamos constructor
	public function __construct()
	{

	}

	//método insertar registros
	public function insertar($nombre_subGerencia)
	{
		$sql="INSERT INTO subGerencia (nombre_subGerencia,condicion)
		VALUES ('$nombre_subGerencia','1')";
		return ejecutarConsulta($sql);
	}

	//método editar registros 
	public function editar($idSubGerencia,$nombre_subGerencia)
	{
		$sql="UPDATE subgerencia SET nombre_subGerencia='$nombre_subGerencia' WHERE idSubGerencia='$idSubGerencia'";
		return ejecutarConsulta($sql);
	}

	//método  desactivar subGerencia
	public function desactivar($idSubGerencia)
	{
		$sql="UPDATE subgerencia SET condicion='0' WHERE idSubGerencia='$idSubGerencia'";
		return ejecutarConsulta($sql);
	}

	// método activar subGerencia
	public function activar($idSubGerencia)
	{
		$sql="UPDATE subgerencia SET condicion='1' WHERE idSubGerencia='$idSubGerencia'";
		return ejecutarConsulta($sql);
	}

	//método mostrar los datos de un registro a modificar
	public function mostrar($idSubGerencia)
	{
		$sql="SELECT * FROM subgerencia WHERE idSubGerencia='$idSubGerencia'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM subgerencia";
		return ejecutarConsulta($sql);		
	}

	///método para listar los registros de gerencia
	public function selectSubGerencia()
	{
		$sql="SELECT * FROM subgerencia WHERE condicion=1";
		
		return ejecutarConsulta($sql);		
	}

}

?>