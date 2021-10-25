var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
}

//Validar solo letras en el campo input
$("#nombre_tipoCompetencia").bind('keypress', function(event) {
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
	$("#idTipo_Competencia").val("");
    $("#nombre_tipoCompetencia").val("");
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
					url: '../ajax/tipo_competencia.php?op=listar',
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
		url: "../ajax/tipo_competencia.php?op=guardaryeditar",
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


//Funcion mostrar cargo a modificar

function mostrar(idTipo_Competencia)
{
	$.post("../ajax/tipo_competencia.php?op=mostrar",{idTipo_Competencia : idTipo_Competencia}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#nombre_tipoCompetencia").val(data.nombre_tipoCompetencia);
		$("#idTipo_Competencia").val(data.idTipo_Competencia);
	})
}


//Funcion para descativar registros
function desactivar(idTipo_Competencia)
{
	bootbox.confirm("¿Esta seguro de desactivar el tipo de competencia?", function(result){
		if(result)
		{
			$.post("../ajax/tipo_competencia.php?op=desactivar", {idTipo_Competencia : idTipo_Competencia}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

//Funcion para activar registros
function activar(idTipo_Competencia)
{
	bootbox.confirm("¿Esta seguro de activar el tipo de competencia?", function(result){
		if(result)
		{
			$.post("../ajax/tipo_competencia.php?op=activar", {idTipo_Competencia : idTipo_Competencia}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}



init();