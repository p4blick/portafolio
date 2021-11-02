<?php 
require_once "../modelos/Cargo.php";
require_once "../modelos/Usuario.php";

$cargo=new Cargo();

$idEvaluador=isset($_POST["idEvaluador"])? limpiarCadena($_POST["idEvaluador"]):"";
$idUsuario=isset($_POST["idUsuario"])? limpiarCadena($_POST["idUsuario"]):"";

switch ($_GET["op"]){

	case 'guardaryeditar':
		if (empty($idCargo)){
			$rspta=$cargo->insertar($idUsuario);
			echo $rspta ? "Evaluador Registrado" : "Evakuador no se pudo registrar";
		}
		else {
			$rspta=$cargo->editar($idEvaluador,$idUsuario);
			echo $rspta ? "Evaluador actualizado" : "Evaluador no se pudo actualizar";
		}
	break;

	case "selectEvaluador":
		$evaluador=new Usuario();
		
		$rspta=$evaluador->selectEvaluador();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option name="evaluador"  value=' . $reg->idUsuario . '>' . $reg->nombre . '</option>';
					
				}
	break;

	

	
}
?>