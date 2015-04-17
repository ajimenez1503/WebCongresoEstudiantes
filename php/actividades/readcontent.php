<?php
#echo "<script type='text/javascript'>alert('Message has been sent');</script>";
$filename="./content_example.txt";
if(!file_exists($filename)) echo "file not extist";
else{
    echo "FILE EXISTS";
    echo readfile($filename);
    echo "<br>";
    $myfile = fopen($filename, "r") or die("Unable to open file!");
    //echo "<script type='text/javascript'>alert('Message has been sent');</script>";
    echo fgets($myfile). "<br>";
}
/*echo "<img src=\"" . fgets($myfile) . "\">";
echo "<p>";
while(!feof($myfile)) {
  echo fgets($myfile); . "<br>";
}
echo "</p>"
fclose($myfile);*/


?>
