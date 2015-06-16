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

    //id
    public function get_id(){
        return $this->id;
    }

    //nombre
    public function get_nombre(){
        return $this->nombre;
    }

    //foto
    public function get_foto(){
        return $this->foto;
    }

    //precio
    public function get_precio(){
        return $this->precio;
    }
    //descripcion
    public function get_descripcion(){
        return $this->descripcion;
    }


        //mostrmaos un fila de la tabla
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
    return $result;
}

//muestra todas las actividades en una tabla con el array dado
function mostrar_tabla($actividades){
    echo "<div>";
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


funci



//muestra la info especifica de una actividad
function describir_activiad($idactividad,$dbhandler){
    //seleccioamos actividad
    $query="SELECT * FROM `Actividad` WHERE id=".$idactividad;
    $result=leer_actividades($query,$dbhandler);
    if (count($result)>0) {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user']) && isset($_GET['editar'])&& $_SESSION['rol']=="admin" ) {
            //actualizmos actividad
            $sql="UPDATE Actividad SET descripcion='".$_REQUEST['descripcion']."', precio=".$_REQUEST['precio']." WHERE id=".$result[0]->get_id();
            if ($dbhandler->query($sql) === TRUE) {
                echo "<script> alert(\"actividade modificada\");</script>";
                //actualizmos actividad
                $result=leer_actividades($query,$dbhandler);
            } else {
                echo "Error: ".$dbhandler->error();
            }
        }
        echo "<div class =\"marco\">";
            echo "<div class =\"marcoImg\">";
                echo "<img src=\"".$result[0]->get_foto()."\"  alt=\"Imagen actividad\" width=\"200px\" height=\"200px\" >";
                echo "<a href=\"./index.php?page=actividades\"><div class =\"boton_atras\">ATRAS </div></a>";

                if(isset($_SESSION['user']) && $_SESSION['rol']=="admin"){
                        echo "<a href=\"./index.php?page=actividades&actividad=".$result[0]->get_id()."&editar=true\"><div class =\"boton_atras\">EDITAR </div></a>";
                }

            echo "</div> <!-- end marcoImg -->";

            echo "<div class =\"marcoText_Superior\">";
                echo "<div class =\"marcoText\">";
                    echo "<h4>". $result[0]->get_nombre() ."</h4>";
                          echo "<p>";
                          echo $result[0]->get_descripcion();
                          echo "</p>";
                echo "</div> <!-- end marcoText -->";
            echo "</div> <!-- end marcoText_Superior -->";

            if(isset($_SESSION['user']) && isset($_GET['editar'])&& $_SESSION['rol']=="admin"){
                echo "<div class =\"marcoFormulario\">";
                    echo "<h4>Editar actividad</h4>";

                    echo "<form method=\"post\" action=\"index.php?page=actividades&actividad=".$result[0]->get_id()."&editar=true\" >";

                    echo "<label> Descripcion actividad</label>";
                    echo "<textarea  id=\"descripcion_actividad\" name=\"descripcion\"  row=\"100\" cols=\"45\"  >".$result[0]->get_descripcion()."</textarea>";
                    echo "<br><br>";

                    echo "<label> Precio:    </label>";
                    echo "<input type=\"number\" step=\"any\" name=\"precio\" value=\"".$result[0]->get_precio()."\" ></input>";
                    echo "<br><br>";

                    echo "<button type=\"submit\" name=\"submit\">Modificar</button>";
                    echo "</form>";
                echo "</div> <!-- end marcoFormulario -->";
        }
        echo "</div> <!-- end marco -->";
    }
}
?>
