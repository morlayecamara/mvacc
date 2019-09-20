<?php

$hote='localhost';
$port='3306';
$name_bd='mvacc';
$user='moh_zambia';
$pass='5cGBKO9mn8';

$connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass);   
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
        

        $resultats=$connexion->query("SELECT * FROM zambia_children");
        $resultats->setFetchMode(PDO::FETCH_ASSOC);
        $count = 0;
         
        while($resultat = $resultats->fetch() )
        {
             $count = $count + 1;
             $uuid = $resultat['uuid'];
             $facility = $resultat['health_facility'];
             $district = $resultat['district'];
             $zone = $resultat['zone'];
             $dist_faci_zone = $district.$facility.$zone;

             $connexion->exec("UPDATE zambia_children SET dist_faci_zone='" . $dist_faci_zone . "' WHERE uuid = '" . $uuid . "' ");
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