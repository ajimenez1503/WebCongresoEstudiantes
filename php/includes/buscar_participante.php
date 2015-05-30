<?php

if(isset($_POST["nombre"])){
    $q=$_POST["nombre"];
    echo $q;
    require "dbhandler.php";
    $dbhandler = new db_handler("localhost","congreso");
    $dbhandler->connect();
    $sql="select * from Participante where nombre LIKE '".$q."%'";
    $table=$dbhandler->query($sql);
    echo "<div class=\"lista_particiapantes\">";
    if ($table->num_rows > 0) {
        echo "<ul>";
        while($row = $table->fetch_assoc()) {
            echo "<li><a href=\"./index.php?page=participantes&id=".$row["id"]."\"> <p>Participante: " . $row["nombre"]. " " . $row["apellido"]. "</p></a></li>";
        }
        echo "</ul>";

    } else {
        echo "no existen participantes";
    }
    echo "</div>";//lista participantes
    $dbhandler->close();
}

?>
