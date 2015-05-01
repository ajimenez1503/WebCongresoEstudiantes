<!--Copyright ©. All rights reserved. Designed by Antonio Jimenez Martinez y Andres Ortiz Corrales -->
<script>
<!-- para que se mantenga abierto el menu desplegable-->
	switch_section(1);
</script>

<?php
	include "php/includes/actividad_class.php";
	include "includes/dbhandler.php";
	$dbhandler = new db_handler("localhost","root","granada","congreso");
	
	if(isset($_GET['actividad']) && !empty($_GET['actividad'])){
		$idactividad=$_GET['actividad'];
		describir_activiad($idactividad,$dbhandler);
	}

	$actividades=leer_actividades("SELECT * FROM Actividad",$dbhandler);
	mostrar_tabla($actividades);


?>
