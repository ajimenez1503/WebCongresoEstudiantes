<?php
echo "<header>";
    echo "<div class=\"headderizq\">";
        echo "<div class=\"headder\">";
            echo "<h1>I Congreso de Estudiantes de Ingeniería Informática</h1>";
        echo "</div>";
        echo "<div class=\"headleft\">";
            echo "<a href=\"./index.php?page=home\"><img src=\"images/logo/logo_web.png\"  alt=\"logo_web\" title=\"logo_web\" width=\"100px\" height=\"100px\"></a>";
        echo "</div>";
    echo "</div>";
    echo "<div>";


            if(!isset($_SESSION['user'])){
                echo "<div class = \"sesion\">";
                    echo "<a href=\"index.php?page=registro\"><li id=\"boton_registro\">¡REGISTRATE!</li></a>";
                    echo "<form class = \"barra_sesion\" method=\"post\" action=\"index.php\">";
                        echo "<input type =\"text\" id=\"texto\" name=\"user\" size =\"13\" placeholder=\"Usuario\" required>";
                        echo "<input type=\"password\" id=\"texto\" name=\"pass\" size =\"13\" placeholder=\"Contraseña\" required>";
                        echo "<input type=\"submit\" id=\"submit\" value=\"Acceder\">";
                    echo "</form>";
                echo "</div> <!-- end sesion -->";
           }
            else{
                echo "<div class = \"sesion2\">";
                    echo "<a href=\"index.php?salir\"><li id=\"boton_salir\" >    SALIR    </li></a>";
                echo "</div> <!-- end sesion2 -->";
            }
        echo "<img class=\"imagnePortada\" src=\"images/img2.jpg\" alt=\"imagen_etsiit\" title=\"imagen_etsiit\" width=\"960px\" height=\"200px\">";
    echo "</div>";
echo "</header>";




if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['user']) && isset($_REQUEST['pass'])) {
			$user=$_REQUEST['user'];
			$pass=$_REQUEST['pass'];
			$dbhandler = new db_handler("localhost","congreso");
			$sql="select rol from `Usuario` where	`nombre`='".$user."' and password='".$pass."'";
			$dbhandler->connect();
			$consulta=$dbhandler->query($sql);
            //si existe
			if($consulta->num_rows > 0 )
			{
                //echo " <script> alert('Usuario logeado') </script> ";
                /*
                //$dir="location:".$_SERVER['REQUEST_URI'];    //direccion q hay que recargar
                //echo $dir;
                //header($dir);
                otra solucion guardar en una cookie toda los parametros get
                */
                $row = $consulta->fetch_assoc();
                $_SESSION["user"]=$user;
                $_SESSION["rol"]=$row["rol"];
                header("location:index.php");
			}
			else{
				echo " <script> alert('Usuario y contraseña incorrectos!') </script> ";
			}
			$dbhandler->close();
	}
?>
