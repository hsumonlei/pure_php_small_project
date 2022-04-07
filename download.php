<?php
$mypdf = "files/".$_REQUEST["file"];

echo $mypdf;

// Header content type
header("Content-type: application/pdf");
  
header("Content-Length: " . filesize($mypdf));
  
// Send the file to the browser.
readfile($mypdf);

?>
