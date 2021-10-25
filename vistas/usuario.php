<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';
if ($_SESSION['mantenedor']==1)
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Usuarios <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Fecha de Ingreso</th>
                            <th>Cargo</th>
                            <th>Area</th>
                            <th>Gerencia</th>
                            <th>Sub Gerencia</th>
                            <th>Perfil Usuario</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                          <th>Opciones</th>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Fecha de Ingreso</th>
                            <th>Cargo</th>
                            <th>Area</th>
                            <th>Gerencia</th>
                            <th>Sub Gerencia</th>
                            <th>Perfil Usuario</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Nombre Completo(*):</label>
                            <input type="hidden" name="idUsuario" id="idUsuario">
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Rut(*):</label>
                            <input type="text" class="form-control" name="rut" id="rut" required oninput="checkRut(this)" maxlength="9" placeholder="Rut" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha de Ingreso(*):</label>
                            <input type="date" class="form-control" name="fechaIngreso" id="fechaIngreso" required>
                          </div>
                         
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Email(*):</label>
                            <input type="email" class="form-control" name="correo" id="correo" maxlength="45" placeholder="Email" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Gerencia(*):</label>
                            <select id="idGerencia" name="idGerencia" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Area(*):</label>
                            <select id="idArea" name="idArea" class="form-control selectpicker" data-live-search="true"  required></select>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Sub Gerencia(*):</label>
                            <select id="idSubGerencia" name="idSubGerencia" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Cargo(*):</label>
                            <select id="idCargo" name="idCargo" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Perfil de Usuario(*):</label>
                            <select id="idPerfil_Usuario" name="idPerfil_Usuario" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Usuario(*):</label>
                            <input type="text" class="form-control" name="login" id="login" maxlength="9" placeholder="Usuario" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Password(*):</label>
                            <input type="password" class="form-control" name="clave" id="clave" maxlength="9" placeholder="Contraseña" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Permisos:</label>
                            <ul style="list-style: none;" id="permisos">
                            </ul>
                          </div>
                            
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="scripts/usuario.js"></script>

<?php 
}
ob_end_flush();
?> 