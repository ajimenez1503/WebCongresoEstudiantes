<!--Copyright ©. All rights reserved. Designed by Antonio Jimenez Martinez y Andres Ortiz Corrales -->
<!DOCTYPE html>
<script>
<!-- para que se mantenga abierto el menu desplegable-->
	switch_section(1);
</script>

<?php
	$actividad=$_GET['actividad'];
	if(!isset($actividad) || empty($actividad)){
		$actividad="nada";//si no hemos elegido actividad la dejamos vacia
	}
	include "actividades/readcontent.php";

	if($actividad=="content_example"){
		loadActivity("Ejemplo","php/actividades/content_example.txt");
	}
?>


<div>
<h3>Actividades</h3>
<table>
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Hora</th>
			<th>Actividad</th>
			<th>Plazas</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>dd/mm</td>
			<td>hh:mm</td>
			<td><a href="./index.php?page=actividades&actividad=content_example"> Campeonato de LoL</a></td>
			<td>50</td>
		</tr>
		<tr>
			<td>dd/mm</td>
			<td>hh:mm</td>
			<td>Picnic en sala de ordenadores</td>
			<td>50</td>
		</tr>
		<tr>
			<td>dd/mm</td>
			<td>hh:mm</td>
			<td>Campeonato futbolin</td>
			<td>50</td>
		</tr>
		<tr>
			<td>dd/mm</td>
			<td>hh:mm</td>
			<td>Partido de futbol</td>
			<td>25</td>
		</tr>
		<tr>
			<td>dd/mm</td>
			<td>hh:mm</td>
			<td>Taller: Introducción a WordPad</td>
			<td>50</td>
		</tr>


	</tbody>
</table>
</div><!-- end tabla-->
