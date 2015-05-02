<?php

include "php/includes/dbhandler.php";
function mostrarparticipantes(){
    $dbhandler = new db_handler("localhost","root","congreso");
    $dbhandler->connect();
    $table=$dbhandler->query("SELECT * FROM Participante");
    if ($table->num_rows > 0) {
        // output data of each row
        while($row = $table->fetch_assoc()) {
            echo "nombre: " . $row["nombre"]. " - Apellido: " . $row["apellido"]. "<br>";
        }
    } else {
        echo "no existen participantes";
    }
    $dbhandler->close();
}


echo "<div>";

echo "<h2> Participantes del concurso</h4>";
echo "<p>";
mostrarparticipantes();
echo "</p>";
echo "</div>";
?>
