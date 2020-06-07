<?php
    if(isset($_POST["producto"]) || isset($_POST["idUsr"])){
        $producto=$_POST["producto"];
        $id=$_POST["idUsr"];
        //echo $producto;
        include ('conexion.php');
        $q = $cnx->query("call buscaProd('$id','$producto');");
        $row = $q->fetch();
        $cnx = null;
        $idProd = $row[5];
?>

                        <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">
                                    Venta de <?php echo "$producto "; ?>
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
                                        <strong>Ingrese la cantidad de productos vendidos</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="productos.php" method="post" enctype="multipart/form-data" class="form-horizontal" >
                                            <input type="hidden" id="text-input" name="idProdVend"  class="form-control" value="<?php echo $idProd; ?>">
                                            <div class="row form-group">
                                                <div class="col-sm-4">
                                                    <label for="text-input" class=" form-control-label">Unidades</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="text-input" class=" form-control-label"><?php echo $row[1];?></label>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sm-4">
                                                    <label for="text-input" class=" form-control-label">Ventas</label>
                                                </div>
                                                <div class="col">
                                                    <input type="number" id="ventas" name="vendidas" min="1" class="form-control" value="1">
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-sm" >
                                                    <i class="fa fa-dot-circle-o"></i> Registrar Venta
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                            </div>
      
<?php
        
    
    }
    
?>
<div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" id="actualiza">
              </div>
    </div>
</div>