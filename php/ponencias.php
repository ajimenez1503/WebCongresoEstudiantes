<!--Copyright ©. All rights reserved. Designed by Antonio Jimenez Martinez y Andres Ortiz Corrales -->
<!DOCTYPE html>
<script>
	switch_section(1);
</script>

<?php
	$ponencia=$_GET['ponencia'];
	if(isset($ponencia) && !empty($ponencia)){
		include 'php/ponencias/'. $ponencia . '.php';
	}
	else{
		include "ponencias/tablaPonencias.php";
	}
?>
