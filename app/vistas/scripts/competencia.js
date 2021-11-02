var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
	//Cargamos los items al select categoria
	$.post("../ajax/competencia.php?op=selectTipoCompetencia", function(r){
		$("#idTipo_Competencia").html(r);
		$('#idTipo_Competencia').selectpicker('refresh');

	});

	$.post("../ajax/competencia.php?op=selectPerfilUsuario", function(r){
		$("#idPerfil_Usuario").html(r);
		$('#idPerfil_Usuario').selectpicker('refresh');

	});



}

//Validar solo letras en el campo input
$("#nombre_competencia").bind('keypress', function(event) {
	var regex = new RegExp("^[a-zA-Z ]+$");
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
	if (!regex.test(key)) {
	  event.preventDefault();
	  return false;
	}
  });

//Función limpiar
function limpiar()
{
	$("#idCompetencia").val("");
    $("#nombre_competencia").val("");
	
	
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnAgregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnAgregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/competencia.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


//Funcion guardar o editar
function guardaryeditar(e)
{
	e.preventDefault();  //No se activara la accion predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/competencia.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success : function(datos)
		{
			bootbox.alert(datos);
			mostrarform(false);
			tabla.ajax.reload();
		}
	});
	limpiar();
}


//Funcion mostrar competencia modificar

function mostrar(idCompetencia)
{
	$.post("../ajax/competencia.php?op=mostrar",{idCompetencia : idCompetencia}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#idTipo_Competencia").val(data.idTipo_Competencia);
		$("#idTipo_Competencia").selectpicker('refresh');
        $("#idPerfil_Usuario").val(data.idPerfil_Usuario);
		$("#idPerfil_Usuario").selectpicker('refresh');

        $("#nombre_competencia").val(data.nombre_competencia);
		$("#idCompetencia").val(data.idCompetencia);


	})
}

//Función para desactivar registros
function desactivar(idCompetencia)
{
	bootbox.confirm("¿Está Seguro de desactivar la Competencia?", function(result){
		if(result)
        {
        	$.post("../ajax/Competencia.php?op=desactivar", {idCompetencia : idCompetencia}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idCompetencia)
{
	bootbox.confirm("¿Está Seguro de activar la Competencia?", function(result){
		if(result)
        {
        	$.post("../ajax/competencia.php?op=activar", {idCompetencia : idCompetencia}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}





init();