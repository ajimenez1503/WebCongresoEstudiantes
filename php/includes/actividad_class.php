<?php
//Clase Hotel

class Actividad{
    var $id;
    var $nombre;
    var $fecha; //string hotel o casa
    var $hora;
    var $foto;
    var $precio; //0-5
    var $descripcion;

    //se le pasa una "row" del query
    function read_actividad($row){
        this->$id=$row["id"];
        this->$nombre=$row["nombre"];
        this->$fecha=$row["fecha"];
        this->$precio=$row["precio"];
        this->$hora=$row["hora"];
        this->$foto=$row["foto"]; //0-5
        this->$precio=$row["precio"];
        this->$descripcion=$row["descripcion"];
    }
    function mostrar_actividad(){
            echo "<div class =\"marco\">";
                echo "<div class =\"marcoImg\">";
                    echo "<img src=\"".$foto."\"  alt=\"Imagen actividad\" width=\"200px\" height=\"200px\" >";
                    echo "<a href=\"./index.php?page=actividades\"><div class =\"boton_atras\">ATRAS </div></a>";
                echo "</div> <!-- end marcoImg -->";
                echo "<div class =\"marcoText_Superior\">";
                    echo "<div class =\"marcoText\">";
                        echo "<h4>". $nombre ."</h4>";
                              echo "<p>";
                              echo $descripcion;
                              echo "</p>";

                    echo "</div> <!-- end marcoText -->";
                echo "</div> <!-- end marcoText_Superior -->";
            echo "</div> <!-- end marco -->";
        }
    function mostrar_fila(){
    echo "<tr>";
            echo "<td>" . $fecha . "</td>";//echo date($fecha); otra opcion
            echo "<td>" . $hora . "</td>";
            echo "<td><a href=\"./index.php?page=actividades&actividad=" . $id . "\">" . $nombre ."</a></td>";
            echo "<td>" . $precio . "</td>";
    echo "</tr>";
    }

    }

}

//devuelve todas las actividades en un array dada una query
function leer_actividades($query,$dbhandler){
$dbhandler->connect();
$table=$dbhandler->query($query);
$result=array();
    if ($table->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $hotel=new Actividad;
            $hotel->read_actividad($row);
            $result[]=$hotel;
        }
    } else {
        echo "no results";
$dbhandler->close();
return $result;
}

//muestra todas las actividades con el array dado
function mostrar_tabla($actividades){
    echo "<div class=\"tablaActividades\">";
    echo "<h3>Actividades</h3>";
    echo "<table>";
    echo "<thead>";
    		echo "<tr>";
    			echo "<th>Fecha</th>";
    			echo "<th>Hora Comienzo</th>";
    			echo "<th>Actividad</th>";
    			echo "<th>Plazas</th>";
    		echo "</tr>";
    	echo "</thead>";
    	echo "<tbody>";

        foreach ($actividades as $act) {
            $act->mostrar_fila();
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";
}
?>
