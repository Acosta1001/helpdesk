<?php
$titulo_pag = 'Administrar Partes';
include_once 'layouts/header.php';
include_once 'layouts/nav.php';
?>

<!------------------------------------------------------>
<!--   Ventana Modal para CREAR Y EDITAR Partes       -->
<!------------------------------------------------------>
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">      
      <div class="modal-header">
        <h5 class="modal-title"><span id="titulo">Crear</span> Parte</h5>
        <button data-dismiss="modal" aria-label="close" class="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success text-center" id="add" style='display:none;'>
          <i class="fa fa-check-circle m-1"> Operación realizada correctamente</i>
        </div>
        <div class="alert alert-danger text-center" id="noadd" style='display:none;'>
          <i class="fa fa-times-circle m-1"> Error al procesar</i>
        </div>
        <form id="form-crear">
          <input type="hidden" id="id_part">
          
          <div class="form-group">
            <label>Placa</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
              </div>
              <input type="text" id="placa_part" class="form-control" placeholder="Ingrese la placa">
            </div>
          </div>

          <div class="form-group">
            <label>Marca</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-tag"></i></span>
              </div>
              <input type="text" id="marca_part" class="form-control" placeholder="Ingrese la marca">
            </div>
          </div>

          <div class="form-group">
            <label>Serial</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
              </div>
              <input type="text" id="serial_part" class="form-control" placeholder="Ingrese el serial">
            </div>
          </div>

          <div class="form-group">
            <label>Fecha de Compra</label>
            <input type="date" id="fecha_compra_part" class="form-control">
          </div>

          <div class="form-group">
            <label>Proveedor</label>
            <input type="text" id="proveedor_part" class="form-control" placeholder="Ingrese proveedor">
          </div>

          <div class="form-group">
            <label>Fecha de Garantía</label>
            <input type="date" id="fecha_garantia_part" class="form-control">
          </div>

          <div class="form-group">
            <label>Factura</label>
            <input type="text" id="factura_part" class="form-control" placeholder="Ingrese factura">
          </div>

          <div class="form-group">
            <label>Observaciones</label>
            <textarea id="observacion_parte" class="form-control" placeholder="Ingrese observación"></textarea>
          </div>

          <div class="form-group">
            <label>Número de Equipo (num_eq)</label>
            <input type="text" id="num_eq" class="form-control" placeholder="Ingrese código de equipo">
          </div>

          <div class="form-group">
            <label>ID Estado</label>
            <input type="number" id="id_est" class="form-control" placeholder="Ingrese ID estado">
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

<!-- Content Wrapper -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?php echo $titulo_pag; ?>
          <button class="btn-crear btn bg-gradient-primary btn-sm m-2" data-toggle="modal" data-target="#crear">Crear</button>
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><?php echo $titulo_pag; ?></li>
        </ol>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Partes registradas</h3>
          </div>
          <div class="card-body">
            <table id="tablaParte" class="table table-bordered table-hover dataTable dtr-inline" role="grid"></table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include_once 'layouts/footer.php'; ?>
<script src="../assets/js/Parte.js"></script>
