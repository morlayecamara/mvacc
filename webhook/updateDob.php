<?php

$hote='localhost';
$port='3306';
$name_bd='mvacc';
$user='moh_zambia';
$pass='5cGBKO9mn8';

$connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass);   
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    if (isset($_GET['uuid']) and isset($_GET['dob'])) 
    { 
        $uuid   = $_GET['uuid'];  
        $dob    = $_GET['dob'];  

        $connexion->exec("UPDATE zambia_children SET dob='" . $dob . "' WHERE uuid = '" . $uuid . "' ");
    }

?>