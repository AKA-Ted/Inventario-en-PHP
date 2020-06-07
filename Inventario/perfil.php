<?php

    session_start();
    if(isset($_SESSION['loginUsr']) == true ){
        $usr = $_SESSION['loginUsr'];
        include ('conexion.php');
        $q = $cnx->query("call buscaUsr('$usr');");
        $row = $q->fetch();
        $cnx = null;
        
    } else{
        header("Location: index.php");
    }    
?>

<html lang="en">
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Perfil</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="css/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="css/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="css/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="css/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="css/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="css/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="css/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="css/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="css/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="css/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="css/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/css/theme.css" rel="stylesheet" media="all">
    
    <!-- Links -->
    <script src="css/js/fn.js" type="text/javascript"></script>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                            </form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="css/images/usr.png" alt="" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $usr; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="css/images/usr.png" alt="" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">
                                                            <?php echo $usr; ?>
                                                        </a>
                                                    </h5>
                                                    <?php
                                                        if($row[1] == 1){
                                                        ?>
                                                        <span class="email">Administrador</span>
                                                        <?php
                                                        }else{
                                                        ?>
                                                        <span class="email">Usuario</span>
                                                        <?php
                                                        }
                                                    ?>
                                                     
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <?php
                                                        if($row[1] == 1){
                                                        ?>
                                                        <a href="gestionAdmon.php">
                                                        <i class="zmdi zmdi-redo"></i>Regresar</a>
                                                                <?php
                                                        }else{
                                                             ?>
                                                            <a href="productos.php">
                                                            <i class="zmdi zmdi-redo"></i>Regresar</a>
                                                                    <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Cerrar Sesión</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Por favor llena el formulario </strong> 
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="perfil.php" method="post" enctype="multipart/form-data" class="form-horizontal" id="cambiausr">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label">Usuario</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <p class="form-control-static"><?php echo $usr; ?></p>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-12 col-md-9">
                                                    <input  id="1234" name="tipo"   type="hidden"  class="form-control" value="<?php echo $row[1]; ?>">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="password-input" class=" form-control-label">Contraseña </label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="password" id="password-input" name="psw" placeholder="123456" class="form-control">
                                                    <small class="help-block form-text">Por favor ingresa tu contraseña actual</small>
                                                </div>
                                            </div>
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="password-input" class=" form-control-label">Nueva Contraseña</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="password" id="password-input" name="npsw" placeholder="123456" class="form-control">
                                                    <small class="help-block form-text">Por favor ingresa una nueva contraseña</small>
                                                </div>
                                            </div>
                                             <?php
                                                if(isset($_POST["psw"]) || isset($_POST["npsw"]) || isset($_POST["tipo"]) ){
                                                    $tipo = $_POST["tipo"];  $psw = $_POST["psw"]; $npsw = $_POST["psw"];
                                                    include ('conexion.php');
                                                    $q = $cnx->query("call actUsr('$usr','$psw', '$tipo', '$npsw');");
                                                    $row = $q->fetch();
                                                    $cnx = null;
                                                    if($row[0] == "grrrr"){        
                                                    ?>
                                                    <script>
                                                        function avisa()
                                                        {
                                                             Swal.fire({        
                                                            type: 'success',
                                                            title: 'Éxito',
                                                            text: 'Usuario actualizado',       
                                                            });   
                                                        }
                                                        setTimeout ("avisa()",100);
                                                    </script>
                                                        <?php
                                                    }else{
                                                        ?>
                                                    
                                                        <script>
                                                            function avisa()
                                                            {
                                                                 Swal.fire({        
                                                                type: 'error',
                                                                title: 'Error',
                                                                text: 'No se pudo actualizar el usuario',       
                                                                });   
                                                            }
                                                            setTimeout ("avisa()",100);
                                                        </script>
                                                        <?php
                                                    }   
                                                }
                                            ?>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-dot-circle-o"></i> Actualizar Información
                                                </button>
                                                <button type="reset" class="btn btn-danger btn-sm" onclick="reset()">
                                                    <i class="fa fa-ban"></i> Borrar Campos
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="css/vendor/jquery-3.2.1.min.js"></script>
    <script src="css/js/sweetalert2.all.min.js" type="text/javascript"></script>
    <!-- Bootstrap JS-->
    <script src="css/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="css/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="css/vendor/slick/slick.min.js">
    </script>
    <script src="css/vendor/wow/wow.min.js"></script>
    <script src="css/vendor/animsition/animsition.min.js"></script>
    <script src="css/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="css/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="css/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="css/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="css/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="css/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="css/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="css/js/main.js"></script>

</body>

</html>
<!-- end document-->