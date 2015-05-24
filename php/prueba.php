<!--Copyright ©. All rights reserved. Designed by Antonio Jimenez Martinez y Andres Ortiz Corrales -->
<!DOCTYPE html>
<div class ="contacta">
    <h1> buscar hotel</h1>
    <form method="post" action="index.php?page=prueba">
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
            <button type="submit" name="submit">Enviar</button>
		</div> <!-- end deseohotel -->

    </form>
</div> <!-- end contacta -->



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST["buscar"]=="true" && isset($_REQUEST["hotel"]) ) {
    echo "hotel".$_REQUEST["hotel"];
    echo "fecha_entrada".$_REQUEST["fecha_entrada"];
    echo "fecha_salida".$_REQUEST["fecha_salida"];
    echo "tipohab".$_REQUEST["tipohab"];


    $service_url = "http://localhost/heisenburg/rest/reserva/".$_REQUEST["tipohab"]."/".$_REQUEST["fecha_entrada"]."/".$_REQUEST["fecha_salida"]."/".$_SESSION["user"]."/".$_REQUEST["hotel"];//funcion de reservar alojameinto


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
        if($httpcode==204){
            echo "no hay habitaciones disponibles</br>";
        }
        else{
            echo "error Header:" . $httpcode . "</br>";
        }
    }
}

?>
