<?php

$hote='localhost';
$port='3306';
$name_bd='your_table';
$user='root';
$pass='';
$connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass); 
if(isset($_POST["submit_file"]))
{
 set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
 include 'PHPExcel/IOFactory.php';
 $file = $_FILES["file"]["tmp_name"];
 try {
	$objPHPExcel = PHPExcel_IOFactory::load($file);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($file,PATHINFO_BASENAME).'": '.$e->getMessage());
}
$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

for($i=2;$i<=$arrayCount;$i++){
  $name = trim($allDataInSheet[$i]["A"]);
  $email = trim($allDataInSheet[$i]["B"]); 
  $connexion->exec("INSERT INTO your_table(name, email) VALUES('" . $name . "', '" . $email . "')");
 }
}
?>