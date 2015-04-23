<!--Copyright ©. All rights reserved. Designed by Antonio Jimenez Martinez y Andres Ortiz Corrales -->
<!DOCTYPE html>
<script>
	switch_section(1);
</script>

<?php

	if(isset($_GET['ponencia']) && !empty($_GET['ponencia'])){
		$ponencia=$_GET['ponencia'];
		include 'php/ponencias/'. $ponencia . '.php';
	}
	else{
		include "ponencias/tablaPonencias.php";
	}
?>
