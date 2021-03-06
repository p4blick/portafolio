<?php 
session_start();
require_once "../modelos/Usuario.php";

$usuario=new Usuario();

$idUsuario=isset($_POST["idUsuario"])? limpiarCadena($_POST["idUsuario"]):"";
$idGerencia=isset($_POST["idGerencia"])? limpiarCadena($_POST["idGerencia"]):"";
$idArea=isset($_POST["idArea"])? limpiarCadena($_POST["idArea"]):"";
$idSubGerencia=isset($_POST["idSubGerencia"])? limpiarCadena($_POST["idSubGerencia"]):"";
$idCargo=isset($_POST["idCargo"])? limpiarCadena($_POST["idCargo"]):"";
$idPerfil_Usuario=isset($_POST["idPerfil_Usuario"])? limpiarCadena($_POST["idPerfil_Usuario"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$rut=isset($_POST["rut"])? limpiarCadena($_POST["rut"]):"";
$fechaIngreso=isset($_POST["fechaIngreso"])? limpiarCadena($_POST["fechaIngreso"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$idUsuario2=isset($_POST["idUsuario2"])? limpiarCadena($_POST["idUsuario2"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idUsuario)){
			$rspta=$usuario->insertar($idGerencia,$idArea,$idSubGerencia,$idCargo,$idPerfil_Usuario,$nombre,$rut,$fechaIngreso,$login,$correo,$clave,$_POST['permiso'],$idUsuario2);
			echo $rspta ? "Usuario registrado" : "No se pudieron registrar todos los datos del usuario";
		}
		else {
			$rspta=$usuario->editar($idUsuario,$idGerencia,$idArea,$idSubGerencia,$idCargo,$idPerfil_Usuario,$nombre,$rut,$fechaIngreso,$login,$correo,$clave,$_POST['permiso'],$idUsuario2);
			echo $rspta ? "Usuario actualizado" : "Usuario no se pudo actualizar";
		}
	break;


	case 'mostrar':
		$rspta=$usuario->mostrar($idUsuario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		
	break;

	case 'listar':
		$rspta=$usuario->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idUsuario.')"><i class="fa fa-pencil"></i></button>',
 				"1"=>$reg->rut,
 				"2"=>$reg->nombre,
 				"3"=>$reg->correo,
 				"4"=>$reg->fechaIngreso,
				"5"=>$reg->cargo,
				"6"=>$reg->area,
				"7"=>$reg->gerencia,
				"8"=>$reg->subgerencia,
				"9"=>$reg->perfil_usuario
 	
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Informaci??n para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

    //Case para mostrar en select los datos a ingresar

	case "selectGerencia":
		require_once "../modelos/Gerencia.php";
		$gerencia = new Gerencia();

		$rspta = $gerencia->selectGerencia();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idGerencia . '>' . $reg->nombre_gerencia . '</option>';
				}
	break;

    case "selectArea":
		require_once "../modelos/Area.php";
		$area = new Area();

		$rspta = $area->selectArea();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idArea . '>' . $reg->nombre_area . '</option>';
				}
	break;

    case "selectSubGerencia":
		require_once "../modelos/SubGerencia.php";
		$subGerencia = new SubGerencia();

		$rspta = $subGerencia->selectSubGerencia();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idSubGerencia . '>' . $reg->nombre_subGerencia . '</option>';
				}
	break;

    case "selectCargo":
		require_once "../modelos/Cargo.php";
		$cargo = new Cargo();

		$rspta = $cargo->selectCargo();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idCargo . '>' . $reg->nombre_cargo . '</option>';
				}
	break;

    case "selectPerfilUsuario":
		require_once "../modelos/Perfil_Usuario.php";
		$perfil_usuario = new Perfil_Usuario();

		$rspta = $perfil_usuario->selectPerfilUsuario();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idPerfil_Usuario . '>' . $reg->nombre_perfilUsuario . '</option>';
				}
	break;
	
	/*
	case "selectEvaluador":
		$evaluador=new Usuario();
		
		$rspta=$evaluador->selectEvaluador();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option name="evaluador"  value=' . $reg->idUsuario . '>' . $reg->nombre . '</option>';
					
				}
	break;
	*/ 

	case "selectEvaluador":
		require_once "../modelos/Evaluador.php";
		$evaluador = new Evaluador();

		$rspta = $evaluador->selectEvaluador();

		//Obtener los permisos asignados al usuario
		$id=$_GET['id'];
		$marcados = $evaluador->listarDetalle($id);

		while ($reg = $rspta->fetch_object())
				{
					echo '<option  value=' . $reg->idUsuario . '>' . $reg->nombre . '</option>';
				}
	break;
	
		
		

	case 'permisos':
		//Obtenemos todos los permisos de la tabla permisos
		require_once "../modelos/Permiso.php";
		$permiso = new Permiso();
		$rspta = $permiso->listar();

		//Obtener los permisos asignados al usuario
		$id=$_GET['id'];
		$marcados = $usuario->listarmarcados($id);
		//Declaramos el array para almacenar todos los permisos marcados
		$valores=array();

		//Almacenar los permisos asignados al usuario en el array
		while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->idPermiso);
			}

		//Mostramos la lista de permisos en la vista y si est??n o no marcados
		while ($reg = $rspta->fetch_object())
				{
					$sw=in_array($reg->idPermiso,$valores)?'checked':'';
					echo '<li> <input type="checkbox" id="permi" '.$sw.'  name="permiso[]" value="'.$reg->idPermiso.'">'.$reg->nombre_permiso.'</li>';
				}
	break;

	case 'verificar':
		$logina=$_POST['logina'];
	    $clavea=$_POST['clavea'];

		$rspta=$usuario->verificar($logina, $clavea);

		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {
	        //Declaramos las variables de sesi??n
	        $_SESSION['idUsuario']=$fetch->idUsuario;
	        $_SESSION['nombre']=$fetch->nombre;
	        $_SESSION['login']=$fetch->login;

		}
		echo json_encode($fetch);

		//Obtenemos los permisos del usuario
		$marcados = $usuario->listarmarcados($fetch->idUsuario);

		//Declaramos el array para almacenar todos los permisos marcados
		$valores=array();

		//Almacenamos los permisos marcados en el array
		while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->idPermiso);
			}

		//Determinamos los accesos del usuario
		in_array(1,$valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
		in_array(2,$valores)?$_SESSION['mantenedor']=1:$_SESSION['mantenedor']=0;
		in_array(3,$valores)?$_SESSION['evaluacion']=1:$_SESSION['evaluacion']=0;
		
	break;

	case 'salir':
		//Limpiamos las variables de sesi??n   
        session_unset();
        //Destru??mos la sesi??n
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");

	break;



}
?>