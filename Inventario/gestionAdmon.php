<?php

    session_start();
    if(isset($_SESSION['loginUsr']) == true ){
        $usr = $_SESSION['loginUsr'];
        include ('conexion.php');
        $q = $cnx->query("call buscaUsr('$usr');");
        $row = $q->fetch();
        $cnx = null;
        $idUsr = $row[1];
        if($idUsr == 2){
            header("location: productos.php"); 
        }
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
    <title>Menu de Administrador</title>

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
    
    <link href="css/js/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
    <!-- Links -->
    <script src="css/js/fn.js" type="text/javascript"></script>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="lib/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="lib/sweet-alert.css">
</head>
<?php
    if(isset($_POST["nombre"])){
        $usuario = $_POST["nombre"];
        include ('conexion.php');
        $q = $cnx->query("delete from tUsuarios where nombre = '$usuario';");
        $row = $q->fetch();
        $cnx = null;
    }
?>
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
                                                     <span class="email">Administrador</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    
        
                                                    <a href="perfil.php">
                                                        <i class="zmdi zmdi-settings"></i>Configuración de Perfil</a>
                                                        
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
            
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- USER DATA-->
                                <div class="user-data m-b-30">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>Tabla de Usuarios</h3>
                                        
                                    <div class="table-responsive table-data">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>Nombre</td>
                                                    <td>Tipo</td>
                                                    <td>Contraseña</td>
                                                    <td>Opciones</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    include ('usuarios.php');
                                                ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END USER DATA-->
                            </div>
                        </div>
                        <?php
                        if(isset($_POST["contra"]) || isset($_POST["newcontra"]) || isset($_POST["tipoUsr"]) || isset($_POST["1234"])){
                            $tipo = $_POST["tipoUsr"];
                            $usrop = $_POST["1234"];
                            $contra = $_POST["contra"];
                            $newcontra = $_POST["newcontra"];
                            include ('conexion.php');
                             $q = $cnx->query("call actUsr('$usrop','$contra', '$tipo', '$newcontra');");
                             $row = $q->fetch();
                             $cnx = null;
                             if($row[0] == "grrrr"){        
                             ?>
                                <script>
                                    function avisa(){
                                                 Swal.fire({        
                                                type: 'success',
                                                title: 'Usuario actualizado',
                                                html: 'La página se recargará en <strong></strong> segundos.',
                                                timer: 1900, //tiempo del timer
                                                onBeforeOpen: () => {
                                                  Swal.showLoading()
                                                  timerInterval = setInterval(() => {
                                                    Swal.getContent().querySelector('strong')
                                                      .textContent = Swal.getTimerLeft()
                                                  }, 100)
                                                },
                                                onClose: () => {
                                                  clearInterval(timerInterval)
                                                }
                                              }).then((result) => {
                                                if (
                                                  // Read more about handling dismissals
                                                  result.dismiss === Swal.DismissReason.timer
                                                ) {
                                                  console.log('I was closed by the timer')
                                                }
                                              });   
                                            }
                                            setTimeout ("avisa()",100);
                                            function redireccionar(){                           
                                            window.location="productos.php";} 
                                            setTimeout ("redireccionar()",2000);
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
                    </div>
                    <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2019 Inverne.</p>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            
        </div>
        
        <?php
            include ('editUsr.php');
        ?>
        
    <!-- end modal medium -->
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
