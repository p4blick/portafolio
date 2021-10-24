<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Tipo_Competencia
{
	//Implementamos constructor
	public function __construct()
	{

	}

	//método insertar registros
	public function insertar($nombre_tipoCompetencia)
	{
		$sql="INSERT INTO tipo_competencia (nombre_tipoCompetencia,condicion)
		VALUES ('$nombre_tipoCompetencia','1')";
		return ejecutarConsulta($sql);
	}

	//método editar registros 
	public function editar($idTipo_Competencia)
	{
		$sql="UPDATE tipo_competencia SET nombre_tipoCompetencia='$nombre_tipoCompetencia' WHERE idTipo_Competencia='$idTipo_Competencia'";
		return ejecutarConsulta($sql);
	}

	//método  desactivar 
	public function desactivar($idTipo_Competencia)
	{
		$sql="UPDATE tipo_competencia SET condicion='0' WHERE idTipo_Competencia='$idTipo_Competencia'";
		return ejecutarConsulta($sql);
	}

	// método activar 
	public function activar($idTipo_Competencia)
	{
		$sql="UPDATE tipo_competencia SET condicion='1' WHERE idTipo_Competencia='$idTipo_Competencia'";
		return ejecutarConsulta($sql);
	}

	//método mostrar los datos de un registro a modificar
	public function mostrar($idTipo_Competencia)
	{
		$sql="SELECT * FROM tipo_competencia WHERE idTipo_Competencia='$idTipo_Competencia'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM tipo_competencia";
		return ejecutarConsulta($sql);		
	}

	///método para listar los registros de tipo Competencia
	public function selectTipoCompetencia()
	{
		$sql="SELECT * FROM tipo_competencia WHERE condicion=1";
		return ejecutarConsulta($sql);		
	}

}

?>