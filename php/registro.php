
<div class ="contacta">
    <h1> Registro Usuario</h1>
    <form method="post" action="index.php?page=registro" >
       <label for="nombre"> Nombre usuario:</label>
       <input type="text" name="nombre"  placeholder="Introduce nombre Usuario."  required="true" autofocus></input>
       <br><br>

      <label for="password"> Contraseña:    </label>
      <input type="password" name="password"  placeholder="Introduce contraseña." required="true"></input>
      <br><br>

      <label for="email"> Email:    </label>
      <input type="email" name="email" placeholder="Introduce email." required="true"> </input>
      <br><br>
      <button type="submit" name="submit">Enviar</button>
    </form>
</div> <!-- end contacta -->


<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include "php/includes/dbhandler.php";
        $dbhandler = new db_handler("localhost","root","congreso");
        $dbhandler->connect();
        $sql="INSERT INTO Usuario(nombre,password, email, rol) VALUES ('$_REQUEST[nombre]','$_REQUEST[password]','$_REQUEST[email]','normal')";
        if ($dbhandler->query($sql) === TRUE) {
            echo "<script> alert(\"Usuario dado de alta\");</script>";
        } else {
            echo "Error: ".$dbhandler->error();
        }
        $dbhandler->close();
    }
?>
