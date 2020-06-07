

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

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
    <script src="css/js/fn.js" type="text/javascript"></script>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            
                            <a href="#">
                                <img src="css/images/logo.png" alt="" />
                            </a>
                            
                        </div>
                        <div class="login-form">
                            <form action="index.php" method="POST">
                                <div class="form-group">
                                    <label>Usuario</label>
                                    <input class="au-input au-input--full" type="text" onkeypress="return checar(event)" name="username" placeholder="Escribe tu Usuario">
                                </div>
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input class="au-input au-input--full" type="password" onkeypress="return checar(event)" name="password" placeholder="Escribe tu contraseña">
                                </div>
                                <?php
                                    session_start(); // Iniciando sesion
                                        if (empty($_POST['username']) || empty($_POST['password'])) {
                                            $error = "Escribe un usuario valido";
                                        }else{
                                            $usr= $_POST['username'];
                                            $psw= $_POST['password'];
                                            include ('conexion.php');
                                            // Utilizar la conexión aquí

                                            $q = $cnx->query("call iniciarSes('$usr' , '$psw');");
                                            $columnas = $q->fetch();
                                            if($columnas[0] == "SI INICIAR"){
                                                $tipo = $columnas[1];
                                                if ($tipo==1){

                                                    $_SESSION['loginUsr']=$usr;
                                                    header("location: gestionAdmon.php"); 
                                                } else {
                                                    if($tipo == 2){
                                                        $_SESSION['loginUsr']=$usr;
                                                        header("location: productos.php"); 
                                                    }
                                                }
                                            }else{
                                                ?>
                                                <script>
                                                    function avisa(){
                                                         Swal.fire({        
                                                        type: 'error',
                                                        title: 'Error',
                                                        text: 'Datos de usuario incorrectos',       
                                                        });   
                                                    }
                                                    setTimeout ("avisa()",100);
                                                </script>
                                                <?php
                                            }
                                        }
                                    $cnx = null;
                                ?>
                            <div class="alert alert-warning" role="alert">
                                Recuerda que no se aceptan caracteres especiales.
                            </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20"  type="submit">Iniciar Sesión</button>
                            </form>
                            <div class="register-link">
                                <p>
                                    ¿No tienes una cuenta?
                                    <a href="registro.php">Registrate aquí</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

     <!-- Jquery JS-->
    <script src="css/vendor/jquery-3.2.1.min.js"></script>
    <script src="css/js/jquery.table2excel.js" type="text/javascript"></script>
    
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