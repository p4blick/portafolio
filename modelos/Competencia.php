<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Competencia
{
	//Implementamos constructor
	public function __construct()
	{

	}

	//método insertar registros
	public function insertar($idTipo_Competencia,$idPerfil_Usuario,$nombre_competencia)
	{
		$sql="INSERT INTO competencia (idTipo_Competencia,idPerfil_Usuario, nombre_competencia,condicion)
		VALUES ('$idTipo_Competencia','$idPerfil_Usuario','$nombre_competencia','1')";
		return ejecutarConsulta($sql);
	}

	//método editar registros 
	public function editar($idCompetencia,$idTipo_Competencia,$idPerfil_Usuario,$nombre_competencia)
	{
		$sql="UPDATE competencia SET idTipo_Competencia='$idTipo_Competencia',idPerfil_Usuario='$idPerfil_Usuario',nombre_competencia='$nombre_competencia' 
            WHERE idCompetencia='$idCompetencia'";
		return ejecutarConsulta($sql);
	}

	//método  desactivar
	public function desactivar($idCompetencia)
	{
		$sql="UPDATE competencia SET condicion='0' WHERE idCompetencia='$idCompetencia'";
		return ejecutarConsulta($sql);
	}

	// método activar 
	public function activar($idCompetencia)
	{
		$sql="UPDATE competencia SET condicion='1' WHERE idCompetencia='$idCompetencia'";
		return ejecutarConsulta($sql);
	}

	//método mostrar los datos de un registro a modificar
	public function mostrar($idCompetencia)
	{
		$sql="SELECT * FROM competencia WHERE idCompetencia='$idCompetencia'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//método para listar los registros
	public function listar()
	{
		$sql="	SELECT 	c.idCompetencia, c.idTipo_Competencia, c.idPerfil_Usuario, c.nombre_competencia,t.nombre_tipoCompetencia as tipo_competencia, p.nombre_perfilUsuario as perfil_usuario, c.condicion
        FROM competencia c  
        INNER JOIN tipo_competencia t ON c.idTipo_Competencia=t.idTipo_Competencia 
        INNER JOIN perfil_usuario p ON c.idPerfil_usuario=p.idPerfil_Usuario";
		return ejecutarConsulta($sql);		
	}

	///método para listar los registros de  Competencia
	public function selectCompetencia()
	{
		$sql="SELECT * FROM competencia WHERE condicion=1";
		return ejecutarConsulta($sql);		
	}

}

?>