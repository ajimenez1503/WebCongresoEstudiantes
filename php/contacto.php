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



<div class ="contacta">

<h2>Formulario contacto</h2>
<form method="post" action="index.php?page=contacto">
   Name: <input type="text" name="name" value="<?php echo $name;?>"required>
   <br><br>
   E-mail: <input type="text" name="email" value="<?php echo $email;?>"required>
   <br><br>
   <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
   <br><br>
   <input type="submit" name="submit" value="Enviar">
</form>
</div> <!-- end contacta -->




<?php
// define variables and set to empty values
$email = $comment = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["name"])) {
        $name = test_input($_POST["name"]);
    }
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

    require 'lib/PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    //Permitir el acceso al correo desde aplicacion no seguras desde
    //https://www.google.com/settings/security/lesssecureapps
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'sibweb2014@gmail.com';                 // SMTP username
    $mail->Password = 'antonioandres';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->From = 'sibweb2014@gmail.com';
    $mail->FromName = 'Congreso';
    $mail->addAddress('jm.94.antonio@gmail.com', 'Antonio');     // Add a recipient
    $mail->addAddress($email, $name);     // Add a recipient
    $mail->Subject = '[Mensaje de Web] Asunto';
    // use wordwrap() if lines are longer than 70 characters
    //$comment = wordwrap($comment,70)
    $mail->Body    = $comment;


    if(!$mail->send()) {
    	//echo "<script type='text/javascript'>alert('Message could not be sent');</script>";
        echo 'Mensaje no ha podido ser enviado';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
    	//echo "<script type='text/javascript'>alert('Message has been sent');</script>";
        echo 'Mensaje ha sido enviado';
    }
}
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>
