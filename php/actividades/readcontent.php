<?php
//partimos desde index.php
$filename="php/actividades/content_example.txt";
if(!file_exists($filename)) echo "file not extist";
else{
    //echo "FILE EXISTS";
    $file = fopen($filename, "r") or die("Unable to open file!");
    while(! feof($file)){
      echo fgets($file). "<br />";
    }
    fclose($file);
}
?>
