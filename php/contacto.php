<!--Copyright ©. All rights reserved. Designed by Antonio Jimenez Martinez y Andres Ortiz Corrales -->
<!DOCTYPE html>
		<!--informacion contacto -->
			<h3>Información de contacto:</h3>
			<p>C/Periodista Daniel Saucedo Aranda, s/n · E-18071 GRANADA (Spain)</p>
			<p>Tlf:+34-958242802</p>
			<p>Fax: +34-958242801</p>
			<p>E-mail:<a href="congreso@ugr.es">congreso@ugr.es </a> </p>

			<h4>Secreataría ETSIIT :</h4>
			<p> Administrador D. Juan Antonio Barros Jódar </p>
			<p>E-mail:<a href="jbarros@ugr.es">jbarros@ugr.es </a> </p>



<?php
// define variables and set to empty values
$email = $comment = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (!empty($_POST["email"])) {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<script type='text/javascript'>alert('correo incorrecto');</script>";
     }
   }
   if (!empty($_POST["comment"])) {
     $comment = test_input($_POST["comment"]);
   }
	// use wordwrap() if lines are longer than 70 characters
	//$comment = wordwrap($comment,70)
	// Enviarlo
	$email = $email . ",congreso@ugr.es";
	mail($email," [Mensaje de Web] Asunto",  $comment);
	$email = $comment = "";
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<div class ="contacta">

<h2>Formulario contacto</h2>
<form method="post" action="index.php?page=contacto">
   Name: <input type="text" name="name" value="<?php echo $name;?>"required>
   <br><br>
   E-mail: <input type="text" name="email" value="<?php echo $email;?>"required>
   <br><br>
   <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
   <br><br>
   <input type="submit" name="submit" value="Submit">
</form>
</div> <!-- end contacta -->
