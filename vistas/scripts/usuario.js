//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	//Cargamos los items al select 
	$.post("../ajax/usuario.php?op=selectGerencia", function(r){
	            $("#idGerencia").html(r);
	            $('#idGerencia').selectpicker('refresh');

	})
    
    //Cargamos los items al select 
	$.post("../ajax/usuario.php?op=selectArea", function(r){
	            $("#idArea").html(r);
	            $('#idArea').selectpicker('refresh');

	})

    //Cargamos los items al select 
	$.post("../ajax/usuario.php?op=selectSubGerencia", function(r){
        		$("#idSubGerencia").html(r);
       			$('#idSubGerencia').selectpicker('refresh');

    })

    //Cargamos los items al select 
	$.post("../ajax/usuario.php?op=selectCargo", function(r){
        	$("#idCargo").html(r);
        	$('#idCargo').selectpicker('refresh');

    })

    //Cargamos los items al select 
	$.post("../ajax/usuario.php?op=selectPerfilUsuario", function(r){
        	$("#idPerfil_Usuario").html(r);
        	$('#idPerfil_Usuario').selectpicker('refresh');

    })

	//Mostramos los permisos
	$.post("../ajax/usuario.php?op=permisos&id=",function(r){
		$("#permisos").html(r);
	})

}

//Validar solo letras en el campo input
$("#nombre").bind('keypress', function(event) {
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
	$("#nombre").val("");
	$("#rut").val("");
	$("#correo").val("");
    $("#login").val("");
    $("#clave").val("");
	$("#fechaIngreso").val("");
	$("#idPerfil_Usuario").val("");
	$("#idCargo").val("");
	$("#idSubGerencia").val("");
	$("#idArea").val("");
	$("#idGerencia").val("");
	$(".permi").removeAttr("checked");
	$("#idUsuario").val("");
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
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
	
	$.post("../ajax/usuario.php?op=permisos&id=",function(r){

        $("#permisos").html(r);

    })
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
					url: '../ajax/usuario.php?op=listar',
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
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/usuario.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
	
}


function mostrar(idUsuario)
{
	$.post("../ajax/usuario.php?op=mostrar",{idUsuario : idUsuario}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idGerencia").val(data.idGerencia);
		$('#idGerencia').selectpicker('refresh');
        
        $("#idSubGerencia").val(data.idSubGerencia);
		$('#idSubGerencia').selectpicker('refresh');

        $("#idArea").val(data.idArea);
		$('#idArea').selectpicker('refresh');
        
        $("#idCargo").val(data.idCargo);
		$('#idCargo').selectpicker('refresh');
        
        $("#idPerfil_Usuario").val(data.idPerfil_Usuario);
		$('#idPerfil_Usuario').selectpicker('refresh');
        
        
		$("#nombre").val(data.nombre);
		$("#rut").val(data.rut);
		$("#fechaIngreso").val(data.fechaIngreso);
        $("#correo").val(data.correo);
        $("#login").val(data.login);
        $("#clave").val(data.clave);
 		$("#idUsuario").val(data.idUsuario);

 	});
 	$.post("../ajax/usuario.php?op=permisos&id="+idUsuario,function(r){
		$("#permisos").html(r);
	});
}





init();