<?php
 
	$hote='localhost';
	$port='3306';
	$name_bd='your_table';
	$user='root';
	$pass='';
	$connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass); 

?>