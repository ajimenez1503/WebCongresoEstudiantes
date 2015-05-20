<?php
if(isset($_SESSION['user']) && $_SESSION['rol']=="admin"){

    echo "<div class =\"marcoCuotas\">";
        echo "<h4>Editar importe de las cuotas</h4>";

        echo "<form method=\"post\" action=\"index.php?page=cuotas\" >";
    ////////////////////Accedemos a la base de date_offset_get

            $dbhandler = new db_handler("localhost","congreso");
            $dbhandler->connect();

            $sql="SELECT * FROM Cuota";
            $table=$dbhandler->query($sql);
            $tipos=array();
            if ($table->num_rows > 0) {
                // output data of each row
                while($row = $table->fetch_assoc()) {
                    echo "<label> ".$row["tipo"]."    </label>";
                    echo "<input type=\"number\" name=\"".$row["tipo"]."\" value=\"".$row["importe"]."\" ></input>";
                    echo "<br><br>";
                    $tipos[]=$row["tipo"];
                }
            } else {
                echo "no results";
            }
    ////////////////////

        echo "<button type=\"submit\" name=\"submit\">Modificar</button>";
        echo "</form>";
    echo "</div> <!-- end marcoCuotas -->";


    if ($_SERVER["REQUEST_METHOD"] == "POST"  ) {

        foreach ($tipos as $tipo){
            $sql="UPDATE Cuota SET importe='".$_REQUEST[$tipo]."' WHERE tipo='".$tipo."'";
            if ($dbhandler->query($sql) === FALSE) {
                echo "Error: ".$dbhandler->error();
            }
        }
    }

    $dbhandler->close();
}
?>
