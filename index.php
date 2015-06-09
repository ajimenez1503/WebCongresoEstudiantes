<!--Copyright ©. All rights reserved. Designed by Antonio Jimenez Martinez y Andres Ortiz Corrales -->
<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>I Congreso de Estudiantes de Ingeniería Informática</title>
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">

	<?php
	//comprobamos la navegacion que estamos usando
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	if (preg_match("/mobile/i", $useragent) || preg_match("/tablet/i", $useragent)){
		echo "<link href=\"css/styles_mobile.css\" rel=\"stylesheet\" type=\"text/css\"/>";
		echo "<script>console.log(\"estamos en mobile\")</script>";
		echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">";
	}
	else{
		echo "<link href=\"css/styles.css\" rel=\"stylesheet\" type=\"text/css\"/>";
		echo "<script>console.log(\"no estamos en mobile\")</script>";
	}
	?>


	<!--<link href="css/styles.css" rel="stylesheet" type="text/css"/> -->
	<script type="text/javascript" src="./js/script.js"></script>

	<?php
	require "php/includes/dbhandler.php";
	//si hemos pulsado sobre salir
	if(isset($_GET['salir'])){
		session_destroy();
		header("location:index.php");
	}

	if(!isset($_GET['page']) || empty($_GET['page'])){
		$current_page="home";
	}
	else{
		$current_page=$_GET['page'];
	}
	?>

</head>
<body>
<div class="containerSuperior">
	<div class="container">
	<?php include './php/header.php'; ?>
	<section>
		<div>
			<?php include './php/lmenu.php';


			?>
			<div class="mainContent" >
				<!-- Incluir contenido necesario -->
				<?php
				//en el caso de que sea auntate y no nos hayamos logeados entramos en registrar
				if($current_page=="apuntate" && !isset($_SESSION['user'])){
					$current_page="registro";
				}
				require './php/'. $current_page . '.php';
				?>
			</div>
		</div>
	</section>
	<?php include './php/footer.php'; ?>
	</div>
</div>
</body>
</html>
