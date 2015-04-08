<!--Copyright ©. All rights reserved. Designed by Antonio Jimenez Martinez y Andres Ortiz Corrales -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>I Congreso de Estudiantes de Ingeniería Informática</title>
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<link href="css/styles.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="./js/formulario.js"></script>

</head>
<body onload="rotar()">
<div class="containerSuperior">
	<div class="container">
	<?php include './php/header.php'; ?>
	<section>
		<div>
			<?php include './php/lmenu.php'; ?>
			<div class="mainContent" >
				<!-- Incluir contenido necesario -->
				<?php include './php/home.php'; ?>
			</div>
		</div>
	</section>
	<?php include './php/footer.php'; ?>
	</div>
</div>
</body>
</html>
