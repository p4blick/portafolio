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
	$.post("../ajax/acciones.php?op=selectCompetencia", function(r){
		$("#idCompetencia").html(r);
		$('#idCompetencia').selectpicker('refresh');

	});
}

//Función limpiar
function limpiar()
{
	$("#idAcciones").val("");
    $("#pregunta").val("");

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
					url: '../ajax/acciones.php?op=listar',
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
		url: "../ajax/acciones.php?op=guardaryeditar",
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

function mostrar(idAcciones)
{
	$.post("../ajax/acciones.php?op=mostrar",{idAcciones : idAcciones}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#idCompetencia").val(data.idCompetencia);
		$("#idCompetencia").selectpicker('refresh');
        $("#pregunta").val(data.pregunta);
		$("#idAcciones").val(data.idAcciones);
	})
}

//Funcion para descativar registros
function desactivar(idAcciones)
{
	bootbox.confirm("¿Esta seguro de desactivar el Acciones?", function(result){
		if(result)
		{
			$.post("../ajax/acciones.php?op=desactivar", {idAcciones : idAcciones}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

//Funcion para activar registros
function activar(idAcciones)
{
	bootbox.confirm("¿Esta seguro de activar el Acciones?", function(result){
		if(result)
		{
			$.post("../ajax/acciones.php?op=activar", {idAcciones : idAcciones}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}




init();