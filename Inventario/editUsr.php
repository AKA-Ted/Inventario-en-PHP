<?php
    if(isset($_POST["nombre"])){
        $usuario=$_POST["nombre"];
        //echo $usuario;
        include ('conexion.php');
        $q = $cnx->query("call buscaUsr('$usuario');");
        $row = $q->fetch();
        $cnx = null;
?>

                            <div class="modal-header">
                                <h5 class="modal-title" id="mediumModalLabel">
                                    Editar información de <?php echo "$row[0]"; ?>
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
                                            <strong>Por favor llena el formulario  </strong><span ></span>
                                        </div>
                                        <div class="card-body card-block">
                                            <form action="gestionAdmon.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                <div class="row form-group">
                                                    <div class="col-12 col-md-9">
                                                        <input  id="1234" name="1234"   type="hidden"  class="form-control" value="<?php echo "$usuario"; ?>">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="password-input" class=" form-control-label">Contraseña: </label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="password" id="contra" name="contra" placeholder="<?php echo "$row[2]"; ?>" class="form-control" required="">
                                                        <small class="help-block form-text">Ingresa tu contraseña <strong>actual</strong></small>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="password-input" class=" form-control-label">Nueva Contraseña: </label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="password" id="newcontra" name="newcontra"  class="form-control" required="">
                                                        <small class="help-block form-text">Ingresa una nueva contraseña</small>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Tipo de Usuario</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                     <?php
                                                    switch ($row[1]){
                                                        case 1:
                                                            ?>
                                                            <select name="tipoUsr" id="select" class="form-control" onchange="tipoUsr()">
                                                                
                                                                <option selected value="1">Administrador</option>
                                                                <option value="2">Usuario</option>
                                                            </select>
                                                            <?php
                                                            break;
                                                            ?>
                                                            <?php
                                                        case 2:
                                                            ?>
                                                            <select name="tipoUsr" id="select" class="form-control" onchange="tipoUsr()">
                                                                
                                                                <option value="1">Administrador</option>
                                                                <option selected value="2">Usuario</option>
                                                            </select>
                                                            <?php
                                                            break;
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-sm " onclick="revisa()" >
                                                     Actualizar
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

<div id="jaja">
    
</div>