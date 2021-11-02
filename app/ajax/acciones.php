<?php 
require_once "../modelos/Acciones.php";

$acciones=new Acciones();


$idAcciones=isset($_POST["idAcciones"])? limpiarCadena($_POST["idAcciones"]):"";
$pregunta=isset($_POST["pregunta"])? limpiarCadena($_POST["pregunta"]):"";
$idCompetencia=isset($_POST["idCompetencia"])? limpiarCadena($_POST["idCompetencia"]):"";


switch ($_GET["op"]){

	case 'guardaryeditar':
		if (empty($idAcciones)){
			$rspta=$acciones->insertar($pregunta,$idCompetencia);
			echo $rspta ? "Acción Registrado" : "Acción no se pudo registrar";
		}
		else {
			$rspta=$acciones->editar($idAcciones,$pregunta,$idCompetencia);
			echo $rspta ? "Acción actualizado" : "Acción no se pudo actualizar";
		}
	break;

	case 'mostrar':
		$rspta=$acciones->mostrar($idAcciones);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'desactivar':
		$rspta=$acciones->desactivar($idAcciones);
 		echo $rspta ? "Pregunta Desactivada" : "Pregunta no se puede desactivar";		
	break;

	case 'activar':
		$rspta=$acciones->activar($idAcciones);
 		echo $rspta ? "Pregunta activada" : "Pregunta no se puede activar";		
	break;

	case 'listar':
		$rspta=$acciones->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idAcciones.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-danger" onclick="desactivar('.$reg->idAcciones.')"><i class="fa fa-close"></i></button>':
				'<button class="btn btn-warning" onclick="mostrar('.$reg->idAcciones.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-success" onclick="activar('.$reg->idAcciones.')"><i class="fa fa-check"></i></button>',				
 				"1"=>$reg->pregunta,
				"2"=>$reg->competencia
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectCompetencia":
		require_once "../modelos/Competencia.php";
		$competencia = new Competencia();

		$rspta = $competencia->selectCompetencia();

		while ($reg = $rspta->fetch_object())
			{
				echo '
						<option value=' . $reg->idCompetencia .'>' .$reg->nombre_competencia . '</option>';
			}
	break;

}
?>