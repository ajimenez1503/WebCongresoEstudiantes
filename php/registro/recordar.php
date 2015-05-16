<div class ="contacta">
    <h1> Recordar contraseña</h1>
    <form method="post" action="index.php?page=registro&contraseña=recordar" >
       <label> Nombre usuario:</label>
       <input type="text" name="nombre"  placeholder="Introduce nombre Usuario."  required="true" autofocus></input>
       <br><br>

      <label> Email:    </label>
      <input type="email" name="email" placeholder="Introduce email." required="true"> </input>
      <br><br>
      <button type="submit" name="submit">Enviar</button>
    </form>
</div> <!-- end contacta -->


<div class="menu_ponencias">
    <ul >
        <li><a href="./index.php?page=registro">Registrar</a></li>
        <li><a href="./index.php?page=registro&contraseña=cambiar">Cambiar contraseña</a></li>
    </ul>
</div>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_REQUEST['nombre']) && isset($_REQUEST['email'])) {
        $dbhandler = new db_handler("localhost","root","congreso");
        $dbhandler->connect();
        $sql="SELECT password FROM Usuario where nombre='".$_REQUEST[nombre]."' AND email='".$_REQUEST[email]."'";
        $table=$dbhandler->query($sql);
        if($table->num_rows > 0){
            $row = $table->fetch_assoc();
            $contraseña=$row["password"];

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
            $mail->addAddress($_REQUEST['email'], $_REQUEST['nombre']);     // Add a recipient
            $mail->Subject = '[Mensaje de Web] Recordar contraseña';
            // use wordwrap() if lines are longer than 70 characters
            //$comment = wordwrap($comment,70)
            $mail->Body    = "Contraseña: ".$contraseña;


            if(!$mail->send()) {
            	//echo "<script type='text/javascript'>alert('Message could not be sent');</script>";
                echo 'Contraseña no se ha podido enviar';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
            	//echo "<script type='text/javascript'>alert('Message has been sent');</script>";
                echo 'Contraseña enviada a su correo';
            }

        } else {
            echo "Error: ".$dbhandler->error();
        }
        $dbhandler->close();
    }
?>
