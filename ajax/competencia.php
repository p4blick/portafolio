<?php 
require_once "../modelos/Competencia.php";

$competencia=new Competencia();

$idCompetencia=isset($_POST["idCompetencia"])? limpiarCadena($_POST["idCompetencia"]):"";
$idTipo_Competencia=isset($_POST["idTipo_Competencia"])? limpiarCadena($_POST["idTipo_Competencia"]):"";
$idPerfil_Usuario=isset($_POST["idPerfil_Usuario"])? limpiarCadena($_POST["idPerfil_Usuario"]):"";
$nombre_competencia=isset($_POST["nombre_competencia"])? limpiarCadena($_POST["nombre_competencia"]):"";

switch ($_GET["op"]){

	case 'guardaryeditar':
		if (empty($idCompetencia)){
			$rspta=$competencia->insertar($idTipo_Competencia,$idPerfil_Usuario,$nombre_competencia);
			echo $rspta ? "Competencia Registrado" : "Competencia no se pudo registrar";
		}
		else {
			$rspta=$competencia->editar($idCompetencia,$idTipo_Competencia,$idPerfil_Usuario,$nombre_competencia);
			echo $rspta ? "Competencia actualizado" : "Competencia no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$competencia->desactivar($idCompetencia);
 		echo $rspta ? "competencia Desactivada" : "competencia no se puede desactivar";
 		break;
	break;

	case 'activar':
		$rspta=$competencia->activar($idCompetencia);
 		echo $rspta ? "competencia activada" : "competencia no se puede activar";
 		break;
	break;

	case 'mostrar':
		$rspta=$competencia->mostrar($idCompetencia);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$competencia->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idCompetencia.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idCompetencia.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idCompetencia.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idCompetencia.')"><i class="fa fa-check"></i></button>',	
							
 				"1"=>$reg->nombre_competencia,
				"2"=>$reg->tipo_competencia,
				"3"=>$reg->perfil_usuario	
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectTipoCompetencia":
		require_once "../modelos/Tipo_Competencia.php";
		$tipo_Competencia = new Tipo_Competencia();

		$rspta = $tipo_Competencia->selectTipoCompetencia();

		while ($reg = $rspta->fetch_object())
			{
				echo '<option value=' . $reg->idTipo_Competencia .'>' .$reg->nombre_tipoCompetencia . '</option>';
			}
	break;

	case "selectPerfilUsuario":
		require_once "../modelos/Perfil_Usuario.php";
		$perfil_usuario = new Perfil_Usuario();

		$rspta = $perfil_usuario->selectPerfilUsuario();

		while ($reg = $rspta->fetch_object())
			{
				echo '<option value=' . $reg->idPerfil_Usuario .'>' .$reg->nombre_perfilUsuario . '</option>';
			}
	break;


}
?>