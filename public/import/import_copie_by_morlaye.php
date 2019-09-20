<?php

// Connexion

$hote='localhost';
$port='3306';
$name_bd='u769045394_immun';
$user='junky';
$pass='junky';
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

for($i=2;$i<=$arrayCount;$i++){
  
  $id                 = trim($allDataInSheet[$i]["A"]); 
  $under5_id          = trim($allDataInSheet[$i]["B"]);
  $name               = trim($allDataInSheet[$i]["C"]);
  $dob                = trim($allDataInSheet[$i]["D"]);
  $sex                = trim($allDataInSheet[$i]["E"]);
  $birth              = trim($allDataInSheet[$i]["F"]);
  $province           = trim($allDataInSheet[$i]["G"]);
  $district           = trim($allDataInSheet[$i]["H"]);
  $facility           = trim($allDataInSheet[$i]["I"]);
  $location           = trim($allDataInSheet[$i]["J"]);
  $mother_name        = trim($allDataInSheet[$i]["K"]);
  $mother_phone       = trim($allDataInSheet[$i]["L"]);
  $chw_name           = trim($allDataInSheet[$i]["M"]);
  $chw_phone          = trim($allDataInSheet[$i]["N"]);
  $zone               = trim($allDataInSheet[$i]["O"]);
  $bcg                = trim($allDataInSheet[$i]["P"]);
  $opv0               = trim($allDataInSheet[$i]["Q"]);
  $opv1               = trim($allDataInSheet[$i]["R"]);
  $opv2               = trim($allDataInSheet[$i]["S"]);
  $opv3               = trim($allDataInSheet[$i]["T"]);
  $opv4               = trim($allDataInSheet[$i]["U"]);
  $dtp1               = trim($allDataInSheet[$i]["V"]);
  $dtp2               = trim($allDataInSheet[$i]["W"]);
  $dtp3               = trim($allDataInSheet[$i]["X"]);
  $pcv1               = trim($allDataInSheet[$i]["Y"]);
  $pcv2               = trim($allDataInSheet[$i]["Z"]);
  $pcv3               = trim($allDataInSheet[$i]["AA"]);
  $rota1              = trim($allDataInSheet[$i]["AB"]);
  $rota2              = trim($allDataInSheet[$i]["AC"]);
  $measles1           = trim($allDataInSheet[$i]["AD"]);
  $measles2           = trim($allDataInSheet[$i]["AE"]);
  $uuid               = md5(uniqid($under5_id, true));
  $uuid_chw           = md5(uniqid($under5_id+9, true));
  $uuid_mother        = md5(uniqid($under5_id+7, true)); 

// Send to RapidPro


$url ="https://api.rapidpro.io/api/v2/contacts.json";
$data = array( 
	  "name" => "Morlaye",
          "groups" => ["Import"],
          "urns" => [],
          "fields" => [
	          "province"=>$province,
	          "supervisor"=>$chw_name,
	          "dpt2"=>"",
	          "facility"=>$facility,
	          "dpt3"=>"",
	          "under5_id"=>$under5_id,
	          "sex"=>$sex,
	          "dpt1"=>"",
	          "year"=>"",
	          "id"=>$id,
	          "mother_name"=>$mother_name,
	          "date_joined"=>"",
	          "district"=>$district,
	          "opv4"=>"",
	          "opv3"=>"",
	          "opv2"=>"",
	          "opv1"=>"",
	          "opv0"=>"",
	          "location"=>$location,
	          "rota1"=>"",
	          "rota2"=>"",
	          "measles2"=>"",
	          "measles"=>"",
	          "birth"=>$birth,
	          "pcv2"=>"",
	          "zone"=>$zone,
	          "dob"=>$dob,
	          "bcg"=>"",
	          "mother_phone"=>$mother_phone,
	          "pcv1"=>"",
	          "position"=>"Child",
	          "pcv3"=>"",
	          "supervisor_phone"=>$chw_phone,
          ]
          
);



$str_data = json_encode($data);
function sendPostData($url, $str_data){
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");



curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',  
    'Accept: application/json',                                                                                                                               
    'Authorization: Token d655ab870156fb9b90e73da9f45b834e9dacc46c')
);



  curl_setopt($ch, CURLOPT_VERBOSE, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$str_data);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
  $result = curl_exec($ch);
  curl_close($ch);  // Seems like good practice
  return $result;
}

