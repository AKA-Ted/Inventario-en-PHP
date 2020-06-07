<?php
    include ('conexion.php');
            // Utilizar la conexión aquí
            
    $q = $cnx->query("call consultaUsr();");
    

    while ($columnas = $q->fetch()) {
        $tipo = $columnas[1];
        $nombre = $columnas[0];
        echo "<tr>";
            echo "<td>";
                echo " <div class=\"table-data__info\">";
                    echo "<h6>$columnas[0]</h6>" ;
                echo "</div>";
            echo "</td>";
            echo "<td>";
                if($tipo == 1 ){
                   echo "<span class=\"role admin\">administrador</span>";
                } else {
                    if($tipo == 2){
                        echo "<span class=\"role user\">usuario</span>";
                    }else{
                        echo "<span class=\"role member\">error</span>";
                    }
                }
            echo "</td>";
            echo "<td>";
                echo "<div class=\"table-data__info\">";
                    echo "<h6>$columnas[2]</h6>" ;
                echo "</div>";
            echo "</td>";
            echo "<td>";
                echo "<div class=\"table-data-feature\">";
                    echo "<button class=\"item\" id=\"nombre\" value=\"$columnas[0]\"  name=\"$nombre\" onclick = \"buscar('$nombre')\" data-toggle=\"modal\" data-placement=\"top\" data-target=\"#mediumModal\" title=\"Edit\"  >"  ;
                        echo "<i class=\"zmdi zmdi-edit\"></i>";
                    echo "</button>";
                    echo "<button onclick = \"borrarC('$nombre')\" value=\"$columnas[0]\"  name=\"$nombre\" class=\"item\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\">" ;
                        echo "<i class=\"zmdi zmdi-delete\"></i>";
                    echo "</button>";
                echo "</div>";
            echo "</td>";
        echo "</tr>";
    }
    $cnx = null;
?>