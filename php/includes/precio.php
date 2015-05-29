<?php

function costePorElTipo($dbhandler,$tipo){
	//calculamso el importe del coste
	$ql="SELECT importe FROM Cuota WHERE tipo='".$tipo."'";
	$table=$dbhandler->query($ql);
	if ($table->num_rows > 0) {
		$row = $table->fetch_assoc();
		return $row["importe"];
	}
	else {
		echo "Error: ".$dbhandler->error();
	}
}

//coste de la actividades selecionada
function costePorActividad($dbhandler){
		//calculamos las id de las actividades pinchadas
		$ql="SELECT id,precio FROM Actividad";
		$coste=0;
		$table=$dbhandler->query($ql);
		if ($table->num_rows > 0) {
			while($row = $table->fetch_assoc()) {
				$aux="act".$row["id"];
				if(isset($_POST["$aux"])){//si esta selecionada la activida
						$coste+=$row["precio"];//añadimoscoste
				}
			}
		}
		return $coste;
}


//funcion que calcula el preioc total de la incripcion
//function calcularprecio(){
if(isset($_POST["buscar_precio"]) && isset($_POST["tipoCuota"])){
	require "dbhandler.php";
	$dbhandler = new db_handler("localhost","congreso");
	$dbhandler->connect();
	$dinero=0;

	/*if ($_REQUEST["buscar"]=="true" && isset($_REQUEST["hotel"]) ) {
		$dinero+=$_REQUEST["precio_hotel"];
	}*/

	$dinero+=costePorElTipo($dbhandler,$_POST["tipoCuota"]);
	$dinero+=costePorActividad($dbhandler);

	//echo $_POST["tipoCuota"];
	$dbhandler->close();
	echo $dinero."€";
}

?>
