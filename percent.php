<?php

$hote='localhost';
$port='3306';
$name_bd='mvacc';
$user='moh_zambia';
$pass='5cGBKO9mn8';

$connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass);   
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 

        $childrens=$connexion->query("SELECT * FROM zambia_children");
        $childrens->setFetchMode(PDO::FETCH_ASSOC);
        $count = 0;
         
        while($child = $childrens->fetch())
        {
             $count        = $count + 1;
             $uuid         = $child['uuid'];
             $dob          = $child['dob'];
             $age          = $child['age']; 
             $sex          = $child['sex']; 
             $province     = $child['province']; 
             $district     = $child['district']; 
             $facility     = $child['health_facility']; 
             $zone         = $child['zone'];
             $location     = $child['location']; 
             $chw_phone    = $child['chw_phone']; 
             $mother_phone = $child['mother_phone'];
             $dist_faci_zone = $child['dist_faci_zone']; 

             $bcg = 0;
             $opv = 0;
             $pcv = 0;
             $dtp = 0;
             $rota = 0;
             $measles = 0;

             $vaccines=$connexion->query("SELECT * FROM zambia_vaccine WHERE uuid = '" . $uuid . "'");
             $vaccines->setFetchMode(PDO::FETCH_ASSOC); 
             while($vaccine = $vaccines->fetch())
             {
                //echo $vaccine['vaccine'] . '<br>';
                if($vaccine['vaccine'] == 'BCG')
                {
                    $bcg = 1;
                } 
                if($vaccine['vaccine'] == 'OPV')
                {
                    $opv = $opv + 1;
                }
                if($vaccine['vaccine'] == 'DTP')
                {
                    $dtp = $dtp + 1;
                }
                if($vaccine['vaccine'] == 'PCV')
                {
                    $pcv = $pcv + 1;
                }
                if($vaccine['vaccine'] == 'Rota')
                {
                    $rota = $rota + 1;
                }
                if($vaccine['vaccine'] == 'Measles')
                {
                    $measles = $measles + 1;
                } 
                

                if($bcg == 1 and $opv >= 3 and $dtp == 3 and $pcv == 3 and $rota == 2 and $measles >= 1)
                {
                    $fully = 100;
                }
                else
                {
                    $fully = 0;
                }  

            }
            $connexion->exec("INSERT INTO zambia_percent(uuid, age, sex, province, district, health_facility, zone, location, chw_phone, mother_phone, bcg, opv, dtp, pcv, rota, measles, fully, dob, dist_faci_zone) VALUES('" . $uuid . "', '" . $age . "', '" . $sex . "', '" . $province . "', '" . $district . "' , '" . $facility . "' , '" . $zone . "', '" . $location . "' , '" . $chw_phone . "' , '" . $mother_phone . "' , '" . $bcg . "' , '" . $opv . "' , '" . $dtp . "' , '" . $pcv . "', '" . $rota . "', '" . $measles . "', '" . $fully . "', '" . $dob . "', '" . $dist_faci_zone . "')");

            $bcg = 0;
            $opv = 0;
            $pcv = 0;
            $dtp = 0;
            $rota = 0;
            $measles = 0; 
             
        }
         
        
        if($count == 0)
        {
            echo 'No';
        }
        else
        {
            echo 'Match';
        }

        $vaccines->closeCursor();

        $childrens->closeCursor();
    

?>