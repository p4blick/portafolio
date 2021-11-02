<?php
use PHPUnit\Framework\TestCase;
use \modelos\Usuario;


class UsuarioTest extends TestCase{
	
	/** @test **/
	public function 
		agregar_nuevo_usuario_con_todos_sus_datos_correctos(){
			$usuario= new Usuario;

            $idUsuario=1;
			$idGerebcia=1;
			$idArea=1;
			$idSubGerencia=1;
			$idCargo=1;
			$idPerfil_Usuario=1;
			$nombre ="pablo";
			$rut = "20053779-3";
			$fechaIngreso = "2020-11-11";
			$login = "pablo";
			$correo ="pablo.aburto.99@gmail.com";
			$clave = "123";
			$idUsuario2 = 2;

			$rspta = $usuario->insertar($idUsuario,$idGerencia,$idArea,$idSubGerencia,$idCargo,$idPerfil_Usuario,$nombre,$rut,$fechaIngreso,$login,$correo,$clave,$permisos,$idUsuario2);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		agregar_nueva_usuario_con_todos_sus_datos_nulos_retornarError(){
			$usuario= new Usuario;

            $idUsuario=1;
			$idGerebcia=1;
			$idArea=1;
			$idSubGerencia=1;
			$idCargo=1;
			$idPerfil_Usuario=1;
			$nombre ="";
			$rut = "";
			$fechaIngreso = "";
			$login = "";
			$correo ="";
			$clave = "";
			$idUsuario2 = 2;
			
           
			$rspta = $usuario->insertar($idUsuario,$idGerencia,$idArea,$idSubGerencia,$idCargo,$idPerfil_Usuario,$nombre,$rut,$fechaIngreso,$login,$correo,$clave,$permisos,$idUsuario2);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		editar_usuario_con_todos_sus_datos_correctos(){
			$usuario= new Usuario;

			$idUsuario=1;
			$idGerebcia=1;
			$idArea=1;
			$idSubGerencia=1;
			$idCargo=1;
			$idPerfil_Usuario=1;
			$nombre ="jonathan";
			$rut = "11111111-1";
			$fechaIngreso = "2018-11-11";
			$login = "jona";
			$correo ="jona@gmail.com";
			$clave = "123";
			$idUsuario2 = 2;
			
           

			$rspta = $usuario->editar($idUsuario,$idGerencia,$idArea,$idSubGerencia,$idCargo,$idPerfil_Usuario,$nombre,$rut,$fechaIngreso,$login,$correo,$clave,$permisos,$idUsuario2);
			$this->assertEquals($rspta);
		}
	
	public function 
	mostrar_usuario_seleccionando_su_id(){
		$usuario= new Usuario;
		
		$idUsuario=1;
	   

		$rspta = $usuario->mostrar($idUsuario);
		$this->assertEquals($rspta);
	}
	



	
		
	

	

	
}

?>