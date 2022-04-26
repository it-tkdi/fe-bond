<?php
$file = "../download/template-upload-email-excel-bond.xlsx";

//Check the file path exists or not
if(file_exists($file)) {

//Define header information
header('Content-Description: File Transfer');
header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment; filename="'.basename($file).'"');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Content-Length: ' . filesize($file));
header('Pragma: public');

ob_clean();
//Clear system output buffer
flush();

//Read the size of the file
readfile($file);

//Terminate from the script
die();
}
?>