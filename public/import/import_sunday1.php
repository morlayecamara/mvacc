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
  $data = array();
  $data2 = array();
 
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
  
// CHW existing in DB

    $resultats_chw=$connexion->query("SELECT chw_phone FROM zambia_chw WHERE chw_phone = '" . $chw_phone . "' ");
    $resultats_chw->setFetchMode(PDO::FETCH_ASSOC);
    $count_chw = 0;
         
    while($resultat = $resultats_chw->fetch() )
    {
       $count_chw = $count_chw + 1;
    }

    if($count_chw != 0)
    { 
        $url ="https://api.rapidpro.io/api/v2/contacts.json";
        $data[] = array(     
            "name" => $name,
                  "groups" => ["Import"],
                  "urns" => [], 
                  "fields" => [
                    "province"=>$province,
                    "supervisor"=>$chw_name,
                    "dpt2"=>$dpt2,
                    "facility"=>$facility,
                    "dpt3"=>$dpt3,
                    "under5_id"=>$under5_id,
                    "sex"=>$sex,
                    "dpt1"=>$dpt1,
                    "year"=>"",
                    "id"=>$id,
                    "mother_name"=>$mother_name,
                    "date_joined"=>"",
                    "district"=>$district,
                    "opv4"=>$opv4,
                    "opv3"=>$opv3,
                    "opv2"=>$opv2,
                    "opv1"=>$opv1,
                    "opv0"=>$opv0,
                    "location"=>$location,
                    "rota1"=>$rota1,
                    "rota2"=>$rota2,
                    "measles2"=>$measles2,
                    "measles"=>$measles1,
                    "birth"=>$birth,
                    "pcv2"=>$pcv2,
                    "zone"=>$zone,
                    "dob"=>$dob,
                    "bcg"=>$bcg,
                    "mother_phone"=>$mother_phone,
                    "pcv1"=>$pcv1,
                    "position"=>"Child",
                    "pcv3"=>$pcv3,
                    "supervisor_phone"=>$chw_phone,
                  ]
                  
        );
        
       if($mother_phone != "")
       {
              $data2[] = array(     
                  "name" =>$mother_name,
                  "groups" => ["Import"],
                  "urns"=> ["tel:". $mother_phone .""],
                  "mother_phone"=>$mother_phone,
                  "fields" => [
                    "province"=>$province,
                    "supervisor"=>$chw_name, 
                    "facility"=>$facility,  
                    "year"=>"",
                    "id"=>$id, 
                    "date_joined"=>"",
                    "district"=>$district, 
                    "location"=>$location, 
                    "zone"=>$zone,  
                    "position"=>"Caretaker", 
                    "supervisor_phone"=>$chw_phone,
                  ]
                  
        ); 
       }
       else
       {
             $data2[] = array(     
                  "name" =>$mother_name,
                  "groups" => ["Import"],
                  "urns"=> [],
                  "mother_phone"=>$mother_phone,
                  "fields" => [
                    "province"=>$province,
                    "supervisor"=>$chw_name, 
                    "facility"=>$facility,  
                    "year"=>"",
                    "id"=>$id, 
                    "date_joined"=>"",
                    "district"=>$district, 
                    "location"=>$location, 
                    "zone"=>$zone,  
                    "position"=>"Caretaker", 
                    "supervisor_phone"=>$chw_phone,
                  ]
                  
        ); 
       }


    }

 
 }
 
 




