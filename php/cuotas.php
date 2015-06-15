<?php
    include "php/includes/cuota_class.php";
    $dbhandler = new db_handler("localhost","congreso");
    $dbhandler->connect();
    echo "<h2>Cuotas</h2>";
    boton_editar_cuota();
    mostrar_editar_tabla_cuotas($dbhandler);
    $dbhandler->close();
?>
