<?php

$hote='localhost';
$port='3306';
$name_bd='mvacc';
$user='moh_zambia';
$pass='5cGBKO9mn8';

$connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass);   
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    if (isset($_GET['old_id']) and isset($_GET['new_id']) and isset($_GET['health_facility'])) 
    { 
                            $new_id              = $_GET['new_id'];
                            $old_id              = $_GET['old_id']; 
                            $health_facility     = $_GET['health_facility'];  
                            function sendPostData($url, $str_data){ 
                                  $ch = curl_init($url);
                                  $str_data = json_encode($str_data);
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
                                    $options = array(
                                        CURLOPT_URL => $url,
                                        CURLOPT_HEADER => false,
                                        CURLOPT_FOLLOWLOCATION => true
                                    ); 
                                    curl_setopt_array($ch, $options);
                                    $result = curl_exec($ch);   
                                    return $result;  

                                }

                $resultats=$connexion->query("SELECT * FROM zambia_children WHERE health_facility = '" . $health_facility . "' and mvacc_id = '" . $old_id . "'");
                $resultats->setFetchMode(PDO::FETCH_ASSOC);
                $count = 0; 
                 
                while($resultat = $resultats->fetch())
                {
                     $count          = $count + 1;
                     $uuid           = $resultat['uuid'];  
                     $facility       = $resultat['health_facility'];  
                     $chw_phone      = $resultat['chw_phone'];   

                     $url ="https://api.rapidpro.io/api/v2/contacts.json?uuid=".$uuid;
                             $data = array(    
                                          "fields" => [ 
                                            "mvacc_id"=>$new_id
                                          ] 
                                );  
                } 
                
                if($count == 0)
                {
                    return 'False';
                }
                else
                { 
                    $connexion->exec("UPDATE zambia_children SET mvacc_id='" . $new_id . "' WHERE uuid = '" . $uuid . "' "); 
                    $percents=$connexion->query("SELECT * FROM zambia_percent WHERE uuid = '" . $uuid . "'");
                    $percents->setFetchMode(PDO::FETCH_ASSOC);
                    $count_percent = 0;
                    while($percent = $percents->fetch())
                    {
                       $count_percent = $count_percent + 1;
                    } 
                    if($count_percent != 0)
                    {
                       $connexion->exec("UPDATE zambia_percent SET mvacc_id='" . $new_id . "' WHERE uuid = '" . $uuid . "' "); 
                    }
                    sendPostData($url, $data);
                    return 'True';
                }  
                
                $resultats->closeCursor();
                $percents->closeCursor();  
    } 
?>