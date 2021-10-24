<?php 
require_once "../modelos/Tipo_Competencia.php";

$tipo_competencia=new Tipo_Competencia();

$idTipo_Competencia=isset($_POST["idTipo_Competencia"])? limpiarCadena($_POST["idTipo_Competencia"]):"";
$nombre_tipoCompetencia=isset($_POST["nombre_tipoCompetencia"])? limpiarCadena($_POST["nombre_tipoCompetencia"]):"";

switch ($_GET["op"]){

	case 'guardaryeditar':
		if (empty($idTipo_Competencia)){
			$rspta=$tipo_competencia->insertar($nombre_tipoCompetencia);
			echo $rspta ? "Tipo de Competencia Registrado" : "Tipo de Competencia no se pudo registrar";
		}
		else {
			$rspta=$tipo_competencia->editar($idTipo_Competencia,$nombre_tipoCompetencia);
			echo $rspta ? "Tipo de Competencia actualizado" : "Tipo de Competencia no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$tipo_competencia->desactivar($idTipo_Competencia);
 		echo $rspta ? "Tipo de Competencia Desactivado" : "Tipo de Competencia no se puede desactivar";		
	break;

	case 'activar':
		$rspta=$tipo_competencia->activar($idTipo_Competencia);
 		echo $rspta ? "Tipo de Competencia activado" : "Tipo de Competencia no se puede activar";		
	break;

	case 'mostrar':
		$rspta=$tipo_competencia->mostrar($idTipo_Competencia);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$tipo_competencia->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idTipo_Competencia.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idTipo_Competencia.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idTipo_Competencia.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idTipo_Competencia.')"><i class="fa fa-check"></i></button>',				
 				"1"=>$reg->nombre_tipoCompetencia	
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