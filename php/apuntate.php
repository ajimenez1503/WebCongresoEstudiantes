<!--Copyright ©. All rights reserved. Designed by Antonio Jimenez Martinez y Andres Ortiz Corrales -->
<?php
function mostrarcuotas($dbhandler){
	$n_actividades=$dbhandler->count("Actividad");//calculamos el numero de actividades para pasarlo a la funcion javaScript
	$table=$dbhandler->query("SELECT * FROM Cuota");
	if ($table->num_rows > 0) {
		// output data of each row
		echo "<label><h4>Cuota</h4></label>";
		echo "<select onclick=\"guardarCuota();precio_inscriptcion(".$n_actividades.")\" name=\"tipo\" id=\"tipo\">";
		while($row = $table->fetch_assoc()) {
			echo "<option  id=\"". $row["tipo"]."\" value=\"". $row["tipo"]."\">". $row["tipo"]." por ". $row["importe"]." €</option>";
		}
		echo "</select>";
		$n_actividades=$dbhandler->count("Actividad");
	}
}



function mostraractividades($dbhandler,$cuota){
	$n_actividades=$dbhandler->count("Actividad");//calculamos el numero de actividades para pasarlo a la funcion javaScript
	$table=$dbhandler->query("SELECT * FROM Actividad");
	if ($table->num_rows > 0) {
		// output data of each row
		echo "<div id=\"mostrarActividades\">";
		echo "<br><br><h4>Actividades</h4>";
		while($row = $table->fetch_assoc()) {
			$sql="SELECT * FROM Cuotas_Actividades WHERE Cuotas_Actividades.id_Actividad =". $row["id"]." AND Cuotas_Actividades.id_cuota =".$cuota;
			if($dbhandler->query($sql)->num_rows > 0){

				echo "<input checked=\"checked\" type=\"checkbox\" name=\"". $row["id"]."\" value=\"". $row["nombre"]."\"  id=\"". $row["id"]."\" onclick=\"alwayschecked(". $row["id"].");precio_inscriptcion(".$n_actividades.")\">   ". $row["nombre"]." <i>  por ". $row["precio"]." €</i><br>";
			}
			else{
				echo "<input id=\"". $row["id"]."\" type=\"checkbox\" name=\"". $row["id"]."\"   onclick=\"precio_inscriptcion(".$n_actividades.")\"  value=\"". $row["nombre"]."\">   ". $row["nombre"]." <i>  por ". $row["precio"]." €</i><br>";
			}
		}
		echo "</br>";
		echo "</div>";//mostrarActividades

	}
}

function mostrarcuotasyactividades(){
	$dbhandler = new db_handler("localhost","congreso");
	$dbhandler->connect();
	mostrarcuotas($dbhandler);
	$idCuota=1;
	mostraractividades($dbhandler,$idCuota);

	//para poner el precio inicialemtne
	$n_actividades=$dbhandler->count("Actividad");//calculamos el numero de actividades para pasarlo a la funcion javaScript
	echo "<script>precio_inscriptcion(".$n_actividades.")</script>";
	$dbhandler->close();
}
?>

<div class ="contacta">
	<label id="precio_dinamico" >Precio</label>
<form method="post" action="index.php?page=apuntate" >
	<h3>Datos participante :</h3>
	<label>Nombre</label> <input name="nombre" type="text" placeholder="Introduce nombre."  required="true" autofocus><br>
	<label>Apellidos</label> <input name="apellido" type="text" placeholder="Introduce apellidos."  required="true"><br>
	<br>
	<?php mostrarcuotasyactividades();?>



	<label> Buscar hotel:</label>
	<input onclick="mostrar_formulario_hotel()" type="radio" name="buscar" value="true" >Si</input>
	<input onclick="mostrar_formulario_hotel()" type="radio" name="buscar" value="false" checked>No</input>
	<br><br>
	<div id="deseoHotel">
		<input id="fecha_entrada_formulario" type="date" name="fecha_entrada" min="2015-01-01" max="2016-01-01" value="<?php echo date("Y-m-d");?>"></input>
		<input id="fecha_salida_formulario" type="date" name="fecha_salida" min="2015-01-01" max="2016-01-01" value="<?php echo date("Y-m-d",strtotime("+1 day"));?>"></input>

		<select id="tipohab_formulario" name="tipohab">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select>
		<label id="boton_buscar" onclick="buscar_hotel()">BUSCAR</label>
		<div id="mostrarHoteles">
		</div>
	</div> <!-- end deseohotel -->

	<button id="boton_apuntarse" type="submit" name="submit">Enviar</button>
