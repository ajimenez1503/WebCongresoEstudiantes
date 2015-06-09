<div class ="contacta">
    <h1> Registro Usuario</h1>
    <form method="post" action="index.php?page=registro&contraseña=cambiar" >
       <label> Nombre usuario:</label>
       <input type="text" name="nombre"  placeholder="Introduce nombre Usuario."  required="true" autofocus></input>
       <br><br>

      <label> Contraseña actual:  </label>
      <input type="password" name="password1"  placeholder="Introduce contraseña actual." required="true"></input>
      <br><br>


      <label> Contraseña nueva :    </label>
      <input type="password" name="password2"  placeholder="Introduce contraseña nueva." required="true"></input>
      <br><br>

      <button type="submit" name="submit">Enviar</button>
    </form>
</div> <!-- end contacta -->


<div class="menu_ponencias">
    <ul >
        <li><a href="./index.php?page=registro">Registrar</a></li>
        <li><a href="./index.php?page=registro&contraseña=recordar">Olvide contraseña</a></li>
    </ul>
</div>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_REQUEST['nombre']) && isset($_REQUEST['password1']) && isset($_REQUEST['password2'])){
        $dbhandler = new db_handler("localhost","congreso");
        $dbhandler->connect();

        $sql="UPDATE Usuario SET password = '".$_REQUEST['password2']."' WHERE  nombre='".$_REQUEST['nombre']."' AND password='".$_REQUEST['password1']."'";
        if ($dbhandler->query($sql) === TRUE) {
            echo "<script> alert(\"Contraseña cambiada\");</script>";
        } else {
            echo "Error: ".$dbhandler->error();
        }
        $dbhandler->close();
    }
?>
