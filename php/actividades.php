<!--Copyright ©. All rights reserved. Designed by Antonio Jimenez Martinez y Andres Ortiz Corrales -->
<!DOCTYPE html>
<script>
<!-- para que se mantenga abierto el menu desplegable-->
	switch_section(1);
</script>

<?php
	include "actividades/readcontent.php";
	$actividad=$_GET['actividad'];
	if(isset($actividad) && !empty($actividad)){
		loadActivity($actividad);
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
			<td><a href="./index.php?page=actividades&actividad=campeonato_lol"> Campeonato de LoL</a></td>
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
