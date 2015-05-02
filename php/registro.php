
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
        $conexion=mysql_connect("localhost","root","granada")
        or die("Problemas en la conexion");

        mysql_select_db("congreso",$conexion) or
        die("Problemas en la seleccion de la base de datos");

        mysql_query("INSERT INTO Usuario(nombre,password, email, rol) VALUES ". "('$_REQUEST[nombre]','$_REQUEST[password]','$_REQUEST[email]','normal')",$conexion) or die("Problemas en el insert".mysql_error());

        mysql_close($conexion);
        echo "<script> alert(\"Usuario dado de alta\");</script>";
    }
?>
