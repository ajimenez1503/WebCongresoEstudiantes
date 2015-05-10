<?php

include "php/includes/dbhandler.php";
function mostrarParticipantes(){
    $dbhandler = new db_handler("localhost","root","congreso");
    $dbhandler->connect();
    $table=$dbhandler->query("SELECT * FROM Participante");
    if ($table->num_rows > 0) {
        // output data of each row
        while($row = $table->fetch_assoc()) {
            echo "<a href=\"./index.php?page=participantes&id=".$row["id"]."\"><p>nombre: " . $row["nombre"]. " - Apellido: " . $row["apellido"]. "</p></a>";
        }
    } else {
        echo "no existen participantes";
    }
    $dbhandler->close();
}

function mostrarDatosParticipante($id){
    $dbhandler = new db_handler("localhost","root","congreso");
    $dbhandler->connect();
    //comprobamos datos del participantes
    $table=$dbhandler->query("SELECT * FROM Participante WHERE id=".$id);
    if ($table->num_rows > 0) {
        echo "<div class =\"contacta\">";
        // output data of each row
        $row = $table->fetch_assoc();

        echo "<p>nombre: " . $row["nombre"]. " - Apellido: " . $row["apellido"]. "</p>";
        echo "<p>Tipo de participante: " . $row["tipo"]. "</p>";
        echo "<p>nombre de usuario: " . $row["nombreUsuario"]. "</p></br>";


        //comprobamos datos de participante y activiad
        $table=$dbhandler->query("select * from Actividad, Participante_Actividades where Participante_Actividades.id_Actividad=Actividad.id and Participante_Actividades.id_Participante=".$id);
        if ($table->num_rows > 0) {
            // output data of each row
            echo "<p>Inscrito en la siguientes actividades:</p>";
            while($row = $table->fetch_assoc()) {
                echo "<p>nombre actividades: " . $row["nombre"]. "</p>";
            }
        } else {
            echo "no tiene actividades";
        }


    } else {
        echo "no existen el participante";
    }

    echo "<div class=\"menu_ponencias\">";
        echo "<ul>";
            echo "<li ><a href=\"./index.php?page=participantes\">Vovler a lista participantes</a></li>";
        echo "</ul>";
    echo "</div>";
    echo "</div> <!-- end contacta -->";
    $dbhandler->close();
}


echo "<div>";
echo "<h2> Participantes del concurso</h4>";
echo "<p>";

if(!isset($_GET['id']) || empty($_GET['id'])){
    mostrarParticipantes();
}
else{
    mostrarDatosParticipante($_GET['id']);
}
echo "</p>";
echo "</div>";
?>
