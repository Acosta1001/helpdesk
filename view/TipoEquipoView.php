<?php
$titulo_pag='Administrar Tipo de Equipo';
include_once 'layouts/header.php';
include_once 'layouts/nav.php';
?>

<!------------------------------------------------------------>
<!--   Ventana Modal para CREAR Y EDITAR Tipo de Equipo      -->
<!------------------------------------------------------------>
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">      
        <div class="modal-header">
          <h5 class="modal-title"><span id="titulo">Crear</span> Tipo de Equipo</h5>
          <button data-dismiss="modal" arial-label="close" class="close">
            <span arial-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-success text-center" id="add" style='display:none;'>
            <i class="fa fa-check-circle m-1"> Operación realizada correctamente</i>
          </div>
          <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
            <i class="fa fa-times-circle m-1"> El registro ya existe</i>
          </div>
          <form id="form-crear">
              <div class="form-group">
                <label>Id</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                  </div>
                  <input type="text" id="id_tip" class="form-control" placeholder="ID" disabled>
                </div>
              </div>
              <div class="form-group">
                <label>Nombre</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-tools"></i></span>
                  </div>
                  <input type="text" id="nom_tip" class="form-control" placeholder="Ingrese nombre" required>
                </div>
              </div>    
              <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn bg-gradient-primary">Guardar</button>
              </div>
          </form>
        </div>
    </div>
  </div>
</div>

<!-- Content Wrapper -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo $titulo_pag;?>
          <button class="btn-crear btn bg-gradient-primary btn-sm m-2" data-toggle="modal" data-target="#crear">Crear</button>
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><?php echo $titulo_pag;?></li>
        </ol>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Tipos de Equipo</h3>
          </div>
          <div class="card-body">
            <table id="tablaTipoEquipo" class="table table-bordered table-hover dataTable dtr-inline" role="grid"></table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
include_once 'layouts/footer.php';
?>
<script src="../assets/js/TipoEquipo.js"></script>
