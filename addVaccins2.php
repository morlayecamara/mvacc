<?php

$hote='localhost';
$port='3306';
$name_bd='mvacc';
$user='moh_zambia';
$pass='5cGBKO9mn8';

$connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass);  
    if (isset($_GET['uuid']) and isset($_GET['under5_id']) and isset($_GET['type_vaccine']) and isset($_GET['date_vaccine'])) 
    {
        $uuid         = $_GET['uuid'];
        $under5_id = $_GET['under5_id']; 
        $type_vaccine  = $_GET['type_vaccine'];  
        $date_vaccine  = $_GET['date_vaccine'];
        $date_vaccine = date("Y-m-d H:i:s", strtotime($date_vaccine));
         
$count = $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine, created_at) VALUES('" . $uuid . "', '" . $under5_id . "', '" . $type_vaccine . "' , '" . $date_vaccine . "') ");
echo $count . ' recording done';
    }

?> 