<?php
use PHPUnit\Framework\TestCase;
use \modelos\Cargo;


class CargoTest extends TestCase{
	
	/** @test **/
	public function 
		agregar_nuevo_cargo_con_todos_sus_datos_correctos(){
			$cargo= new Cargo;

            $idCargo=1;
			$nombre_cargo="cargo prueba";
			

			$rspta = $cargo->insertar($idCargo,$nombre_cargo);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		agregar_nueva_Cargo_con_todos_sus_datos_nulos(){
			$cargo= new Cargo;

            $idCargo=2;
			$nombre_cargo="";
			
           

			$rspta = $cargo->insertar($idCargo,$nombre_cargo);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		editar_cargo_con_todos_sus_datos_correctos(){
			$cargo= new Cargo;

			$idCargo=1;
            $nombre_cargo="editando cargo cuyo id es 1";
			
           

			$rspta = $cargo->editar($idCargo,$nombre_cargo);
			$this->assertEquals($rspta);
		}

	/** @test **/
	public function 
		desactivar_cargo_modificando_estado(){
			$cargo= new Cargo;
			
			$idCargo=1;
			$estado="0";
           

			$rspta = $cargo->desactivar($idCargo,$estado);
			$this->assertEquals($rspta);
		}
		
	/** @test **/
	public function 
	activar_cargo_modificando_estado(){
		$cargo= new Cargo;
		
		$idCargos=1;
		$estado="1";
	   

		$rspta = $cargo->activar($idCargo,$estado);
		$this->assertEquals($rspta);
	}
	

	public function 
	mostrar_cargo_seleccionando_su_id(){
		$cargo= new Cargo;
		
		$idCargo=1;
	   

		$rspta = $cargo->mostrar($idCargo);
		$this->assertEquals($rspta);
	}
	



	
		
	

	

	
}

?>