<?php
use PHPUnit\Framework\TestCase;
use \modelos\Tipo_Competencia;


class Tipo_CompetenciaTest extends TestCase{
	
	/** @test **/
	public function 
		agregar_nuevo_competencia_con_todos_sus_datos_correctos(){
			$tipo_competencia= new Tipo_Competencia;

            $idTipo_Competencia=1;
			$nombre_Tipocompetencia="Tipo_competencia prueba";
			

			$rspta = $competencia->insertar($idCompetencia,$nombre_Tipocompetencia);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		agregar_nueva_Tipo_Competencia_con_todos_sus_datos_nulos(){
			$Tipo_competencia= new Tipo_Competencia;

            $idTipo_Competencia=2;
			$nombre_Tipocompetencia="";
			
           

			$rspta = $Tipo_competencia->insertar($idCompetencia,$nombre_Tipo_competencia);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		editar_Tipo_competencia_con_todos_sus_datos_correctos(){
			$competencia= new Tipo_Competencia;

			$idTipo_Competencia=1;
            $nombre_Tipocompetencia="editando Tipo competencia cuyo id es 1";
			
           

			$rspta = $Tipocompetencia->editar($idCompetencia,$nombre_Tipocompetencia);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		desactivar_Tipo_competencia_modificando_estado(){
			$Tipo_competencia= new Tipo_Competencia;
			
			$idTipo_competencia=1;
			$estado="0";
           

			$rspta = $competencia->desactivar($idTipo_Competencia,$estado);
			$this->assertEquals($rspta);
		}
		
	/** @test **/
	public function 
	activar_Tipo_competencia_modificando_estado(){
		$Tipo_competencia= new Tipo_Competencia;
		
		$idTipo_Competencia=1;
		$estado="1";
	   

		$rspta = $Tipo_competencia->activar($idTipo_Competencia,$estado);
		$this->assertEquals($rspta);
	}
	

	public function 
	mostrar_Tipo_competencia_seleccionando_su_id(){
		$Tipo_competencia= new Competencia;
		
		$idTipo_Competencia=1;
	   

		$rspta = $Tipo_competencia->mostrar($idTipo_Competencia);
		$this->assertEquals($rspta);
	}
		
}

?>