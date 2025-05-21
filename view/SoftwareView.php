<?php
$titulo_pag='Administrar Software';
include_once 'layouts/header.php';
include_once 'layouts/nav.php';
?>

<!------------------------------------------------------>
<!--   Ventana Modal para CREAR Y EDITAR Softwares -->
<!------------------------------------------------------>
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">      
        <div class="modal-header">
          <h5 class="modal-title"><span id="titulo">Crear</span> </h5>
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
              <label>ID</label>
              <input type="text" id="id_soft" class="form-control" placeholder="Ingrese ID">
            </div>

            <div class="form-group">
              <label>Producto</label>
              <input type="text" id="producto_soft" class="form-control" placeholder="Nombre del producto">
            </div>

            <div class="form-group">
              <label>Número de Licencia</label>
              <input type="text" id="num_licencia_soft" class="form-control" placeholder="Número de licencia">
            </div>

            <div class="form-group">
              <label>Versión</label>
              <input type="text" id="version_soft" class="form-control" placeholder="Versión del software">
            </div>

            <div class="form-group">
              <label>Cantidad</label>
              <input type="number" id="cant_soft" class="form-control" placeholder="Cantidad">
            </div>

            <div class="form-group">
              <label>Fecha de Compra</label>
              <input type="date" id="fecha_compra_soft" class="form-control">
            </div>

            <div class="form-group">
              <label>Valor</label>
              <input type="number" step="0.01" id="valor_soft" class="form-control" placeholder="Valor en $">
            </div>

            <div class="form-group">
              <label>Proveedor</label>
              <input type="text" id="proveedor_soft" class="form-control" placeholder="Proveedor">
            </div>

            <div class="form-group">
              <label>Factura</label>
              <input type="text" id="factura_soft" class="form-control" placeholder="Número de factura">
            </div>

            <div class="form-group">
              <label>Disponible</label>
              <select id="disponible_soft" class="form-control">
                <option value="Sí">Sí</option>
                <option value="No">No</option>
              </select>
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
<!-------------------------------------------------->
<!-- FIN Ventana Modal para el crear              -->
<!-------------------------------------------------->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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

    <!------------------ Main content ------------------------------>
    <!-------------------------------------------------------------->
    <!------------------------ Inicio ------------------------------>
    <section class="content">
      <div class="row">
        <div class="col-12">
        <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Software</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tablaSoftware" class="table table-bordered table-hover dataTable dtr-inline" role="grid"></table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
include_once 'layouts/footer.php';
?>
<script src="../assets/js/Software.js"></script>