function sendChild($uuid, $under5_id, $dob, $sex, $province, $district, $facility, $location, $chw_phone, $mother_phone, $zone, $Birth, $id, $bcg, $opv0, $opv1, $opv2, $opv3, $opv4, $dtp1, $dtp2, $dtp3, $pcv1, $pcv2, $pcv3, $rota1, $rota2, $measles1, $measles2)
{
  $hote='localhost';
$port='3306';
$name_bd='u769045394_immun';
$user='junky';
$pass='junky';
$connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass); 
    $resultats=$connexion->query("SELECT id, health_facility FROM zambia_children WHERE health_facility = '" . $facility . "' and id = '" . $id . "' ");
        $resultats->setFetchMode(PDO::FETCH_ASSOC);
        $count = 0;
         
        while($resultat = $resultats->fetch() )
        {
             $count = $count + 1;
        }

  

    if($count == 0)
    {

        $connexion->exec("INSERT INTO zambia_children(uuid, under5_id, dob, sex, province, district, health_facility, location, chw_phone, mother_phone, zone, Birth, id) VALUES('" . $uuid . "', '" . $under5_id . "', '" . $dob . "', '" . $sex . "' , '" . $province . "' , '" . $district . "', '" . $facility . "' , '" . $location . "' , '" . $chw_phone . "' , '" . $mother_phone . "' , '" . $zone . "' , '" . $Birth . "' , '" . $id . "')");

           if($bcg != "")
            {
              $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'BCG') ");
            }
            if($opv0 != "")
            {
              $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'OPV') ");
            }
            if($opv1 != "")
            {
              $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'OPV') ");
            }
            if($opv2 != "")
            {
              $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'OPV') ");
            }
            if($opv3 != "")
            {
              $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'OPV') ");
            }
            if($opv4 != "")
            {
              $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'OPV') ");
            }
            if($dtp1 != "")
            {
              $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'DTP') ");
            }
            if($dtp2 != "")
            {
              $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'DTP') ");
            }
            if($dtp3 != "")
            {
              $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'DTP') ");
            }
            if($pcv1 != "")
            {
              $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'PCV') ");
            }
            if($pcv2 != "")
            {
              $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'PCV') ");
            }
            if($pcv3 != "")
            {
              $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'PCV') ");
            }
            if($rota1 != "")
            {
              $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'Rota') ");
            }
            if($rota2 != "")
            {
              $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'Rota') ");
            }
            if($measles1 != "")
            {
              $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'Measles') ");
            }
            if($measles2 != "")
            {
              $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'Measles') ");
            }
    }
     
}
 
function sendPostDataChild($url, $str_data){ 
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
  

   
  // setup curl options
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_HEADER => false,
        CURLOPT_FOLLOWLOCATION => true
    );

    
    curl_setopt_array($ch, $options);
    $result = curl_exec($ch);
    
    // decode the response into an array
    $decoded = json_decode($result, true); 
   // Seems like good practice
  //var_dump($decoded['uuid']);die();
  //echo ' ' . $decoded['uuid'] . '<br>';  
    
    sendChild($decoded['uuid'], 
             $decoded['fields']['under5_id'], 
             $decoded['fields']['dob'],
             $decoded['fields']['sex'],  
             $decoded['fields']['province'], 
             $decoded['fields']['district'], 
             $decoded['fields']['facility'], 
             $decoded['fields']['location'],
             $decoded['fields']['supervisor_phone'],
             $decoded['fields']['mother_phone'], 
             $decoded['fields']['zone'],
             $decoded['fields']['birth'],
             $decoded['fields']['id'],
             $decoded['fields']['bcg'],
             $decoded['fields']['opv0'],
             $decoded['fields']['opv1'],
             $decoded['fields']['opv2'],
             $decoded['fields']['opv3'],
             $decoded['fields']['opv4'],
             $decoded['fields']['dpt1'],
             $decoded['fields']['dpt2'],
             $decoded['fields']['dpt3'],
             $decoded['fields']['pcv1'],
             $decoded['fields']['pcv2'],
             $decoded['fields']['pcv3'],
             $decoded['fields']['rota1'],
             $decoded['fields']['rota2'],
             $decoded['fields']['measles'],
             $decoded['fields']['measles2']
           );
 
                              
  
  return $result;

  
}


