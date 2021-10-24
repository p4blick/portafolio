<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Area
{
	//Implementamos constructor
	public function __construct()
	{

	}

	///método para listar los registros de Area
	public function selectArea()
	{
		$sql="SELECT * FROM area";
		return ejecutarConsulta($sql);		
	}

}

?>