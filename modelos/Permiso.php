<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Permiso
{
	//Implementamos constructor
	public function __construct()
	{

	}

	//método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM permiso";
		return ejecutarConsulta($sql);		
	}

	

}

?>