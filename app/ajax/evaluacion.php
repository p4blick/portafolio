<?php 
require_once "../modelos/Evaluacion.php";

$evaluacion=new Evaluacion();

$idEvaluacion=isset($_POST["idEvaluacion"])? limpiarCadena($_POST["idEvaluacion"]):"";
$puntaje=isset($_POST["puntaje"])? limpiarCadena($_POST["puntaje"]):"";
$fecha_evaluacion=isset($_POST["fecha_evaluacion"])? limpiarCadena($_POST["fecha_evaluacion"]):"";
$idDetalle=isset($_POST["idDetalle"])? limpiarCadena($_POST["idDetalle"]):"";




switch ($_GET["op"]){

	case 'guardaryeditar':
		if (empty($idEvaluacion)){
			$rspta=$evaluacion->insertar($puntaje,$fecha_evaluacion,$idDetalle);
			echo $rspta ? "Evaluacion Registrada" : "Evaluacion no se pudo registrar";
		}
		else {
			$rspta=$evaluacion->editar($idEvaluacion,$puntaje,$fecha_evaluacion,$idDetalle);
			echo $rspta ? "Evaluacion actualizado" : "Evaluacion no se pudo actualizar";
		}
	break;

	
	case 'mostrar':
		$rspta=$evaluacion->mostrar($idEvaluacion);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarEvaluado':
		$rspta=$evaluacion->listarEvaluado();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(				
 				"0"=>'<button class="btn btn-success" onclick="mostrar('.$reg->idUsuario.')"><i class="fa fa-plus-circle"></i> Iniciar</button>',
				"1"=> $reg->rut,
				"2"=>$reg->nombre,
				"3"=>$reg->correo,
				"4"=>$reg->cargo,
				"5"=>$reg->area,
				"6"=>$reg->perfil_usuario

 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;


	
	case "listara":
		require_once "../modelos/Acciones.php";
		$acciones = new Acciones();

		$rspta = $acciones->listara();
		
		$total = 0;
		$puntos =0;
		$puntos2 =0;
		
		echo 	'<thead style="background-color:#A9D0F5">
					<th style="width: 300px;">Competencias</th>
					<th style="width: 1000px;">Acciones</th>
                    <th style="width: 300px;">Puntaje</th>
                                    
            	</thead>';

		while ($reg = $rspta->fetch_object())
				{
					echo '	<tr class="filas">
								<td>'.$reg->competencia.'</td>
								<td>'.$reg->pregunta.'</td>
								<td><select >
										<option value='.$puntos=('5').'>No Aplica</option>
										<option value='.$puntos2=('1').'>Pocas veces</option>
										<option value="1">A menudo</option>
										<option value="1">Muchas veces</option>
							  		</select>
								</td>
							</tr>';
						
							
						
						$total=$puntos+$puntos2;
				}
				echo '<tfoot>
								<th>TOTAL</th>
								
								
								<th><h4 id="total">puntos: '.$total.'</h4></th> 
					</tfoot>';    
				
    			
		/*
	case 'listarAc':
		require_once "../modelos/Acciones.php";
		$acciones = new Acciones();

		$rspta = $acciones->listara();

 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(				
 				"0"=>$reg->pregunta,
				"1"=>'<select >
				<option value="0">No Aplica</option>
				<option value="20">Pocas veces</option>
				<option value="30">A menudo</option>
				<option value="50">Muchas veces</option>
			  	</select>'	
 				);
 		}
 		$results = array(
			"sEcho"=>1, //Información para el datatables
			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
			"aaData"=>$data);
		echo json_encode($results);

	break;
	*/	
			


	break;
	
	

	

	
}
?>

