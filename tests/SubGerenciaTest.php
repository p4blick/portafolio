<?php
use PHPUnit\Framework\TestCase;
use \modelos\SubGerencia;


class SubGerenciaTest extends TestCase{
	
	/** @test **/
	public function 
		agregar_nuevo_SubGerencia_con_todos_sus_datos_correctos(){
			$SubGerencia= new SubGerencia;

            $idSubGerencia=1;
			$nombre_SubGerencia="SubGerencia prueba";
			

			$rspta = $Gerencia->insertar($idGerencia,$nombre_SubGerencia);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		agregar_nueva_Sub_con_todos_sus_datos_nulos(){
			$SubGerencia= new SubGerencia;

            $idSubGerencia=2;
			$nombre_SubGerencia="";
			
           

			$rspta = $SubGerencia->insertar($idSubGerencia,$nombre_SubGerencia);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		editar_Gerencia_con_todos_sus_datos_correctos(){
			$SubGerencia= new SubGerencia;

			$idSubGerencia=1;
            $nombre_SubGerencia="editando SubGerencia cuyo id es 1";
			
           

			$rspta = $SubGerencia->editar($idSubGerencia,$nombre_SubGerencia);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		desactivar_SubGerencia_modificando_estado(){
			$SubGerencia= new SubGerencia;
			
			$idSubGerencia=1;
			$estado="0";
           

			$rspta = $SubGerencia->desactivar($idSubGerencia,$estado);
			$this->assertEquals($rspta);
		}
		
	/** @test **/
	public function 
	activar_Gerencia_modificando_estado(){
		$SubGerencia= new SubGerencia;
		
		$idSubGerencia=1;
		$estado="1";
	   

		$rspta = $SubGerencia->activar($idSubGerencia,$estado);
		$this->assertEquals($rspta);
	}
	

	public function 
	mostrar_Gerenciaseleccionando_su_id(){
		$SubGerencia= new SubGerencia;
		
		$idSubGerencia=1;
	   

		$rspta = $SubGerencia->mostrar($idSubGerencia);
		$this->assertEquals($rspta);
	}
	
	
}

?>