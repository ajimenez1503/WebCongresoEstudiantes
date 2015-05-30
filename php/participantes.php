<?php

function mostrarParticipantes(){
    $dbhandler = new db_handler("localhost","congreso");
    $dbhandler->connect();
    $table=$dbhandler->query("SELECT * FROM Participante");
    echo "<div class=\"lista_particiapantes\">";
    if ($table->num_rows > 0) {

        echo "<ul>";
        while($row = $table->fetch_assoc()) {
            echo "<li><a href=\"./index.php?page=participantes&id=".$row["id"]."\"> <p>Participante: ". $row["nombre"]." ". $row["apellido"]."</p></a></li>";
        }
        echo "</ul>";

    } else {
        echo "no existen participantes";
    }
    echo "</div>";//lista participantes
    $dbhandler->close();
}

//mostramos lo datos especificos del participante, como su grupo de actividades.
function mostrarDatosParticipante($id){
    $dbhandler = new db_handler("localhost","congreso");
    $dbhandler->connect();
    //comprobamos datos del participantes
    $table=$dbhandler->query("SELECT * FROM Participante WHERE id=".$id);
    if ($table->num_rows > 0) {
        echo "<div class =\"contacta\">";
        $row = $table->fetch_assoc();// output data of each row

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

    //volver a la lista de participantes
    echo "<div class=\"menu_ponencias\">";
        echo "<ul>";
            echo "<li ><a href=\"./index.php?page=participantes\">Vovler a lista participantes</a></li>";
        echo "</ul>";
    echo "</div>";
    echo "</div> <!-- end contacta -->";
    $dbhandler->close();
}


echo "<div>";
    echo "Buscar participante <input type=\"text\" id=\"buscador\" name=\"buscador\" onkeyup=\"buscar_participante_ajax()\" required />";

    echo "<h2> Participantes del concurso</h4>";

    echo "<div id=\"buscador_participantes\">";
        if(!isset($_GET['id']) || empty($_GET['id'])){
            mostrarParticipantes();
        }
        else{
            mostrarDatosParticipante($_GET['id']);
        }
    echo "</div>";//buscador_participantes
echo "</div>";
?>
