<?php
//Clase Cuota

class Cuota{
    private $id;
    public $tipo;
    private $importe;

    //tipo
    public function get_tipo(){
        return $this->tipo;
    }


    //importe
    public function get_importe(){
        return $this->importe;
    }

    //se le pasa una "row" del query
    public function read_cuota($row){
        $this->id=$row["id"];
        $this->tipo=$row["tipo"];
        $this->importe=$row["importe"];
    }


    //mostrmaos un fila de la tabla
    public function mostrar_fila(){
    echo "<tr>";
            echo "<td>" . $this->tipo . "</td>";
            echo "<td>" . $this->importe . "</td>";
    echo "</tr>";
    }


}


//devuelve todas las cuotas en un array dada una query
function leer_cuotas($dbhandler){
    $query="SELECT * FROM Cuota";
    $table=$dbhandler->query($query);
    $result=array();
    if ($table->num_rows > 0) {
        // output data of each row
        while($row = $table->fetch_assoc()) {
            $cuota=new Cuota;
            $cuota->read_cuota($row);
            $result[]=$cuota;
        }
    } else {
        echo "no results";
    }
    return $result;
}

//muestra todas las cuotas en una tabla con el array dado
function mostrar_tabla($cuotas){
    echo "<div class=\"tablaCuotas\">";
        echo "<table>";
        echo "<thead>";
            	echo "<tr>";
        			echo "<th>tipo</th>";
        			echo "<th>importe</th>";
        		echo "</tr>";
        	echo "</thead>";
        	echo "<tbody>";

            foreach ($cuotas as $cuota) {
                $cuota->mostrar_fila();
            }
        echo "</tbody>";
        echo "</table>";
    echo "</div>";//tablaCuotas
}

function boton_editar_cuota(){
    if(isset($_SESSION['user']) &&  $_SESSION['rol']=="admin"){
        echo "<div class =\"boton_cuotas\">";
            echo "<a href=\"./index.php?page=cuotas&editar=true\">EDITAR</a>";
        echo "</div>";// boton_cuotas\">";
        echo "<div class =\"boton_cuotas\">";
            echo "<a href=\"./index.php?page=cuotas\">ATRAS</a>";
        echo "</div>";// boton_cuotas\">";
    }
}
//formulario para editar cuotas
function editar_cuotas($cuotas){
    if(isset($_SESSION['user']) && $_SESSION['rol']=="admin" && isset($_GET['editar'])){


        echo "<div class =\"marcoCuotas\">";
            echo "<h4>Editar importe de las cuotas</h4>";
            echo "<form method=\"post\" action=\"index.php?page=cuotas&editar=true\" >";
            foreach ($cuotas as $cuota){
                echo "<label> ".$cuota->get_tipo()."</label>";
                echo "<input type=\"number\"  step=\"any\" name=\"".$cuota->get_tipo()."\" value=\"".$cuota->get_importe()."\" ></input>";
                echo "<br><br>";
            }
            echo "<button type=\"submit\"name=\"submit\">Modificar</button>";
            echo "</form>";
        echo "</div> <!-- end marcoCuotas -->";
    }
}

function mostrar_editar_tabla_cuotas($dbhandler){

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user']) && $_SESSION['rol']=="admin" && isset($_GET['editar']) ) {
        //tomamos las cuotas
        $cuotas=leer_cuotas($dbhandler);
        //recorremos todos los tipos
        foreach ($cuotas as $cuota){
            //echo $tipo." impote".$_REQUEST[$tipo]."</br>";
            $sql="UPDATE Cuota SET importe='".$_REQUEST[$cuota->get_tipo()]."' WHERE tipo='".$cuota->get_tipo()."'";
            if ($dbhandler->query($sql) === FALSE) {
                echo "Error: ".$dbhandler->error();
            }

        }
    }
    $cuotas=leer_cuotas($dbhandler);
    //mostramos tablas
    mostrar_tabla($cuotas);

    //formulario para editar cuotas
    editar_cuotas($cuotas,$dbhandler);


}

?>
