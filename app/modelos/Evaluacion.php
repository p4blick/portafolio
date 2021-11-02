<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Evaluacion
{
	//Implementamos constructor
	public function __construct()
	{

	}

	//método insertar registros
	public function insertar($puntaje,$fecha_evaluacion,$idDetalle)
	{
		$sql="INSERT INTO evaluacion (puntaje,fecha_evaluacion,'estado',idDetalle)
		VALUES ('$puntaje','$fecha_evaluacion','Finalizado','$idDetalle')";
		return ejecutarConsulta($sql);
	}

	//método editar registros 
	public function editar($idEvaluacion,$puntaje,$fecha_evaluacion,$idDetalle)
	{
		$sql="UPDATE evaluacion SET puntaje='$puntaje',fecha_evaluacion='$fecha_evaluacion',idtipo_Usuario='$idDetalle'  WHERE idEvaluacion='$idEvaluacion'";
		return ejecutarConsulta($sql);
	}

	//método mostrar los datos de un registro a modificar
	public function mostrar($idEvaluacion)
	{
		$sql="SELECT * FROM evaluacion WHERE $idEvaluacion='$idEvaluacion'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//método para listar los registros
	public function listar()
	{
		$sql="SELECT e.estado, d.idDetalle.u.idUsuario, u.nombre as evaluado
		FROM evaluacion e
		INNER JOIN detalle d ON e.idDetalle=d.idDetalle
		INNER JOIN usuario u ON d.idUsuario=u.idUsuario
		
		  ";
		return ejecutarConsulta($sql);		
	}

	//Metodo listar evaluado
	public function listarEvaluado()
	{
		$sql="	SELECT  d.idUsuario, d.idEvaluador, u.nombre as nombre, u.rut as rut, u.correo as correo , 
						u.idPerfil_Usuario, p.nombre_perfilUsuario as perfil_usuario, c.idCargo, c.nombre_cargo 
						as cargo,a.idarea, a.nombre_area as area
				FROM detalle d
				INNER JOIN usuario u ON d.idUsuario=u.idUsuario
				INNER JOIN perfil_usuario p ON u.idPerfil_Usuario=p.idPerfil_Usuario
				INNER JOIN cargo c ON u.idCargo=c.idCargo
				INNER JOIN area a ON u.idArea=a.idArea
		";
				
		
		return ejecutarConsulta($sql);		
	}



}

?>