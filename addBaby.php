<?php


require __DIR__.'/vendor/autoload.php';

use Jenssegers\Date\Date;

$hote='localhost';
$port='3306';
$name_bd='mvacc';
$user='moh_zambia';
$pass='5cGBKO9mn8';

$connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass);    
    if (isset($_GET['uuid']) and isset($_GET['under5_id']) and isset($_GET['dob']) and isset($_GET['sex']) and isset($_GET['province']) and isset($_GET['district']) and isset($_GET['health_facility']) and isset($_GET['location'])  and isset($_GET['chw_phone'])  and isset($_GET['mother_phone'])  and isset($_GET['zone']) and isset($_GET['birth']) and isset($_GET['id'])) 
    {
        $uuid        = $_GET['uuid'];
        $under5_id   = $_GET['under5_id']; 
        $birth       = $_GET['birth'];
        $dob         = $_GET['dob'];
        $sex         = $_GET['sex'];
        $province    = $_GET['province'];
        $district    = $_GET['district'];
        $health_facility    = $_GET['health_facility'];
        $location    = $_GET['location'];
        $chw_phone    = $_GET['chw_phone'];
        $mother_phone    = $_GET['mother_phone'];
        $zone    = $_GET['zone'];
        $id    = $_GET['id'];
        $dist_faci_zone = $district.$health_facility.$zone;

        $dateYear = date('Y');
        $dateYear = intval($dateYear);
        $dateMonth = date('m');
        $dateMonth = intval($dateMonth);


        $dobString = strtotime($dob);

        $dobYear = date('Y',$dobString);
        $dobYear = intval($dobYear); 

        $dobMonth = date('m',$dobString);
        $dobMonth = intval($dobMonth);

        $dobPieces = date('Y-m-d',$dobString);

        $dobPieces = Date::now()->timespan($dobPieces);
        $pieces = explode(",", $dobPieces);  
        $pos_year = strpos($dobPieces, 'year');
        $pos_years = strpos($dobPieces, 'years');
        $pos_month = strpos($dobPieces, 'month');
        $pos_months = strpos($dobPieces, 'months'); 

        if(($pos_years != false or $pos_year != false) and ($pos_months != false or $pos_month != false))
        {              
            $year = intval($pieces[0]);
            $month = intval($pieces[1]);
        }
        elseif(($pos_years != false or $pos_year != false) and ($pos_months == false or $pos_month == false))
        { 
            $year = intval($pieces[0]);
            $month = 0;
        }
        elseif(($pos_years == false or $pos_year == false) and ($pos_months != false or $pos_month != false))
        {                 
            $year = 0;
            $month = intval($pieces[0]);
        }
        else
        {
            $year = 0;
            $month = 0;
        }



        if($year >= 1)
        {
            $age = $month + 12*($year);
        }
        else
        {
            $age = $month;
        }
  

        $connexion->exec("INSERT INTO zambia_children(uuid, under5_id, dob, sex, province, district, health_facility, location, chw_phone, mother_phone, zone, Birth, mvacc_id, age) VALUES('" . $uuid . "', '" . $under5_id . "', '" . $dob . "', '" . $sex . "' , '" . $province . "' , '" . $district . "', '" . $health_facility . "' , '" . $location . "' , '" . $chw_phone . "' , '" . $mother_phone . "' , '" . $zone . "' , '" . $birth . "' , '" . $id . "', '" . $age . "')");

        $connexion->exec("UPDATE zambia_children SET dist_faci_zone='" . $dist_faci_zone . "' WHERE uuid = '" . $uuid . "' ");
    }

?>