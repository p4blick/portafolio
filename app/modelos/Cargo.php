<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Cargo
{
	//Implementamos constructor
	public function __construct()
	{

	}

	//método insertar registros
	public function insertar($nombre_cargo)
	{
		$sql="INSERT INTO cargo (nombre_cargo,condicion)
		VALUES ('$nombre_cargo','1')";
		return ejecutarConsulta($sql);
	}

	//método editar registros 
	public function editar($idCargo,$nombre_cargo)
	{
		$sql="UPDATE cargo SET nombre_cargo='$nombre_cargo' WHERE idCargo='$idCargo'";
		return ejecutarConsulta($sql);
	}

	//método  desactivar cargo
	public function desactivar($idCargo)
	{
		$sql="UPDATE cargo SET condicion='0' WHERE idCargo='$idCargo'";
		return ejecutarConsulta($sql);
	}

	// método activar cargo
	public function activar($idCargo)
	{
		$sql="UPDATE cargo SET condicion='1' WHERE idCargo='$idCargo'";
		return ejecutarConsulta($sql);
	}

	//método mostrar los datos de un registro a modificar
	public function mostrar($idCargo)
	{
		$sql="SELECT * FROM cargo WHERE idCargo='$idCargo'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM cargo";
		return ejecutarConsulta($sql);		
	}

	///método para listar los registros de cargo
	public function selectCargo()
	{
		$sql="SELECT * FROM cargo WHERE condicion=1";
		return ejecutarConsulta($sql);		
	}


}

?>