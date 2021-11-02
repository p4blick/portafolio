<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Acciones
{
	//Implementamos constructor
	public function __construct()
	{

	}

	//método insertar registros
	public function insertar($pregunta,$idCompetencia)
	{
		$sql="INSERT INTO acciones (pregunta,idCompetencia)
		VALUES ('$pregunta','$idCompetencia')";
		return ejecutarConsulta($sql);
	}

	//método editar registros 
	public function editar($idAcciones,$pregunta,$idCompetencia)
	{
		$sql="UPDATE acciones SET pregunta='$pregunta',idCompetencia='$idCompetencia' 
            WHERE idAcciones='$idAcciones'";
		return ejecutarConsulta($sql);
	}

	//método  desactivar regisitros
	public function desactivar($idAcciones)
	{
		$sql="UPDATE acciones SET condicion='0' WHERE idAcciones='$idAcciones'";
		return ejecutarConsulta($sql);
	}

	// método activar registros
	public function activar($idAcciones)
	{
		$sql="UPDATE acciones SET condicion='1' WHERE idAcciones='$idAcciones'";
		return ejecutarConsulta($sql);
	}

	//método mostrar los datos de un registro a modificar
	public function mostrar($idAcciones)
	{
		$sql="SELECT * FROM acciones WHERE idAcciones='$idAcciones'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//método para listar los registros
	public function listar()
	{
		$sql=" SELECT a.idAcciones, a.pregunta, a.idCompetencia,a.condicion,c.nombre_competencia as competencia
        FROM acciones a  
        INNER JOIN competencia c ON a.idCompetencia=c.idCompetencia";
		return ejecutarConsulta($sql);		
	}

	///método para listar los registros de tipo Competencia
	public function listara()
	{
		$sql="SELECT a.pregunta as pregunta , c.idCompetencia, c.nombre_competencia AS competencia 
				FROM acciones a
				INNER JOIN competencia c ON a.idCompetencia=c.idCompetencia
			WHERE a.condicion=1 AND c.condicion=1 
			ORDER BY c.nombre_competencia";
				
		return ejecutarConsulta($sql);		
	}


}

?>