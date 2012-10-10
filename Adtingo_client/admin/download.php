<?php
ob_start();
header("Pragma: public");
header("Expires: 0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment; filename=sample.csv;");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize('uploads/sample.csv'));
readfile('uploads/sample.csv'); 
?>