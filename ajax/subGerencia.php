<?php 
require_once "../modelos/SubGerencia.php";

$subGerencia=new SubGerencia();

$idSubGerencia=isset($_POST["idSubGerencia"])? limpiarCadena($_POST["idSubGerencia"]):"";
$nombre_subGerencia=isset($_POST["nombre_subGerencia"])? limpiarCadena($_POST["nombre_subGerencia"]):"";

switch ($_GET["op"]){

	case 'guardaryeditar':
		if (empty($idSubGerencia)){
			$rspta=$subGerencia->insertar($nombre_subGerencia);
			echo $rspta ? "subGerencia Registrado" : "subGerencia no se pudo registrar";
		}
		else {
			$rspta=$subGerencia->editar($idSubGerencia,$nombre_subGerencia);
			echo $rspta ? "Sub Gerencia actualizado" : "Sub Gerencia no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$subGerencia->desactivar($idSubGerencia);
 		echo $rspta ? "Sub Gerencia Desactivado" : "Sub Gerencia no se puede desactivar";		
	break;

	case 'activar':
		$rspta=$subGerencia->activar($idSubGerencia);
 		echo $rspta ? "Sub Gerencia activado" : "Sub Gerencia no se puede activar";		
	break;

	case 'mostrar':
		$rspta=$subGerencia->mostrar($idSubGerencia);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$subGerencia->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idSubGerencia.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-danger" onclick="desactivar('.$reg->idSubGerencia.')"><i class="fa fa-close"></i></button>':
				'<button class="btn btn-warning" onclick="mostrar('.$reg->idSubGerencia.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-success" onclick="activar('.$reg->idSubGerencia.')"><i class="fa fa-check"></i></button>',				
 				"1"=>$reg->nombre_subGerencia
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