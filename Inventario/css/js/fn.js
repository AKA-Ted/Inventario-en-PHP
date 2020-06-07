function checar(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
    
}
function reset() {
        document.getElementById("cambiausr").reset();
      }

function borrarC(user){
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás recuperar cualquier información relacionada con el usuario",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Estoy seguro',
        cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.value) {
       var url="gestionAdmon.php";
        $.ajax({
            type: "POST",
            url:url,
            data:{nombre:user},
            success: function(){
                window.location.assign("gestionAdmon.php");
            }
        });
        Swal.fire({        
            type: 'success',
            title: 'Usuario eliminado',
            html: 'La página se recargará en <strong></strong> segundos.',
            timer: 2000, //tiempo del timer
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
        setTimeout(function(){ window.location="gestionAdmon.php"; }, 2000);
    
    } else if (
      // Read more about handling dismissals
      result.dismiss === Swal.DismissReason.cancel
    ) {
      Swal.fire({        
        type: 'error',
        title: 'Error',
        text: 'Usuario no eliminado',       
        });
    }
  })    
}   

function borrarProd(prod){
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás recuperar cualquier información relacionada con el producto",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Estoy seguro',
        cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.value) {
       var url="productos.php";
        $.ajax({
            type: "POST",
            url:url,
            data:{borrado:prod},
            success: function(){
                window.location.assign("productos.php");
            }
        });
        Swal.fire({        
            type: 'success',
            title: 'Producto borrado',
            html: 'La página se recargará en <strong></strong> segundos.',
            timer: 2000, //tiempo del timer
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
        setTimeout(function(){ window.location="productos.php"; }, 2000);
    
    } else if (
      // Read more about handling dismissals
      result.dismiss === Swal.DismissReason.cancel
    ) {
      Swal.fire({        
        type: 'error',
        title: 'Error',
        text: 'Producto no borrado',       
        });
    }
  })    
}

function buscar(user){
    var url="editUsr.php";
    $.ajax({
        type: "POST",
        url:url,
        data:{nombre:user},
        success: function(datos){
            
            $('#akisi').html(datos);
        }
    });
    
}
   
function vender(prod,id){
   var url="venta.php";
    $.ajax({
        type: "POST",
        url:url,
        data:{producto:prod, idUsr:id},
        success: function(datos){
           $('#actualiza').html(datos);
        },
        error: function(datos){
            alert(datos);
        }
    });
    
    }

function buscarProd(prod,id){
    var url="editProducto.php";
    $.ajax({
        type: "POST",
        url:url,
        data:{producto:prod, idUsr:id},
        success: function(datos){
           $('#akisi').html(datos);
        },
        error: function(datos){
            alert(datos);
        }
    });
}

function exportar() {
    $("#productos").table2excel({
            name: "Excel Document Name",
            filename: "myFileName" + new Date().toISOString().replace(/[\-\:\.]/g, ""),
            fileext: ".xls",
            exclude_img: true,
            exclude_links: true,
            exclude_inputs: true
    });
     setTimeout(function(){ window.location="productos.php"; }, 1000);
}

function barrita(){
     $("#txtBuscar").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#busqueda tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
}