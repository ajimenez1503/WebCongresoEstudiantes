<!--Copyright ©. All rights reserved. Designed by Antonio Jimenez Martinez y Andres Ortiz Corrales -->
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


	require 'libreria/PHPMailer/PHPMailerAutoload.php';
	echo "<script type='text/javascript'>alert('hola');</script>";
	$mail = new PHPMailer;
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'pisoxd5a@gmail.com';                 // SMTP username
	$mail->Password = 'emperatriz8';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to
	$mail->From = 'pisoxd5a@gmail.com';
	$mail->FromName = 'Congreso';
	$mail->addAddress('jm.94.antonio@gmail.com', 'Antonio');     // Add a recipient
	//$mail->addAddress('ellen@example.com');               // Name is optional

	$mail->isHTML(false);                                  // Set email format to HTML

	$mail->Subject = '[Mensaje de Web] Asunto';
	$mail->Body    = 'This is the HTML message body';


	if(!$mail->send()) {
		echo "<script type='text/javascript'>alert('Message could not be sent');</script>";
	    //echo 'Message could not be sent.';
	    //echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo "<script type='text/javascript'>alert('Message has been sent');</script>";
	    //echo 'Message has been sent';
	}






	// use wordwrap() if lines are longer than 70 characters
	//$comment = wordwrap($comment,70)
	// Enviarlo
	/*$email = $email . ",congreso@ugr.es";
	mail($email," [Mensaje de Web] Asunto",  $comment);
	$email = $comment = "";
	*/
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