function sendPostDataMother($url, $str_data){ 
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
  

   
  // setup curl options
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_HEADER => false,
        CURLOPT_FOLLOWLOCATION => true
    );

    
    curl_setopt_array($ch, $options);
    $result2 = curl_exec($ch);
     
    // decode the response into an array
    $decoded2 = json_decode($result2, true); 
   // Seems like good practice
    
  //echo ' ' . $decoded['uuid'] . '<br>'; 
    
             $uuid_mother=$decoded2['uuid'];
             $mother_name=$decoded2['name'];
             $mother_phone=$decoded2['urns']['tel']; 
             $province=$decoded2['fields']['province'];
             $district=$decoded2['fields']['district'];
             $facility=$decoded2['fields']['facility'];
             $location=$decoded2['fields']['location'];
             $chw_phone=$decoded2['fields']['supervisor_phone'];
             $zone=$decoded2['fields']['zone'];
          
        $hote='localhost';
        $port='3306';
        $name_bd='u769045394_immun';
        $user='junky';
        $pass='junky';
        $connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass); 
        $resultats_mother=$connexion->query("SELECT mother_phone FROM zambia_mother WHERE mother_phone = '" . $mother_phone . "' ");
        $resultats_mother->setFetchMode(PDO::FETCH_ASSOC);
        $count_mother = 0;
             
        while($resultat = $resultats_mother->fetch() )
        {
           $count_mother = $count_mother + 1;
        }

       

         

           $connexion->exec("INSERT INTO zambia_mother(uuid, mother_name, mother_phone, province, district, health_facility, location, chw_phone, zone) VALUES('" . $uuid_mother . "' , '" . $mother_name . "' , '" . $mother_phone . "', '" . $province . "' , '" . $district . "' , '" . $facility . "' , '" . $location . "' , '" . $chw_phone . "' , '" . $zone . "')");
       
      
       
      return $result2;

  
}



function sendPostDataMother2($url, $str_data){ 
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
  

   
  // setup curl options
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_HEADER => false,
        CURLOPT_FOLLOWLOCATION => true
    );

    
    curl_setopt_array($ch, $options);
    $result2 = curl_exec($ch);
     
    // decode the response into an array
    $decoded2 = json_decode($result2, true); 
   // Seems like good practice
    
  //echo ' ' . $decoded['uuid'] . '<br>'; 
    
             $uuid_mother=$decoded2['uuid'];
             $mother_name=$decoded2['name'];
             $mother_phone=""; 
             $province=$decoded2['fields']['province'];
             $district=$decoded2['fields']['district'];
             $facility=$decoded2['fields']['facility'];
             $location=$decoded2['fields']['location'];
             $chw_phone=$decoded2['fields']['supervisor_phone'];
             $zone=$decoded2['fields']['zone'];
          
        $hote='localhost';
        $port='3306';
        $name_bd='u769045394_immun';
        $user='junky';
        $pass='junky';
        $connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass); 
        $resultats_mother=$connexion->query("SELECT mother_phone FROM zambia_mother WHERE mother_phone = '" . $mother_phone . "' ");
        $resultats_mother->setFetchMode(PDO::FETCH_ASSOC);
        $count_mother = 0;
             
        while($resultat = $resultats_mother->fetch() )
        {
           $count_mother = $count_mother + 1;
        }

       

        

           $connexion->exec("INSERT INTO zambia_mother(uuid, mother_name, mother_phone, province, district, health_facility, location, chw_phone, zone) VALUES('" . $uuid_mother . "' , '" . $mother_name . "' , '" . $mother_phone . "', '" . $province . "' , '" . $district . "' , '" . $facility . "' , '" . $location . "' , '" . $chw_phone . "' , '" . $zone . "')");
       
      
       
      return $result2;

  
}

  if(!empty($data) and !empty($data2)){
       $nbrArray = count($data);
       for($i=0;$i<$nbrArray;$i++){   
          $str_data = json_encode($data[$i]);
          $str_data2 = json_encode($data2[$i]);
          sendPostDataChild($url, $str_data);
          
           if($mother_phone != "")
          {
              sendPostDataMother($url, $str_data2);
          }
          else
          {
              sendPostDataMother2($url, $str_data2);
          }
       }
  }else{
     
  }
 
  
 

 } 

 
 
?>