<?php
use PHPUnit\Framework\TestCase;
use \modelos\Gerencia;


class GerenciaTest extends TestCase{
	
	/** @test **/
	public function 
		agregar_nuevo_Gerencia_con_todos_sus_datos_correctos(){
			$Gerencia= new Gerencia;

            $idGerencia=1;
			$nombre_Gerencia="Gerencia prueba";
			

			$rspta = $Gerencia->insertar($idGerencia,$nombre_Gerencia);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		agregar_nueva_Gerencia_con_todos_sus_datos_nulos(){
			$Gerencia= new Gerencia;

            $idGerencia=2;
			$nombre_Gerencia="";
			
           

			$rspta = $Gerencia->insertar($idGerencia,$nombre_Gerencia);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		editar_Gerencia_con_todos_sus_datos_correctos(){
			$Gerencia= new Gerencia;

			$idGerencia=1;
            $nombre_Gerencia="editando Gerencia cuyo id es 1";
			
           

			$rspta = $Gerencia->editar($idGerencia,$nombre_Gerencia);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		desactivar_Gerencia_modificando_estado(){
			$Gerencia= new Gerencia;
			
			$idGerencia=1;
			$estado="0";
           

			$rspta = $Gerencia->desactivar($idGerencia,$estado);
			$this->assertEquals($rspta);
		}
		
	/** @test **/
	public function 
	activar_Gerencia_modificando_estado(){
		$Gerencia= new Gerencia;
		
		$idGerencia=1;
		$estado="1";
	   

		$rspta = $Gerencia->activar($idGerencia,$estado);
		$this->assertEquals($rspta);
	}
	

	public function 
	mostrar_Gerenciaseleccionando_su_id(){
		$Gerencia= new Gerencia;
		
		$idGerencia=1;
	   

		$rspta = $Gerencia->mostrar($idGerencia);
		$this->assertEquals($rspta);
	}
	



	
		
	

	

	
}

?>