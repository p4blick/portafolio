<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Perfil_Usuario
{
	//Implementamos constructor
	public function __construct()
	{

	}

	//método para listar los registros de perfil usuario
	public function selectPerfilUsuario()
	{
		$sql="SELECT * FROM perfil_usuario";
		return ejecutarConsulta($sql);		
	}
	
	//método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM perfil_usuario";
		return ejecutarConsulta($sql);		
	}

}

?>






