<?php 
require_once "../modelos/Gerencia.php";

$gerencia=new Gerencia();

$idGerencia=isset($_POST["idGerencia"])? limpiarCadena($_POST["idGerencia"]):"";
$nombre_gerencia=isset($_POST["nombre_gerencia"])? limpiarCadena($_POST["nombre_gerencia"]):"";

switch ($_GET["op"]){

	case 'guardaryeditar':
		if (empty($idGerencia)){
			$rspta=$gerencia->insertar($nombre_gerencia);
			echo $rspta ? "Gerencia Registrado" : "Gerencia no se pudo registrar";
		}
		else {
			$rspta=$gerencia->editar($idGerencia,$nombre_gerencia);
			echo $rspta ? "Gerencia actualizado" : "Gerencia no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$gerencia->desactivar($idGerencia);
 		echo $rspta ? "Gerencia Desactivado" : "Gerencia no se puede desactivar";		
	break;

	case 'activar':
		$rspta=$gerencia->activar($idGerencia);
 		echo $rspta ? "Gerenciaactivado" : "Gerencia no se puede activar";		
	break;

	case 'mostrar':
		$rspta=$gerencia->mostrar($idGerencia);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$gerencia->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idGerencia.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-danger" onclick="desactivar('.$reg->idGerencia.')"><i class="fa fa-close"></i></button>':
				'<button class="btn btn-warning" onclick="mostrar('.$reg->idGerencia.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-success" onclick="activar('.$reg->idGerencia.')"><i class="fa fa-check"></i></button>',				
 				"1"=>$reg->nombre_gerencia	
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