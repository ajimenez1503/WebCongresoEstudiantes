<?php

if(isset($_POST["nombre"]) && $_POST["nombre"]!=""){
    $q=$_POST["nombre"];
    require "dbhandler.php";
    $dbhandler = new db_handler("localhost","congreso");
    $dbhandler->connect();
    $sql="select * from Usuario where nombre='".$q."'";
    $table=$dbhandler->query($sql);
    if ($table->num_rows > 0) {
        echo "nombre usuario invalido";

    } else {
        echo "nombre usuario valido";
    }
    $dbhandler->close();
}

?>
