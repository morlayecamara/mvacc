<?php

$hote='localhost';
$port='3306';
$name_bd='mvacc';
$user='moh_zambia';
$pass='5cGBKO9mn8';

$connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass);   
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    if (isset($_GET['id']) and isset($_GET['health_facility'])) 
    { 
           
        $health_facility    = $_GET['health_facility']; 
        $id    = $_GET['id'];

        $resultats=$connexion->query("SELECT mvacc_id, health_facility FROM zambia_children WHERE health_facility = '" . $health_facility . "' and mvacc_id = '" . $id . "' ");
        $resultats->setFetchMode(PDO::FETCH_ASSOC);
        $count = 0;
         
        while($resultat = $resultats->fetch() )
        {
             $count = $count + 1;
        }
         
        
        if($count == 0)
        {
            echo 'No';
        }
        else
        {
            echo 'Match';
        }

        $resultats->closeCursor();
    }

?>