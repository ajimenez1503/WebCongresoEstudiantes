<!--Copyright ©. All rights reserved. Designed by Antonio Jimenez Martinez y Andres Ortiz Corrales -->
<?php
include "php/includes/dbhandler.php";
function mostrarcuotas($dbhandler){
	$table=$dbhandler->query("SELECT * FROM Cuota");
	if ($table->num_rows > 0) {
		// output data of each row
		echo "<label><h4>Ocupación</h4></label>";
		echo "<select  onclick=\"returnCuota()\" name=\"tipo\" id=\"tipo\">";
		while($row = $table->fetch_assoc()) {
			echo "<option  id=\"". $row["tipo"]."\" value=\"". $row["tipo"]."\">". $row["tipo"]." por ". $row["importe"]." €</option>";
		}
		echo "</select>";
	}
}



function mostraractividades($dbhandler,$cuota){
	$table=$dbhandler->query("SELECT * FROM Actividad");
	if ($table->num_rows > 0) {
		// output data of each row
		echo "<br><br><h4>Actividades ".$cuota."</h4>";
		while($row = $table->fetch_assoc()) {
			$sql="SELECT * FROM Cuotas_Actividades WHERE Cuotas_Actividades.id_Actividad =". $row["id"]." AND Cuotas_Actividades.id_cuota =".$cuota;
			if($dbhandler->query($sql)->num_rows > 0){
				echo "<input checked=\"checked\" type=\"checkbox\" name=\"". $row["id"]."\" value=\"". $row["nombre"]."\"  id=\"". $row["id"]."\" onclick=\"alwayschecked(". $row["id"].")\">   ". $row["nombre"]."<br>";
			}
			else{
				echo "<input type=\"checkbox\" name=\"". $row["id"]."\" value=\"". $row["nombre"]."\">   ". $row["nombre"]."<br>";
			}
		}
		echo "</br>";

	}
}

function mostrarcuotasyactividades(){
	$dbhandler = new db_handler("localhost","root","congreso");
	$dbhandler->connect();
	mostrarcuotas($dbhandler);
	$idCuota=1;
	mostraractividades($dbhandler,$idCuota);
	$dbhandler->close();
}
?>

<div class ="contacta">
<form method="post" action="index.php?page=apuntate" >
	<h3>Datos participante :</h3>
	<label>Nombre</label> <input name="nombre" type="text" placeholder="Introduce nombre."  required="true" autofocus><br>
	<label>Apellidos</label> <input name="apellido" type="text" placeholder="Introduce apellidos."  required="true"><br>
	<br>
	<?php mostrarcuotasyactividades();?>
	<button type="submit" name="submit">Enviar</button>
</form>
</div> <!-- end contacta -->

<p class="totalDinero" id="dinero">
Total: 0€
</p>


<p>
Para apuntarse es necesario rellenar el formulario y enviar una transferencia al proximo numero de cuenta: 123456789.
</p>

<p>
Manda un mensaje a <a href="congreso@ugr.es">congreso@ugr.es </a> en caso de duda.
</p>


<?php

function addparticiapante_Actividad($dbhandler){
	//calculamos la id del ultimo participante metido
	$sql="SELECT MAX(id) as id FROM Participante";
	$maxid=$dbhandler->query($sql);
	if ($maxid->num_rows > 0) {
		while($row = $maxid->fetch_assoc()) {
			$maxid=$row["id"];
			break;
		}
		//calculamos las id de las actividades pinchadas
		$ql="SELECT id FROM Actividad";
		$table=$dbhandler->query($ql);
		if ($table->num_rows > 0) {
			while($row = $table->fetch_assoc()) {
				if(isset($_POST[$row["id"]])){
					//insertamos el par de ides participante y actividad.
					$idaux=$row["id"];
					$sql="INSERT INTO Participante_Actividades(id_participante,id_actividad) VALUES ('$maxid','$idaux')";
					if ($dbhandler->query($sql) == FALSE) {
						echo "Error: ".$dbhandler->error();
					}
				}
			}
			echo "<script> alert(\"Participante dado de alta\");</script>";
		}
		else {
			echo "Error: ".$dbhandler->error();
		}
	}
	else {
		echo "Error: ".$dbhandler->error();
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$dbhandler = new db_handler("localhost","root","congreso");
	$dbhandler->connect();

	$sql="INSERT INTO Participante(nombre,nombreUsuario,apellido,tipo) VALUES ('$_REQUEST[nombre]','antonio','$_REQUEST[apellido]','$_REQUEST[tipo]')";
	if ($dbhandler->query($sql) === TRUE) {
		addparticiapante_Actividad($dbhandler);
	}
	else {
		echo "Error: ".$dbhandler->error();
	}
	$dbhandler->close();
}

?>
