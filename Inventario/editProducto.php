<?php
    if(isset($_POST["producto"]) || isset($_POST["idUsr"])){
        $producto=$_POST["producto"];
        $id=$_POST["idUsr"];
        //echo $producto;
        include ('conexion.php');
        $q = $cnx->query("call buscaProd('$id','$producto');");
        $row = $q->fetch();
        $cnx = null;
?>

                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">
                                    Editar información de <?php echo "$producto "; ?>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">
                                            x
                                    </span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Por favor, llena el formulario</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="productos.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            <input type="hidden" id="text-input" name="EidUsr"  class="form-control" value="<?php echo $id; ?>">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Categoría</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="Ecate" class="form-control" value="<?php echo $row[4]; ?>">
                                                    <small class="form-text text-muted">Escribe la categoría del producto</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Nombre</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="Enombre"  class="form-control"  value="<?php echo $producto; ?>">
                                                    <small class="form-text text-muted">Escribe el nombre del producto</small>
                                                </div>
                                            </div>
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Unidades</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="number" id="text-input" min="1"name="Eunid"  class="form-control" value="<?php echo $row[1]; ?>">
                                                    <small class="form-text text-muted">Ingresa el número de piezas por producto</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Costo</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="number" min="1"id="text-input" name="Ecosto" class="form-control" value="<?php echo $row[2]; ?>">
                                                    <small class="form-text text-muted">Ingresa el precio por producto</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="disabled-input" class=" form-control-label">Fecha de caducidad</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="date" id="disabled-input" name="Ecad" class="form-control" value="<?php echo $row[3]; ?>">
                                                    <small class="form-text text-muted">Ingresa la caducidad del producto</small>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-dot-circle-o"></i> Actualizar Datos
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                            </div>
<?php
        
    
    }
    
?>
<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
            <div id="modalE" class="modal-dialog modal-lg" role="document">
                    <div class="modal-content" id="akisi">
                    </div>
            </div>
    </div>

