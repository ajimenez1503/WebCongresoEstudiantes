<?php
//Clase Avtividades

class Actividad{
    private $id;
    private $nombre;
    private $fecha;
    private $hora;
    private $foto;
    private $precio;
    private $descripcion;

    //se le pasa una "row" del query
    public function read_actividad($row){
        $this->id=$row["id"];
        $this->nombre=$row["nombre"];
        $this->fecha=$row["fecha"];
        $this->hora=$row["hora"];
        $this->foto=$row["foto"];
        $this->precio=$row["precio"];
        $this->descripcion=$row["descripcion"];
    }

    public function mostrar_actividad(){
            echo "<div class =\"marco\">";
                echo "<div class =\"marcoImg\">";
                    echo "<img src=\"".$this->foto."\"  alt=\"Imagen actividad\" width=\"200px\" height=\"200px\" >";
                    echo "<a href=\"./index.php?page=actividades\"><div class =\"boton_atras\">ATRAS </div></a>";

                    echo "<a href=\"./index.php?page=actividades&actividad=".$this->id."&editar=true\"><div class =\"boton_atras\">EDITAR </div></a>";

                echo "</div> <!-- end marcoImg -->";
                echo "<div class =\"marcoText_Superior\">";
                    echo "<div class =\"marcoText\">";
                        echo "<h4>". $this->nombre ."</h4>";
                              echo "<p>";
                              echo $this->descripcion;
                              echo "</p>";
                    echo "</div> <!-- end marcoText -->";
                echo "</div> <!-- end marcoText_Superior -->";
            echo "</div> <!-- end marco -->";
        }

    public function mostrar_fila(){
    echo "<tr>";
            echo "<td>" . $this->fecha . "</td>";//echo date($fecha); otra opcion
            echo "<td>" . $this->hora . "</td>";
            echo "<td><a href=\"./index.php?page=actividades&actividad=" . $this->id . "\">" . $this->nombre ."</a></td>";
            echo "<td>" . $this->precio ."€</td>";
    echo "</tr>";
    }

}


//devuelve todas las actividades en un array dada una query
function leer_actividades($query,$dbhandler){
    $dbhandler->connect();
    $table=$dbhandler->query($query);
    $result=array();
    if ($table->num_rows > 0) {
        // output data of each row
        while($row = $table->fetch_assoc()) {
            $actividad=new Actividad;
            $actividad->read_actividad($row);
            $result[]=$actividad;
        }
    } else {
        echo "no results";
    }
    $dbhandler->close();
    return $result;
}

//muestra todas las actividades en una tabla con el array dado
function mostrar_tabla($actividades){
    echo "<div class=\"tablaActividades\">";
    echo "<h3>Actividades</h3>";
    echo "<table>";
    echo "<thead>";
    		echo "<tr>";
    			echo "<th>Fecha</th>";
    			echo "<th>Hora Comienzo</th>";
    			echo "<th>Actividad</th>";
    			echo "<th>Importe</th>";
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

function describir_activiad($idactividad,$dbhandler){
    $query="SELECT * FROM `Actividad` WHERE id=".$idactividad;
    $result=leer_actividades($query,$dbhandler);
    foreach ($result as $act) {
        $act->mostrar_actividad();
    }
}
?>
