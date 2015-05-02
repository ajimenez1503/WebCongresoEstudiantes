<!--Copyright ©. All rights reserved. Designed by Antonio Jimenez Martinez y Andres Ortiz Corrales -->
<?php
include "php/includes/dbhandler.php";
function mostrarcuotas($dbhandler){
	$table=$dbhandler->query("SELECT * FROM Cuota");
	if ($table->num_rows > 0) {
		// output data of each row
		echo "<label><h4>Ocupación</h4></label>";
		echo "<select name=\"tipo\">";
		while($row = $table->fetch_assoc()) {
			echo "<option  id=\"". $row["tipo"]."\" value=\"". $row["tipo"]."\">". $row["tipo"]." por ". $row["importe"]." €</option>";
		}
		echo "</select>";
	}
}

function mostraractividades($dbhandler){
	$table=$dbhandler->query("SELECT * FROM Actividad");
	if ($table->num_rows > 0) {
		// output data of each row
		echo "<br><br><h4>Actividades</h4>";
		while($row = $table->fetch_assoc()) {
			echo "<input  type=\"checkbox\" name=\"". $row["id"]."\" value=\"". $row["nombre"]. "\">   ". $row["nombre"]."<br>";
		}
		echo "</br>";

	}
}

function mostrarcuotasyactividades(){
	$dbhandler = new db_handler("localhost","root","granada","congreso");
	$dbhandler->connect();
	mostrarcuotas($dbhandler);
	mostraractividades($dbhandler);
	$dbhandler->close();
}
?>



<p>
Para apuntarse es necesario rellenar el formulario y enviar una transferencia la proximo numero de cuenta: 123456789.
</p>
 <p>
El precio de la inscripcion depende del rol:</p>
<li ><p> 10€ para estudiante</p></li>
<li ><p> 15€ para profesor</p></li>
<li ><p> 20€ para invitado</p></li>

<p>
Manda un mensaje a <a href="congreso@ugr.es">congreso@ugr.es </a> en caso de duda.
</p>
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
	$dbhandler = new db_handler("localhost","root","granada","congreso");
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
