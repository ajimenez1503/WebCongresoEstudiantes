<?php
//partimos desde index.php
//carga y muestra una actividad desde un fichero dado el nombre
//de actividad y el nombre de fichero, si no se le da nombre de fichero
//se usara php/actividades/$activityName.txt
function loadActivity($activityname,$filename=null){
    if($filename==null) $filename="php/actividades/" . $activityname . ".txt";
    if(!file_exists($filename)) echo "file not extist";
    else{
        echo "<div class =\"marco\">";
            $file = fopen($filename, "r") or die("Unable to open file!");//abrimos fichero
            echo "<div class =\"marcoImg\">";
                echo "<img src=\"".fgets($file)."\"  alt=\"Imagne actividad\" width=\"200px\" height=\"200px\" >";
            echo "</div> <!-- end marcoImg -->";
            echo "<div class =\"marcoText\">";
                echo "<h4>". $activityname ."</h4>";
                echo "<p>";
                while(! feof($file)){
                      echo fgets($file). "<br />";
                }
        	    echo "</p>";
            echo "</div> <!-- end marcoText -->";
        echo "</div> <!-- end marco -->";

        fclose($file);
    }
}
?>
