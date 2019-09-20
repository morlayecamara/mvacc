<?php

$hote='localhost';
$port='3306';
$name_bd='mvacc';
$user='moh_zambia';
$pass='5cGBKO9mn8';

$connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass);   
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    if (isset($_GET['id']) and isset($_GET['health_facility']) and isset($_GET['vac1']) and isset($_GET['vac2']) and isset($_GET['vac3']) and isset($_GET['vac4']) and isset($_GET['vac5'])) 
    { 
           
                          $health_facility    = $_GET['health_facility']; 
                          $id    = $_GET['id'];
                          $vac1    = $_GET['vac1'];
                          $vac2    = $_GET['vac2'];
                          $vac3    = $_GET['vac3'];
                          $vac4    = $_GET['vac4'];
                          $vac5    = $_GET['vac5']; 


        //function put
        
        
                         
                            $url ="https://api.rapidpro.io/api/v2/flow_starts.json"; 
                        
                              function sendPostData($url,$flow,$contacts){
                                $data = array( 
                                      "flow" => $flow,
                                      "contacts" => [$contacts], 
                                  ); 
                                $str_data = json_encode($data);
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
                                curl_close($ch);   
                                return $result;
                              }

                              
         

        $resultats=$connexion->query("SELECT * FROM zambia_children WHERE health_facility = '" . $health_facility . "' and mvacc_id = '" . $id . "' ");
        $resultats->setFetchMode(PDO::FETCH_ASSOC);
        $count = 0;
        $bcg = 0;
        $opv = 0;
        $pcv = 0;
        $dtp = 0;
        $rota = 0;
        $measles = 0;
         
        while($resultat = $resultats->fetch() )
        {
             $count          = $count + 1;
             $uuid           = $resultat['uuid'];
             $mvacc_id       = $resultat['mvacc_id'];
             $under5_id      = $resultat['under5_id'];
             $dob            = $resultat['dob'];
             $age            = $resultat['age']; 
             $sex            = $resultat['sex']; 
             $province       = $resultat['province']; 
             $district       = $resultat['district']; 
             $facility       = $resultat['health_facility']; 
             $zone           = $resultat['zone'];
             $location       = $resultat['location']; 
             $chw_phone      = $resultat['chw_phone']; 
             $mother_phone   = $resultat['mother_phone'];
             $dist_faci_zone = $resultat['dist_faci_zone'];   
        } 
        
        if($count == 0)
        {
            echo 'No data';
        }
        else
        {
            //echo 'data find';

             //vac1 
             if($vac1 == ' ')
             {

             }
             if($vac1 == 'BCG')
             {
                  $flow = "deca9370-42a5-4dd8-ab4e-d5462293683f";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'BCG') ");

                  echo 'A new ' . $vac1 . ' vaccine registered <br>';
             }
             if($vac1 == 'OPV')
             {
                  $flow = "8222487b-06dd-41e1-a924-c7a38de02e65";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'OPV') ");

                  echo 'A new ' . $vac1 . ' vaccine registered <br>';
             }
             if($vac1 == 'DTP')
             {
                  $flow = "fe3bea1a-f2a2-4859-ade1-1733ee64a848";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'DTP') ");

                  echo 'A new ' . $vac1 . ' vaccine registered <br>';
             }
             if($vac1 == 'PCV')
             {
                  $flow = "0b24aad9-4d7c-4aef-906c-cdfdf51aef3a";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'PCV') ");

                  echo 'A new ' . $vac1 . ' vaccine registered <br>';
             }
             if($vac1 == 'Rota')
             {
                  $flow = "b0661bae-7a56-49d6-94e1-ab410bf05038";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'Rota') ");

                  echo 'A new ' . $vac1 . ' vaccine registered <br>';
             }
             if($vac1 == 'Measles')
             {
                  $flow = "7d0bfb2b-be4e-461d-a39e-e62bb5aa9445";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'Measles') ");

                  echo 'A new ' . $vac1 . ' vaccine registered <br>';
             }

             
           
                         //vac2 
             if($vac2 == ' ')
             {

             }
             if($vac2 == 'BCG')
             {
                  $flow = "deca9370-42a5-4dd8-ab4e-d5462293683f";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'BCG') ");

                  echo 'A new ' . $vac2 . ' vaccine registered <br>';
             }
             if($vac2 == 'OPV')
             {
                  $flow = "8222487b-06dd-41e1-a924-c7a38de02e65";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'OPV') ");

                  echo 'A new ' . $vac2 . ' vaccine registered <br>';
             }
             if($vac2 == 'DTP')
             {
                  $flow = "fe3bea1a-f2a2-4859-ade1-1733ee64a848";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'DTP') ");

                  echo 'A new ' . $vac2 . ' vaccine registered <br>';
             }
             if($vac2 == 'PCV')
             {
                  $flow = "0b24aad9-4d7c-4aef-906c-cdfdf51aef3a";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'PCV') ");

                  echo 'A new ' . $vac2 . ' vaccine registered <br>';
             }
             if($vac2 == 'Rota')
             {
                  $flow = "b0661bae-7a56-49d6-94e1-ab410bf05038";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'Rota') ");

                  echo 'A new ' . $vac2 . ' vaccine registered <br>';
             }
             if($vac2 == 'Measles')
             {
                  $flow = "7d0bfb2b-be4e-461d-a39e-e62bb5aa9445";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'Measles') ");

                  echo 'A new ' . $vac2 . ' vaccine registered <br>';
             }

                         //vac3 
             if($vac3 == ' ')
             {

             }
             if($vac3 == 'BCG')
             {
                  $flow = "deca9370-42a5-4dd8-ab4e-d5462293683f";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'BCG') ");

                  echo 'A new ' . $vac3 . ' vaccine registered <br>';
             }
             if($vac3 == 'OPV')
             {
                  $flow = "8222487b-06dd-41e1-a924-c7a38de02e65";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'OPV') ");

                  echo 'A new ' . $vac3 . ' vaccine registered <br>';
             }
             if($vac3 == 'DTP')
             {
                  $flow = "fe3bea1a-f2a2-4859-ade1-1733ee64a848";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'DTP') ");

                  echo 'A new ' . $vac3 . ' vaccine registered <br>';
             }
             if($vac3 == 'PCV')
             {
                  $flow = "0b24aad9-4d7c-4aef-906c-cdfdf51aef3a";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'PCV') ");

                  echo 'A new ' . $vac3 . ' vaccine registered <br>';
             }
             if($vac3 == 'Rota')
             {
                  $flow = "b0661bae-7a56-49d6-94e1-ab410bf05038";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'Rota') ");

                  echo 'A new ' . $vac3 . ' vaccine registered <br>';
             }
             if($vac3 == 'Measles')
             {
                  $flow = "7d0bfb2b-be4e-461d-a39e-e62bb5aa9445";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'Measles') ");

                  echo 'A new ' . $vac3 . ' vaccine registered <br>';
             }

                         //vac4 
             if($vac4 == ' ')
             {

             }
             if($vac4 == 'BCG')
             {
                  $flow = "deca9370-42a5-4dd8-ab4e-d5462293683f";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'BCG') ");

                  echo 'A new ' . $vac4 . ' vaccine registered <br>';
             }
             if($vac4 == 'OPV')
             {
                  $flow = "8222487b-06dd-41e1-a924-c7a38de02e65";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'OPV') ");

                  echo 'A new ' . $vac4 . ' vaccine registered <br>';
             }
             if($vac4 == 'DTP')
             {
                  $flow = "fe3bea1a-f2a2-4859-ade1-1733ee64a848";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'DTP') ");

                  echo 'A new ' . $vac4 . ' vaccine registered <br>';
             }
             if($vac4 == 'PCV')
             {
                  $flow = "0b24aad9-4d7c-4aef-906c-cdfdf51aef3a";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'PCV') ");

                  echo 'A new ' . $vac4 . ' vaccine registered <br>';
             }
             if($vac4 == 'Rota')
             {
                  $flow = "b0661bae-7a56-49d6-94e1-ab410bf05038";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'Rota') ");

                  echo 'A new ' . $vac4 . ' vaccine registered <br>';
             }
             if($vac4 == 'Measles')
             {
                  $flow = "7d0bfb2b-be4e-461d-a39e-e62bb5aa9445";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'Measles') ");

                  echo 'A new ' . $vac4 . ' vaccine registered <br>';
             }

                         //vac5 
             if($vac5 == ' ')
             {

             }
             if($vac5 == 'BCG')
             {
                  $flow = "deca9370-42a5-4dd8-ab4e-d5462293683f";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'BCG') ");

                  echo 'A new ' . $vac5 . ' vaccine registered <br>';
             }
             if($vac5 == 'OPV')
             {
                  $flow = "8222487b-06dd-41e1-a924-c7a38de02e65";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'OPV') ");

                  echo 'A new ' . $vac5 . ' vaccine registered <br>';
             }
             if($vac5 == 'DTP')
             {
                  $flow = "fe3bea1a-f2a2-4859-ade1-1733ee64a848";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'DTP') ");

                  echo 'A new ' . $vac5 . ' vaccine registered <br>';
             }
             if($vac5 == 'PCV')
             {
                  $flow = "0b24aad9-4d7c-4aef-906c-cdfdf51aef3a";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'PCV') ");

                  echo 'A new ' . $vac5 . ' vaccine registered <br>';
             }
             if($vac5 == 'Rota')
             {
                  $flow = "b0661bae-7a56-49d6-94e1-ab410bf05038";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'Rota') ");

                  echo 'A new ' . $vac5 . ' vaccine registered <br>';
             }
             if($vac5 == 'Measles')
             {
                  $flow = "7d0bfb2b-be4e-461d-a39e-e62bb5aa9445";
                  echo sendPostData($url, $flow, $uuid) . '<br>';
                  echo $uuid . '<br>';

                  $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', 'Measles') ");

                  echo 'A new ' . $vac5 . ' vaccine registered <br>';
             }

              $vaccines=$connexion->query("SELECT * FROM zambia_vaccine WHERE uuid = '" . $uuid . "'");
              $vaccines->setFetchMode(PDO::FETCH_ASSOC);
              while($resultVaccine = $vaccines->fetch())
              {
                  if($resultVaccine['vaccine'] == 'BCG')
                  {
                          $bcg = 1;
                  } 
                  if($resultVaccine['vaccine'] == 'OPV')
                  {
                          $opv = $opv + 1;
                  }
                  if($resultVaccine['vaccine'] == 'DTP')
                  {
                          $dtp = $dtp + 1;
                  }
                  if($resultVaccine['vaccine'] == 'PCV')
                  {
                          $pcv = $pcv + 1;
                  }
                  if($resultVaccine['vaccine'] == 'Rota')
                  {
                          $rota = $rota + 1;
                  }
                  if($resultVaccine['vaccine'] == 'Measles')
                  {
                          $measles = $measles + 1;
                  } 
                  if($bcg == 1 and $opv >= 3 and $dtp >= 3 and $pcv >= 3 and $rota >= 2 and $measles >= 1)
                  {
                          $fully = 1;
                  }
                  else
                  {
                          $fully = 0;
                  }  
              }//while vaccines
              $percents=$connexion->query("SELECT * FROM zambia_percent WHERE uuid = '" . $uuid . "'");
           
              $percents->setFetchMode(PDO::FETCH_ASSOC);
              $count_percent = 0;
              while($percent = $percents->fetch())
              {
                  $count_percent = $count_percent + 1;
              }
              if($count_percent == 0)
              {
                   $connexion->exec("INSERT INTO zambia_percent(uuid, age, sex, province, district, health_facility, zone, location, chw_phone, mother_phone, bcg, opv, dtp, pcv, rota, measles, fully, dob, dist_faci_zone, mvacc_id) VALUES('" . $uuid . "', '" . $age . "', '" . $sex . "', '" . $province . "', '" . $district . "' , '" . $facility . "' , '" . $zone . "', '" . $location . "' , '" . $chw_phone . "' , '" . $mother_phone . "' , '" . $bcg . "' , '" . $opv . "' , '" . $dtp . "' , '" . $pcv . "', '" . $rota . "', '" . $measles . "', '" . $fully . "', '" . $dob . "', '" . $dist_faci_zone . "', '" . $mvacc_id . "')");
              }  
              else
              {
                   $connexion->exec("UPDATE zambia_percent SET bcg='" . $bcg . "' WHERE uuid = '" . $uuid . "' "); 

                   $connexion->exec("UPDATE zambia_percent SET opv='" . $opv . "' WHERE uuid = '" . $uuid . "' "); 

                   $connexion->exec("UPDATE zambia_percent SET dtp='" . $dtp . "' WHERE uuid = '" . $uuid . "' "); 

                   $connexion->exec("UPDATE zambia_percent SET pcv='" . $pcv . "' WHERE uuid = '" . $uuid . "' "); 

                   $connexion->exec("UPDATE zambia_percent SET rota='" . $rota . "' WHERE uuid = '" . $uuid . "' "); 

                   $connexion->exec("UPDATE zambia_percent SET measles='" . $measles . "' WHERE uuid = '" . $uuid . "' "); 

                   $connexion->exec("UPDATE zambia_percent SET fully='" . $fully . "' WHERE uuid = '" . $uuid . "' "); 
              }
            
        }//end else

        $resultats->closeCursor();
        $vaccines->closeCursor();
        $percents->closeCursor();

    }

?>