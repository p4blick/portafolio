<?php
use PHPUnit\Framework\TestCase;
use \modelos\Competencia;


class CompetenciaTest extends TestCase{
	
	/** @test **/
	public function 
		agregar_nuevo_competencia_con_todos_sus_datos_correctos(){
			$competencia= new Competencia;

            $idCompetencia=1;
			$nombre_competencia="ompetencia prueba";
			$idTipo_Compentecia=1;
			

			$rspta = $competencia->insertar($idCompetencia,$nombre_competencia,$idTipo_Compentecia);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		agregar_nueva_Competencia_con_todos_sus_datos_nulos(){
			$competencia= new Competencia;

            $idCompetencia=2;
			$nombre_competencia="";
			$idTipo_Compentecia=1;
           

			$rspta = $competencia->insertar($idCompetencia,$nombre_competencia,$idTipo_Compentecia);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		editar_competencia_con_todos_sus_datos_correctos(){
			$competencia= new Competencia;

			$idCompetencia=1;
            $nombre_competencia="editando competencia cuyo id es 1";
			$idTipo_Compentecia=1;
			
           

			$rspta = $competencia->editar($idCompetencia,$nombre_competencia,$idTipo_Compentecia);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		desactivar_competencia_modificando_estado(){
			$competencia= new Competencia;
			
			$idCompetencia=1;
			$estado="0";
           

			$rspta = $competencia->desactivar($idCompetencia,$estado);
			$this->assertEquals($rspta);
		}
		
	/** @test **/
	public function 
	activar_competencia_modificando_estado(){
		$competencia= new Competencia;
		
		$idCompetencia=1;
		$estado="1";
	   

		$rspta = $competencia->activar($idCompetencia,$estado);
		$this->assertEquals($rspta);
	}
	

	public function 
	mostrar_competencia_seleccionando_su_id(){
		$competencia= new Competencia;
		
		$idCompetencia=1;
	   

		$rspta = $competencia->mostrar($idCompetencia);
		$this->assertEquals($rspta);
	}
	



	
		
	

	

	
}

?>