<?php
    include "php/includes/cuota_class.php";
    $dbhandler = new db_handler("localhost","congreso");
    $dbhandler->connect();
    echo "<h2>Cuotas</h2>";
    $cuotas=leer_cuotas($dbhandler);
    boton_editar_cuota();
    mostrar_tabla($cuotas);
    editar_cuotas($dbhandler);
    $dbhandler->close();
?>
