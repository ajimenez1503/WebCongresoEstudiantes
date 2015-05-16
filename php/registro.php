
<?php
	if(!isset($_GET['contraseña'])){
		include 'php/registro/registrar.php';
	}
	else{
        $contraseña=$_GET['contraseña'];
        include 'php/registro/'. $contraseña . '.php';
	}
?>
