<?php
//partimos desde index.php
//carga y muestra una actividad desde un fichero dado el nombre
//de actividad y el nombre de fichero, si no se le da nombre de fichero
//se usara php/actividades/$activityName.txt
function loadActivity($activityname,$filename=null){
    if(filename==null) filename="php/actividades/" . $activityname . ".txt";
    echo "<h4>". $activityname . "</h4>"
    if(!file_exists($filename)) echo "file not extist";
    else{
        $file = fopen($filename, "r") or die("Unable to open file!");
        echo "<img src=\"" . fgets($file) "\">";
        while(! feof($file)){
          echo fgets($file). "<br />";
        }
        fclose($file);
    }
}
?>
