<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Usuario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idGerencia,$idArea,$idSubGerencia,$idCargo,$idPerfil_Usuario,$nombre,$rut,$fechaIngreso,$login,$correo,$clave,$permisos)
	{
		$sql="INSERT INTO usuario (idGerencia,idArea,idSubGerencia,idCargo,idPerfil_Usuario,nombre,rut,fechaIngreso,login,correo,clave)
		VALUES ('$idGerencia','$idArea','$idSubGerencia','$idCargo','$idPerfil_Usuario','$nombre','$rut','$fechaIngreso','$login','$correo','$clave')";
		//return ejecutarConsulta($sql);
		$idusuarionew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuario_permiso(idUsuario, idPermiso) VALUES('$idusuarionew', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;

	}

	//Implementamos un método para editar registros
	public function editar($idUsuario,$idGerencia,$idArea,$idSubGerencia,$idCargo,$idPerfil_Usuario,$nombre,$rut,$fechaIngreso,$login,$correo,$clave,$permisos)
	{
		$sql="UPDATE usuario SET 
				idGerencia='$idGerencia',
				idArea='$idArea',
				idSubGerencia='$idSubGerencia',
				idCargo='$idCargo',
				idPerfil_Usuario='$idPerfil_Usuario',
				nombre='$nombre',
				rut='$rut',
				fechaIngreso='$fechaIngreso',
				login='$login',
				correo='$correo',
				clave='$clave'
			WHERE idUsuario='$idUsuario'";
			 ejecutarConsulta($sql);

		//Eliminamos todos los permisos asignados para volverlos a registrar
		$sqldel="DELETE FROM usuario_permiso WHERE idUsuario='$idUsuario'";
		ejecutarConsulta($sqldel);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($permisos))
		{
			$sql_detalle = "INSERT INTO usuario_permiso(idUsuario, idPermiso) VALUES('$idUsuario', '$permisos[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}

	

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idUsuario)
	{
		$sql="SELECT * FROM usuario WHERE idUsuario='$idUsuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="	SELECT 	u.idUsuario, u.idGerencia, u.idArea, u.idSubGerencia, u.idCargo, u.idPerfil_Usuario,
						g.nombre_gerencia as gerencia, a.nombre_area as area, s.nombre_subGerencia as subgerencia, c.nombre_cargo as cargo, p.nombre_perfilUsuario as perfil_usuario,
						u.nombre, u.rut, u.fechaIngreso, u.login, u.correo, u.clave
		 FROM usuario u 
		 INNER JOIN gerencia g ON u.idGerencia=g.idGerencia
		 INNER JOIN area a ON u.idArea=a.idArea
		 INNER JOIN subGerencia s ON u.idSubGerencia=s.idSubGerencia
		 INNER JOIN cargo c ON u.idCargo=c.idCargo
		 INNER JOIN perfil_usuario p ON u.idPerfil_Usuario=p.idPerfil_Usuario";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los permisos marcados
	public function listarmarcados($idUsuario)
	{
		$sql="SELECT * FROM usuario_permiso WHERE idUsuario='$idUsuario'";
		return ejecutarConsulta($sql);
	}

	//Función para verificar el acceso al sistema
	public function verificar($login,$clave)
    {
    	$sql = "SELECT
            idUsuario,
            nombre,
            rut,
            fechaIngreso,
            correo,
            login,
            clave,
            idGerencia,
            idArea,
			idSubGerencia,
			idCargo,
			idPerfil_Usuario
            FROM usuario WHERE login = '$login' 
            AND clave = '$clave'
        ";  
    	
		return ejecutarConsulta($sql);  
    }

}

?>