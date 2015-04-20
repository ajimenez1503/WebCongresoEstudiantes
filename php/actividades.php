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
	include "actividades/tabla.php";

?>
