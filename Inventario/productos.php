<?php

    session_start();
    if(isset($_SESSION['loginUsr']) == true ){
        $usr = $_SESSION['loginUsr'];
        include ('conexion.php');
        $q = $cnx->query("call buscaUsr('$usr');");
        $row = $q->fetch();
        $cnx = null;
        $idUsr = $row[3];
        $tipoUsr = $row[1];
        if($tipoUsr == 1){
            header("location: gestionAdmon.php");
        }
        include ('conexion.php');
        $q = $cnx->query("call consulVentas('$idUsr');");
        $c1 = $q->fetch();
        $cnx = null;
        
        include ('conexion.php');
        $q = $cnx->query("call consulVentasMen('$idUsr');");
        $r1 = $q->fetch();
        $cnx = null;
        
        $datos1 = '';$datos2 = '';$datos3 = '';$datos4 = '';
        include ('conexion.php');
        $q = $cnx->query("select  sum(tVentas.cantidad), count(tVentas.idProducto), sum(tVentas.monto), tProductos.nombre  from tVentas inner join tProductos on  tVentas.idProducto  = tProductos.idProducto where idUsr = $idUsr group by tProductos.nombre;");
        while ($matrix = $q->fetch()) {
            $datos1 = $datos1 . '"'. $matrix[0].'",';
            $datos2 = $datos2 . '"'. $matrix[1].'",';
            $datos3 = $datos3 . '"'. $matrix[2].'",';
            $datos4 = $datos4 . '"'. $matrix[3].'",';
        }
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
    <title>Gestión de Productos</title>

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
</head>
<?php
    if(isset($_POST["borrado"])){
        $producto = $_POST["borrado"];
        include ('conexion.php');
        $q = $cnx->query(" delete from tProductos where nombre = '$producto' and idUsr = '$idUsr';");
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
                                                     <span class="email">Usuario</span>
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
                        
                        <div class="row m-t-25">
                            
                            <div class="col-md-4">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo "$c1[1]";?></h2>
                                                <span>Unidades Vendidas</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="graf"></canvas>
                                        </div>
                                        <script>
                                            $(document).ready(function(){
                                             try {
                                                   var ctx = document.getElementById("graf");
                                                   if (ctx) {
                                                     ctx.height = 130;
                                                     var myChart = new Chart(ctx, {
                                                       type: 'line',
                                                       data: {
                                                         labels: [<?php echo $datos4; ?>],
                                                         type: 'line',
                                                         datasets: [{
                                                           data: [<?php echo $datos1; ?>],
                                                           label: 'Unidades',
                                                           backgroundColor: 'transparent',
                                                           borderColor: 'rgba(255,255,255,.55)',
                                                         },]
                                                       },
                                                       options: {

                                                         maintainAspectRatio: false,
                                                         legend: {
                                                           display: false
                                                         },
                                                         responsive: true,
                                                         tooltips: {
                                                           mode: 'index',titleFontSize: 12,titleFontColor: '#000',bodyFontColor: '#000',backgroundColor: '#fff',titleFontFamily: 'Montserrat',bodyFontFamily: 'Montserrat',cornerRadius: 3,intersect: false,
                                                         },
                                                         scales: {
                                                           xAxes: [{
                                                             gridLines: {
                                                               color: 'transparent',zeroLineColor: 'transparent'
                                                             },
                                                             ticks: {
                                                               fontSize: 2,fontColor: 'transparent'
                                                             }
                                                           }],
                                                           yAxes: [{
                                                             display: false,
                                                             ticks: {
                                                               display: false,
                                                             }
                                                           }]
                                                         },
                                                         title: {
                                                           display: false,
                                                         },
                                                         elements: {
                                                           line: {
                                                             tension: 0.00001, borderWidth: 1
                                                           },
                                                           point: {
                                                             radius: 4,hitRadius: 10,hoverRadius: 4
                                                           }
                                                         }
                                                       }
                                                     });
                                                   }
                                                 } catch (error) {
                                                   console.log(error);
                                                 }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div  class="col-md-4">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-calendar-note"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo "$r1[0]";?></h2>
                                                <span>Ventas Registradas</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="graf1"></canvas>
                                        </div>
                                        <script>
                                            $(document).ready(function(){
                                             try {
                                                   var ctx = document.getElementById("graf1");
                                                   if (ctx) {
                                                     ctx.height = 130;
                                                     var myChart = new Chart(ctx, {
                                                       type: 'line',
                                                       data: {
                                                         labels: [<?php echo $datos4; ?>],
                                                         type: 'line',
                                                         datasets: [{
                                                           data: [<?php echo $datos2; ?>],
                                                           label: 'Ventas',
                                                           backgroundColor: 'transparent',
                                                           borderColor: 'rgba(255,255,255,.55)',
                                                         },]
                                                       },
                                                       options: {

                                                         maintainAspectRatio: false,
                                                         legend: {
                                                           display: false
                                                         },
                                                         responsive: true,
                                                         tooltips: {
                                                           mode: 'index',titleFontSize: 12,titleFontColor: '#000',bodyFontColor: '#000',backgroundColor: '#fff',titleFontFamily: 'Montserrat',bodyFontFamily: 'Montserrat',cornerRadius: 3,intersect: false,
                                                         },
                                                         scales: {
                                                           xAxes: [{
                                                             gridLines: {
                                                               color: 'transparent',zeroLineColor: 'transparent'
                                                             },
                                                             ticks: {
                                                               fontSize: 2,fontColor: 'transparent'
                                                             }
                                                           }],
                                                           yAxes: [{
                                                             display: false,
                                                             ticks: {
                                                               display: false,
                                                             }
                                                           }]
                                                         },
                                                         title: {
                                                           display: false,
                                                         },
                                                         elements: {
                                                           line: {
                                                             tension: 0.00001, borderWidth: 1
                                                           },
                                                           point: {
                                                             radius: 4,hitRadius: 10,hoverRadius: 4
                                                           }
                                                         }
                                                       }
                                                     });
                                                   }
                                                 } catch (error) {
                                                   console.log(error);
                                                 }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div  class="col-md-4">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-money"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?php echo "$c1[0]";?></h2>
                                                <span>Ganancias Totales</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="graf2"></canvas>
                                        </div>
                                        <script>
                                            $(document).ready(function(){
                                             try {
                                                   var ctx = document.getElementById("graf2");
                                                   if (ctx) {
                                                     ctx.height = 130;
                                                     var myChart = new Chart(ctx, {
                                                       type: 'line',
                                                       data: {
                                                         labels: [<?php echo $datos4; ?>],
                                                         type: 'line',
                                                         datasets: [{
                                                           data: [<?php echo $datos3; ?>],
                                                           label: 'Monto',
                                                           backgroundColor: 'transparent',
                                                           borderColor: 'rgba(255,255,255,.55)',
                                                         },]
                                                       },
                                                       options: {

                                                         maintainAspectRatio: false,
                                                         legend: {
                                                           display: false
                                                         },
                                                         responsive: true,
                                                         tooltips: {
                                                           mode: 'index',titleFontSize: 12,titleFontColor: '#000',bodyFontColor: '#000',backgroundColor: '#fff',titleFontFamily: 'Montserrat',bodyFontFamily: 'Montserrat',cornerRadius: 3,intersect: false,
                                                         },
                                                         scales: {
                                                           xAxes: [{
                                                             gridLines: {
                                                               color: 'transparent',zeroLineColor: 'transparent'
                                                             },
                                                             ticks: {
                                                               fontSize: 2,fontColor: 'transparent'
                                                             }
                                                           }],
                                                           yAxes: [{
                                                             display: false,
                                                             ticks: {
                                                               display: false,
                                                             }
                                                           }]
                                                         },
                                                         title: {
                                                           display: false,
                                                         },
                                                         elements: {
                                                           line: {
                                                             tension: 0.00001, borderWidth: 1
                                                           },
                                                           point: {
                                                             radius: 4,hitRadius: 10,hoverRadius: 4
                                                           }
                                                         }
                                                       }
                                                     });
                                                   }
                                                 } catch (error) {
                                                   console.log(error);
                                                 }
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">Productos</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--md">
                                            <button class="au-btn au-btn-icon au-btn--green au-btn--small"  data-toggle="modal" data-target="#largeModal" >
                                            <i class="zmdi zmdi-plus"></i>Producto</button>
                                        </div>
                                        <div class="rs-select2--light rs-select2--xl">
                                            <div class="input-group mb-8">
                                              <div class="input-group-prepend">
                                                <div class="input-group-text"> <i class="zmdi zmdi-search"></i></div>
                                              </div>
                                                <input class="form-control" id="txtBuscar" type="text" placeholder="Buscar producto" onkeypress="barrita()">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <div class="rs-select2--dark rs-select2--xl rs-select2--dark2">
                                            <button class="au-btn au-btn-icon au-btn--black au-btn--small" id="test" onclick="exportar()">Exportar a excel</button>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if(isset($_POST["idProdVend"]) || isset($_POST["vendidas"]) ) {
                                    $idProdVend = $_POST["idProdVend"]; $vend = $_POST["vendidas"];
                                    include ('conexion.php');
                                    $q = $cnx->query("call venta('$idProdVend', '$vend');");
                                    $row = $q->fetch();
                                    $cnx = null;
                                    if($row[0] == "muajaja"){
                                        ?>
                                        <script>
                                            function avisa(){
                                                 Swal.fire({        
                                                type: 'success',
                                                title: 'Venta registrada',
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
                                            function avisa(){
                                                 Swal.fire({        
                                                type: 'error',
                                                title: 'Error',
                                                text: 'no hay suficientes productos',       
                                                });   
                                            }
                                            setTimeout ("avisa()",100);
                                        </script>
                                        <?php
                                    }

                                }
                                ?>
                                <?php
                                if(isset($_POST["cate"]) || isset($_POST["nombre"]) || isset($_POST["unid"]) || isset($_POST["costo"]) || isset($_POST["cad"])) {
                                    $cat = $_POST["cate"]; $nombre = $_POST["nombre"]; $unidades = $_POST["unid"];
                                    $costo = $_POST["costo"]; $caducidad = $_POST["cad"];
                                    include ('conexion.php');
                                    $q = $cnx->query("call AProdcutos('$nombre', '$unidades', '$costo', '$caducidad', '$cat', '$idUsr');");
                                    $row = $q->fetch();
                                    $cnx = null;
                                    if($row[0] == "Agregado"){
                                        ?>
                                        <script>
                                            function avisa(){
                                                 Swal.fire({        
                                                type: 'success',
                                                title: 'Éxito',
                                                text: 'Producto registrado',       
                                                });   
                                            }
                                            setTimeout ("avisa()",100);
                                        </script>
                                        <?php
                                    }else{
                                         ?>
                                        <script>
                                            function avisa(){
                                                 Swal.fire({        
                                                type: 'error',
                                                title: 'Error',
                                                text: 'El producto ya existe',       
                                                });   
                                            }
                                            setTimeout ("avisa()",100);
                                        </script>
                                        <?php
                                    }

                                }
                                ?>
                                <?php
                                if(isset($_POST["Ecate"]) || isset($_POST["Enombre"]) || isset($_POST["Eunid"]) || isset($_POST["Ecosto"]) || isset($_POST["Ecad"])) {
                                    $cat = $_POST["Ecate"]; $nombre = $_POST["Enombre"]; $unidades = $_POST["Eunid"];
                                    $costo = $_POST["Ecosto"]; $caducidad = $_POST["Ecad"];
                                    include ('conexion.php');
                                    $q = $cnx->query("call actProd('$nombre', '$unidades', '$costo', '$caducidad', '$cat', '$idUsr');");
                                    $row = $q->fetch();
                                    $cnx = null;
                                    if($row[0] == "grrrr"){
                                        ?>
                                        <script>
                                            function avisa(){
                                                 Swal.fire({        
                                                type: 'success',
                                                title: 'Éxito',
                                                text: 'Producto actualizado',       
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
                                                text: 'No se pudo actualizar el producto',       
                                                });   
                                            }
                                            setTimeout ("avisa()",100);
                                        </script>
                                        <?php
                                    }

                                }
                                ?>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2" id="productos">
                                        <thead>
                                            <tr>
                                                <th>Categoría</th>
                                                <th>Nombre</th>
                                                <th>Unidades</th>
                                                <th>Caducidad</th>
                                                <th>Días para que se caduquen</th>
                                                <th>Precio</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="busqueda">
                                            <?php 
                                            	
                                            include ('conexion.php');
                                            $q = $cnx->query("call consultaProd('$idUsr')");
                                            while ($row = $q->fetch()) {
                                            $date1 = new DateTime("now");
                                            $date2 = new DateTime( $row[3]);
                                            $diff = $date1->diff($date2);
                                            $nombre =$row[0]; 
                                            ?>
                                            <tr class="tr-shadow"id="nombre">
                                                <td>
                                                    <span class="block-email"><?php echo $row[4]; ?></span>
                                                </td>
                                                <td class="desc"><?php echo $row[0]; ?></td>
                                                <td ><?php echo $row[1]; ?></td>
                                                <td><?php echo $row[3]; ?></td>
                                                <td>
                                                   <?php
                                                    if($diff->days > 40){
                                                        ?>
                                                        <span class="status--process"><?php  echo $diff->days . ' días '; ?></span>
                                                        <?php
                                                    }else{
                                                        if($diff->days > 5){
                                                        ?>
                                                        <span class="status--warning"><?php  echo $diff->days . ' días '; ?></span>
                                                        <?php
                                                        }else{
                                                        ?>
                                                        <span class="status--denied"><?php  echo $diff->days . ' días '; ?></span>
                                                        <?php    
                                                        }
                                                    }
                                                   ?>
                                                    
                                                </td>
                                                <td>$<?php echo $row[2]; ?></td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="modal" data-placement="top" data-target="#mediumModal" title="Edit" id="nombre" value="<?php echo $nombre; ?>" name="<?php echo $nombre ?>" onclick="buscarProd('<?php echo $nombre; ?>','<?php echo $idUsr; ?>')">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Borrar" id="nombre" value="<?php echo $nombre; ?>" name="<?php echo $nombre; ?>" onclick="borrarProd('<?php echo $nombre; ?>','<?php echo $idUsr; ?>')">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                        <button class="item" data-toggle="modal" data-placement="top" data-target="#smallmodal"  title="Venta"  value="<?php echo $nombre; ?>" name="<?php echo $nombre; ?>" onclick="vender('<?php echo $nombre; ?>','<?php echo $idUsr; ?>')">
                                                            <i class="zmdi zmdi-money"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            
                                            $cnx = null;
                                            ?>
                                            <tr class="spacer"></tr>
                                        </tbody>
                                    </table>
                                    
                                </div>
                                 <!-- END DATA TABLE-->
                            </div>
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
        </div>
       <!-- modal large -->
        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <h5 class="modal-title" id="largeModalLabel">Agregar Producto</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                        <div class="card">
                                    <div class="card-header">
                                        <strong>Por favor, llena el formulario</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="productos.php" method="post" enctype="multipart/form-data" class="form-horizontal">

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Categoría</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="cate" class="form-control" >
                                                    <small class="form-text text-muted">Escribe la categoría del producto</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Nombre</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="nombre"  class="form-control">
                                                    <small class="form-text text-muted">Escribe el nombre del producto</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Unidades</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="number" id="text-input" name="unid"  class="form-control">
                                                    <small class="form-text text-muted">Ingresa el número de piezas por producto</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Costo</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="number" id="text-input" name="costo" class="form-control">
                                                    <small class="form-text text-muted">Ingresa el precio por producto</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="disabled-input" class=" form-control-label">Fecha de caducidad</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="date" id="disabled-input" name="cad"   class="form-control">
                                                    <small class="form-text text-muted">Ingresa la caducidad del producto</small>
                                                </div>
                                            </div>
                                            
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-dot-circle-o"></i> Agregar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                        </div>
                </div>
        </div>
        <!-- end modal large -->
        <?php
            include ('editProducto.php');
            include ('venta.php');
        ?>
        
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