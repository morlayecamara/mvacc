<?php

$hote='localhost';
$port='3306';
$name_bd='mvacc';
$user='moh_zambia';
$pass='5cGBKO9mn8';

$connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass);    
    if (isset($_GET['uuid']) and isset($_GET['mother_name']) and isset($_GET['mother_phone']) and isset($_GET['province']) and isset($_GET['district']) and isset($_GET['health_facility']) and isset($_GET['location'])  and isset($_GET['chw_phone']) and isset($_GET['zone'])) 
    {
        $uuid         = $_GET['uuid'];
        $mother_name         = $_GET['mother_name'];
        $mother_phone         = $_GET['mother_phone']; 
        $province    = $_GET['province'];
        $district    = $_GET['district'];
        $health_facility    = $_GET['health_facility'];
        $location    = $_GET['location'];
        $chw_phone    = $_GET['chw_phone']; 
        $zone    = $_GET['zone'];
        $connexion->exec("INSERT INTO zambia_mother(uuid, mother_name, mother_phone, province, district, health_facility, location, chw_phone, zone) VALUES('" . $uuid . "' , '" . $mother_name . "' , '" . $mother_phone . "', '" . $province . "' , '" . $district . "' , '" . $health_facility . "' , '" . $location . "' , '" . $chw_phone . "' , '" . $zone . "')");
    }

?> 