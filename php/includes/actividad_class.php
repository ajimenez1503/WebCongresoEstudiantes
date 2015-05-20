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

                    if(isset($_SESSION['user']) && $_SESSION['rol']=="admin"){
                            echo "<a href=\"./index.php?page=actividades&actividad=".$this->id."&editar=true\"><div class =\"boton_atras\">EDITAR </div></a>";
                    }

                echo "</div> <!-- end marcoImg -->";

                echo "<div class =\"marcoText_Superior\">";
                    echo "<div class =\"marcoText\">";
                        echo "<h4>". $this->nombre ."</h4>";
                              echo "<p>";
                              echo $this->descripcion;
                              echo "</p>";
                    echo "</div> <!-- end marcoText -->";
                echo "</div> <!-- end marcoText_Superior -->";

                if(isset($_SESSION['user']) && isset($_GET['editar'])&& $_SESSION['rol']=="admin"){
                    echo "<div class =\"marcoFormulario\">";
                        echo "<h4>Editar actividad</h4>";

                        echo "<form method=\"post\" action=\"index.php?page=actividades&actividad=".$this->id."&editar=true\" >";

                        echo "<label> Descripcion actividad</label>";
                        echo "<textarea  name=\"descripcion\"  row=\"100\" cols=\"45\"  >".$this->descripcion."</textarea>";
                        echo "<br><br>";

                        echo "<label> Precio:    </label>";
                        echo "<input type=\"number\" name=\"precio\" value=\"".$this->precio."\" ></input>";
                        echo "<br><br>";

                        echo "<button type=\"submit\" name=\"submit\">Modificar</button>";
                        echo "</form>";
                    echo "</div> <!-- end marcoFormulario -->";


                    if ($_SERVER["REQUEST_METHOD"] == "POST"  ) {

                        $dbhandler = new db_handler("localhost","congreso");
                        $dbhandler->connect();
                        $sql="UPDATE Actividad SET descripcion='".$_REQUEST['descripcion']."', precio=".$_REQUEST['precio']." WHERE id=".$this->id;
                        if ($dbhandler->query($sql) === TRUE) {
                            echo "<script> alert(\"actividade modificada\");</script>";
                        } else {
                            echo "Error: ".$dbhandler->error();
                        }
                        $dbhandler->close();
                        // echo "precio ".$_REQUEST['precio']."</br>";
                        // echo "descrip ".$_REQUEST['descripcion']."</br>";
                    }
            }
            echo "</div> <!-- end marco -->";
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
    //echo "<h3>Actividades</h3>";
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

//muestra la info especifica de una actividad
function describir_activiad($idactividad,$dbhandler){
    $query="SELECT * FROM `Actividad` WHERE id=".$idactividad;
    $result=leer_actividades($query,$dbhandler);
    foreach ($result as $act) {
        $act->mostrar_actividad();
    }
}
?>
