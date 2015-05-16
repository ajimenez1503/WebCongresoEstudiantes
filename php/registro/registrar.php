<div class ="contacta">
    <h1> Registro Usuario</h1>
    <form method="post" action="index.php?page=registro" >
       <label> Nombre usuario:</label>
       <input type="text" name="nombre"  placeholder="Introduce nombre Usuario."  required="true" autofocus></input>
       <br><br>

      <label> Contraseña:    </label>
      <input type="password" name="password"  placeholder="Introduce contraseña." required="true"></input>
      <br><br>

      <label> Email:    </label>
      <input type="email" name="email" placeholder="Introduce email." required="true"> </input>
      <br><br>
      <button type="submit" name="submit">Enviar</button>
    </form>
</div> <!-- end contacta -->


<div class="menu_ponencias">
    <ul >
    <li><a href="./index.php?page=registro&contraseña=cambiar">Cambiar contraseña</a></li>
    <li><a href="./index.php?page=registro&contraseña=recordar">Olvide contraseña</a></li>
    </ul>
</div>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_REQUEST['nombre']) && isset($_REQUEST['password']) && isset($_REQUEST['email'])) {
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
