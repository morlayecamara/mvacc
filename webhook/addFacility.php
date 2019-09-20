<?php

$hote='localhost';
$port='3306';
$name_bd='mvacc';
$user='moh_zambia';
$pass='5cGBKO9mn8';

$connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass);    
    if (isset($_GET['name']) and isset($_GET['province']) and isset($_GET['district'])) 
    {
        $name     = $_GET['name']; 
        $province = $_GET['province'];  
        $district = $_GET['district'];   
 
        $connexion->exec("INSERT INTO zambia_health_facility(name, province, district) VALUES('" . $name . "', '" . $province . "', '" . $district . "') ");
    }

?> 