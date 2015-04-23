<!--Copyright ©. All rights reserved. Designed by Antonio Jimenez Martinez y Andres Ortiz Corrales -->
<!DOCTYPE html>
<script>
<!-- para que se mantenga abierto el menu desplegable-->
	switch_section(1);
</script>

<?php
	include "actividades/readcontent.php";
	if(isset($_GET['actividad']) && !empty($_GET['actividad'])){
		$actividad=$_GET['actividad'];
		loadActivity($actividad);
	}
	include "actividades/tablaActividades.php";
?>
