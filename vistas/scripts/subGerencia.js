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
$("#nombre_subGerencia").bind('keypress', function(event) {
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
	$("#idSubGerencia").val("");
    $("#nombre_subGerencia").val("");
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
					url: '../ajax/subGerencia.php?op=listar',
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
		url: "../ajax/subGerencia.php?op=guardaryeditar",
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

function mostrar(idSubGerencia)
{
	$.post("../ajax/subGerencia.php?op=mostrar",{idSubGerencia : idSubGerencia}, function(data, status)
	{
		data = JSON.parse(data);
		mostrarform(true);

		$("#nombre_subGerencia").val(data.nombre_subGerencia);
		$("#idSubGerencia").val(data.idSubGerencia);
	})
}


//Funcion para descativar registros
function desactivar(idSubGerencia)
{
	bootbox.confirm("¿Esta seguro de desactivar la Sub Gerencia?", function(result){
		if(result)
		{
			$.post("../ajax/subGerencia.php?op=desactivar", {idSubGerencia : idSubGerencia}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

//Funcion para activar registros
function activar(idSubGerencia)
{
	bootbox.confirm("¿Esta seguro de activar la Sub Gerencia?", function(result){
		if(result)
		{
			$.post("../ajax/subGerencia.php?op=activar", {idSubGerencia : idSubGerencia}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}



init();