<?php

$hote='localhost';
$port='3306';
$name_bd='mvacc';
$user='moh_zambia';
$pass='5cGBKO9mn8';

$connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass);   
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
        

        $resultats=$connexion->query("SELECT * FROM zambia_health_facility");
        $resultats->setFetchMode(PDO::FETCH_ASSOC);
        $count = 0;
         
        while($resultat = $resultats->fetch())
        {
             $count = $count + 1; 
             $facility = $resultat['name'];
             $province = $resultat['province'];
             $district = $resultat['district']; 

             $null = " ";

             $chws=$connexion->query("SELECT * FROM zambia_chw WHERE province = '" . $null . "' and district = '" . $null . "'");

             while($chw = $chws->fetch())
             {
             	 $connexion->exec("UPDATE zambia_chw SET province='" . $province . "' WHERE health_facility = '" . $facility . "' ");

                 $connexion->exec("UPDATE zambia_chw SET district='" . $district . "' WHERE health_facility = '" . $facility . "' "); 
             } 
            
        }
         
        
        if($count == 0)
        {
            echo 'No';
        }
        else
        {
            echo $count . ' query updated';
        }

        $resultats->closeCursor();
    

?>