<?php

// Connexion

$hote='localhost';
$port='3306';
$name_bd='mvacc';
$user='moh_zambia';
$pass='5cGBKO9mn8';
$connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass);  
 
// Data Collect

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
  $data = array();
  $data2 = array();
 
for($i=2;$i<=$arrayCount;$i++){
   
  $uuid                          = trim($allDataInSheet[$i]["A"]); 
  $province                      = trim($allDataInSheet[$i]["B"]);
  $district                      = trim($allDataInSheet[$i]["C"]);
  $Faclity                       = trim($allDataInSheet[$i]["D"]);
  $Supervisor                    = trim($allDataInSheet[$i]["E"]);
  $Supervisor_Phone              = trim($allDataInSheet[$i]["F"]);
  $Mother                        = trim($allDataInSheet[$i]["G"]);
  $Mother_Phone                  = trim($allDataInSheet[$i]["H"]);
  $id                            = trim($allDataInSheet[$i]["I"]); 
  
$connexion->exec("UPDATE zambia_children SET province='" . $province . "' WHERE uuid = '" . $uuid . "' ");
 
 }
 
 





     
}
 

 
 
?>