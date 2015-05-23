<!--Copyright ©. All rights reserved. Designed by Antonio Jimenez Martinez y Andres Ortiz Corrales -->
<!DOCTYPE html>
<div class ="contacta">
    <h1> buscar hotel</h1>
    <form>
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
		</div> <!-- end deseohotel -->
    </form>
</div> <!-- end contacta -->

<div id="mostrarHoteles">

</div>

<?php
/*

    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST["buscar"]=="true" ) {
		$service_url = "http://localhost/heisenburg/rest/hotel/".$_REQUEST["tipohab"]."/".$_REQUEST["fecha_entrada"]."/".$_REQUEST["fecha_salida"];//funcion de buscar alojameintos

		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //to return the content


		$result = curl_exec($curl);
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		$decoded=json_decode($result,true);
		//echo "Header:" . $httpcode . "</br>";
		if($httpcode==200){

		    foreach ($decoded as  $valor) {
		        $h = new Hotel;
		        $h->read_hotel($valor);
		        $h->mostrar();
		    }
		}
		else{
		    echo "error Header:" . $httpcode . "</br>";
		}
	}
	*/
?>
