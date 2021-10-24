<?php 
require_once "../modelos/Cargo.php";

$cargo=new Cargo();

$idCargo=isset($_POST["idCargo"])? limpiarCadena($_POST["idCargo"]):"";
$nombre_cargo=isset($_POST["nombre_cargo"])? limpiarCadena($_POST["nombre_cargo"]):"";

switch ($_GET["op"]){

	case 'guardaryeditar':
		if (empty($idCargo)){
			$rspta=$cargo->insertar($nombre_cargo);
			echo $rspta ? "Cargo Registrado" : "Cargo no se pudo registrar";
		}
		else {
			$rspta=$cargo->editar($idCargo,$nombre_cargo);
			echo $rspta ? "Cargo actualizado" : "Cargo no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$cargo->desactivar($idCargo);
 		echo $rspta ? "Cargo Desactivado" : "Cargo no se puede desactivar";		
	break;

	case 'activar':
		$rspta=$cargo->activar($idCargo);
 		echo $rspta ? "Cargo activado" : "Cargo no se puede activar";		
	break;

	case 'mostrar':
		$rspta=$cargo->mostrar($idCargo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$cargo->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idCargo.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-danger" onclick="desactivar('.$reg->idCargo.')"><i class="fa fa-close"></i></button>':
				'<button class="btn btn-warning" onclick="mostrar('.$reg->idCargo.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-success" onclick="activar('.$reg->idCargo.')"><i class="fa fa-check"></i></button>',				
 				"1"=>$reg->nombre_cargo	
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}
?>