//echo sendPostData($url, $str_data);

/*
  $resultats_chw=$connexion->query("SELECT chw_phone FROM zambia_chw WHERE chw_phone = '" . $chw_phone . "' ");
    $resultats_chw->setFetchMode(PDO::FETCH_ASSOC);
    $count_chw = 0;
         
    while($resultat = $resultats_chw->fetch() )
    {
       $count_chw = $count_chw + 1;
    }

    $resultats_mother=$connexion->query("SELECT mother_phone FROM zambia_mother WHERE mother_phone = '" . $mother_phone . "' ");
    $resultats_mother->setFetchMode(PDO::FETCH_ASSOC);
    $count_mother = 0;
         
    while($resultat = $resultats_mother->fetch() )
    {
       $count_mother = $count_mother + 1;
    }

    if($count_chw == 0)
    {

      $connexion->exec("INSERT INTO zambia_chw(uuid, chw_name, chw_phone, province, district , health_facility, zone) VALUES('" . $uuid_chw . "', '" . $chw_name . "', '" . $chw_phone . "', '" . $province . "' , '" . $district . "', '" . $facility . "' , '" . $zone . "') ");
    }

    if($count_mother == 0)
    {

        $connexion->exec("INSERT INTO zambia_mother(uuid, mother_name, mother_phone, province, district, health_facility, location, chw_phone, zone) VALUES('" . $uuid_mother . "' , '" . $mother_name . "' , '" . $mother_phone . "', '" . $province . "' , '" . $district . "' , '" . $facility . "' , '" . $location . "' , '" . $chw_phone . "' , '" . $zone . "')");
    }


       $resultats=$connexion->query("SELECT id, health_facility FROM zambia_children WHERE health_facility = '" . $facility . "' and id = '" . $id . "' ");
        $resultats->setFetchMode(PDO::FETCH_ASSOC);
        $count = 0;
         
        while($resultat = $resultats->fetch() )
        {
             $count = $count + 1;
        }



        if($count == 0)
        { 

            $connexion->exec("INSERT INTO zambia_children(uuid, under5_id, dob, sex, province, district, health_facility, location, chw_phone, mother_phone, zone, Birth, id) VALUES('" . $uuid . "', '" . $under5_id . "', '" . $dob . "', '" . $sex . "' , '" . $province . "' , '" . $district . "', '" . $facility . "' , '" . $location . "' , '" . $chw_phone . "' , '" . $mother_phone . "' , '" . $zone . "' , '" . $birth . "' , '" . $id . "')");

            if($bcg == 'Yes')
            {
            	$connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'BCG') ");
            }
            if($opv0 == 'Yes')
            {
            	$connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'OPV') ");
            }
            if($opv1 == 'Yes')
            {
            	$connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'OPV') ");
            }
            if($opv2 == 'Yes')
            {
            	$connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'OPV') ");
            }
            if($opv3 == 'Yes')
            {
            	$connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'OPV') ");
            }
            if($opv4 == 'Yes')
            {
            	$connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'OPV') ");
            }
            if($dtp1 == 'Yes')
            {
            	$connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'DTP') ");
            }
            if($dtp2 == 'Yes')
            {
            	$connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'DTP') ");
            }
            if($dtp3 == 'Yes')
            {
            	$connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'DTP') ");
            }
            if($pcv1 == 'Yes')
            {
            	$connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'PCV') ");
            }
            if($pcv2 == 'Yes')
            {
            	$connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'PCV') ");
            }
            if($pcv3 == 'Yes')
            {
            	$connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'PCV') ");
            }
            if($rota1 == 'Yes')
            {
            	$connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'Rota') ");
            }
            if($rota2 == 'Yes')
            {
            	$connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'Rota') ");
            }
            if($measles1 == 'Yes')
            {
            	$connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'Measles') ");
            }
            if($measles1 == 'Yes')
            {
            	$connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'Measles') ");
            }

        }else
         {
           echo 'id and facility already exist !!!';
         }
    
 
 }
*/
 } 

 
 
?>