</form>
</br>
<p id="dinero" class="totalDinero"></p>
</div> <!-- end contacta -->

<p>
Manda un mensaje a <a href="congreso@ugr.es">congreso@ugr.es </a> en caso de duda.
</p>


<?php

function addparticiapante_Actividad($dbhandler){
	//calculamos la id del ultimo participante metido
	$sql="SELECT MAX(id) as id FROM Participante";
	$maxid=$dbhandler->query($sql);
	if ($maxid->num_rows > 0) {
		$row = $maxid->fetch_assoc();
		$maxid=$row["id"];
		//calculamos las id de las actividades pinchadas
		$ql="SELECT id,precio FROM Actividad";
		$coste=0;
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
					else{//incrementamos el coste de la actividad
						$coste+=$row["precio"];
					}
				}
			}
			echo "<script> alert(\"Participante dado de alta\");</script>";
			return $coste;
		}
		else {
			echo "Error: ".$dbhandler->error();
		}
	}
	else {
		echo "Error: ".$dbhandler->error();
	}
}


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

//funcinon que realiza un reserva a partir de la api rest
function realizar_reserva($tipohab,$fecha_entrada,$fecha_salida,$idHotel,$user){

    $service_url = "http://localhost/heisenburg/rest/reserva/".$tipohab."/".$fecha_entrada."/".$fecha_salida."/".$user."/".$idHotel;//funcion de reservar alojameinto

    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //to return the content


    $result = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    $decoded=json_decode($result,true);
    if($httpcode==200){
        echo "reserva realizada correctamente</br>";
    }
    else{
		$_REQUEST["precio_hotel"]=0;
        if($httpcode==204){
            echo "no hay habitaciones disponibles o usuario no existe, debes darte de alta en la web de reservas</br>";
        }
		/*elseif($httpcode==206){
			echo "usuario no existe, debes darte de alta en la web de reservas</br>";
		}*/
        else{
            echo "error Header:" . $httpcode . "</br>";
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_REQUEST['nombre']) && isset($_REQUEST['apellido'])) {
	$dbhandler = new db_handler("localhost","congreso");
	$dbhandler->connect();

	$sql="INSERT INTO Participante(nombre,nombreUsuario,apellido,tipo) VALUES ('$_REQUEST[nombre]','antonio','$_REQUEST[apellido]','$_REQUEST[tipo]')";
	if ($dbhandler->query($sql) === TRUE) {

		$dinero=0;
		if ($_REQUEST["buscar"]=="true" && isset($_REQUEST["hotel"]) ) {
			//realizamos reserva
			realizar_reserva($_REQUEST["tipohab"],$_REQUEST["fecha_entrada"],$_REQUEST["fecha_salida"],$_REQUEST["hotel"],$_SESSION["user"]);
			$dinero+=$_REQUEST["precio_hotel"];
		}


		$dinero+=costePorElTipo($dbhandler,$_REQUEST[tipo]);
		$dinero+=addparticiapante_Actividad($dbhandler);

		echo "<script> document.getElementById(\"dinero\").innerHTML = \"Total: ".$dinero."€ \";</script>";
		//echo "<p id=\"dinero\" class=\"totalDinero\">Total: ".$dinero."€ </p>";realizar_reserva($_REQUEST["tipohab"],$_REQUEST["fecha_entrada"],$_REQUEST["fecha_salida"],$_REQUEST["hotel"],$_SESSION["user"]);


	}
	else {
		echo "Error: ".$dbhandler->error();
	}

	$dbhandler->close();
}

?>
