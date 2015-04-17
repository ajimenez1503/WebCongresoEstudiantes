<?php
$myfile = fopen("content_example.txt", "r") or die("Unable to open file!");
echo "<img src=\"" . fgets($myfile) . "\">";
echo "<p>";
while(!feof($myfile)) {
  echo fgets($myfile); #. "<br>";
}
echo "</p>"
fclose($myfile);
?>
