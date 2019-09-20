<?php

$hote='localhost';
$port='3306';
$name_bd='mvacc';
$user='moh_zambia';
$pass='5cGBKO9mn8';

$connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass);    
    if (isset($_GET['uuid']) and isset($_GET['chw_name']) and isset($_GET['chw_phone']) and isset($_GET['province']) and isset($_GET['district']) and isset($_GET['health_facility']) and isset($_GET['zone'])) 
    {
        $uuid         = $_GET['uuid'];
        $chw_name = $_GET['chw_name']; 
        $chw_phone = $_GET['chw_phone']; 
        $province  = $_GET['province'];  
        $district = $_GET['district'];  
        $health_facility  = $_GET['health_facility'];  
        $zone = $_GET['zone'];
        $location = $_GET['location'];
 
        $connexion->exec("INSERT INTO zambia_chw(uuid, chw_name, chw_phone, province, district , health_facility, zone) VALUES('" . $uuid . "', '" . $chw_name . "', '" . $chw_phone . "', '" . $province . "' , '" . $district . "', '" . $health_facility . "' , '" . $zone . "') ");
    }

?> 