<?php

$hote='localhost';
$port='3306';
$name_bd='mvacc';
$user='moh_zambia';
$pass='5cGBKO9mn8';

$connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass);    
    if (isset($_GET['uuid'])) 
    {
        // recuperation uuid et under5_id pour child
        $uuid = $_GET['uuid']; 
      
        $connexion->exec("DELETE FROM zambia_vaccine WHERE uuid = '" . $uuid . "'");
    }

?>