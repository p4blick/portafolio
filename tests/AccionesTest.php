<?php
use PHPUnit\Framework\TestCase;
use \modelos\Acciones;


class AccionesTest extends TestCase{
	
	/** @test **/
	public function 
		agregar_nueva_accion_con_todos_sus_datos_correctos(){
			$acciones= new Acciones;

            $idAccion=1;
			$pregunta="esta es una accion de prueba";
            $idCompetencia=1;
			$condicion='1';

			$rspta = $acciones->insertar($idAccion,$pregunta,$idCompetencia);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		agregar_nueva_accion_con_todos_sus_datos_nulos(){
			$acciones= new Acciones;

            $idAccion=2;
			$pregunta="";
			$idCompetencia="";
           

			$rspta = $acciones->insertar($idAccion,$pregunta,$idCompetencia);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		editar_accion_con_todos_sus_datos_correctos(){
			$acciones= new Acciones;

			$idAccion=1;
            $pregunta="editando accion cuyo id es 1";
			$idCompetencia=1;
           

			$rspta = $acciones->editar($pregunta,$idCompetencia);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		desactivar_accion_modificando_estado(){
			$acciones= new Acciones;
			
			$idAcciones=1;
			$estado="0";
           

			$rspta = $acciones->desactivar($estado);
			$this->assertEquals($rspta);
		}
		
	/** @test **/
	public function 
	activar_accion_modificando_estado(){
		$acciones= new Acciones;
		
		$idAcciones=1;
		$estado="1";
	   

		$rspta = $acciones->activar($idAcciones,$estado);
		$this->assertEquals($rspta);
	}
	

	public function 
	mostrar_accion_seleccionando_su_id(){
		$acciones= new Acciones;
		
		$idAcciones=1;
	   

		$rspta = $acciones->mostrar($idAcciones);
		$this->assertEquals($rspta);
	}
	



	
		
	

	

	
}

?>