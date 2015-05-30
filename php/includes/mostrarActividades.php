<?php
if(isset($_POST["idCuota"])){
    require "dbhandler.php";
    $dbhandler = new db_handler("localhost","congreso");
	$dbhandler->connect();
    $n_actividades=$dbhandler->count("Actividad");//calculamos el numero de actividades para pasarlo a la funcion javaScript
    $cuota=$_POST["idCuota"];
    $table=$dbhandler->query("SELECT * FROM Actividad");
    if ($table->num_rows > 0) {

    	// output data of each row
    	echo "<div id=\"mostrarActividades\">";
    	echo "<br><br><h4>Actividades </h4>";
    	while($row = $table->fetch_assoc()) {
    		$sql="SELECT * FROM Cuotas_Actividades WHERE Cuotas_Actividades.id_Actividad =". $row["id"]." AND Cuotas_Actividades.id_cuota =".$cuota;
    		if($dbhandler->query($sql)->num_rows > 0){
                echo "<input checked=\"checked\" type=\"checkbox\" name=\"". $row["id"]."\" value=\"". $row["nombre"]."\"  id=\"". $row["id"]."\" onclick=\"alwayschecked(". $row["id"].");precio_inscriptcion(".$n_actividades.")\">   ". $row["nombre"]." <i>  por ". $row["precio"]." €</i><br>";
			}
			else{
				echo "<input id=\"". $row["id"]."\" type=\"checkbox\" name=\"". $row["id"]."\"  onclick=\"precio_inscriptcion(".$n_actividades.")\"  value=\"". $row["nombre"]."\">   ". $row["nombre"]." <i>  por ". $row["precio"]." €</i><br>";
			}
    	}
    	echo "</br>";
    	echo "</div>";//mostrarActividades

    }
    $dbhandler->close();
}
?>
