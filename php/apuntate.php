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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	echo "nombre ".$_REQUEST[nombre];
	echo "apellido ".$_REQUEST[apellido];
	echo "tipo ".$_REQUEST[tipo];

	/*$conexion=mysql_connect("localhost","root","granada")
	or die("Problemas en la conexion");

	mysql_select_db("congreso",$conexion) or
	die("Problemas en la seleccion de la base de datos");

	mysql_query("INSERT INTO Usuario(nombre,password, email, rol) VALUES ". "('$_REQUEST[nombre]','$_REQUEST[password]','$_REQUEST[email]','normal')",$conexion) or die("Problemas en el insert".mysql_error());

	mysql_close($conexion);
	echo "<script> alert(\"Usuario dado de alta\");</script>";*/
}

?>
