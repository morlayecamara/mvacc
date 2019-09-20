<?php

$hote='localhost';
$port='3306';
$name_bd='mvacc';
$user='moh_zambia';
$pass='5cGBKO9mn8';

    $connexion = new PDO('mysql:host='.$hote.';port='.$port.';dbname='.$name_bd, $user, $pass); 
    $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);   
    if (isset($_GET['uuid']) and isset($_GET['under5_id']) and isset($_GET['vaccine'])) 
    {
        $uuid      = $_GET['uuid'];
        $under5_id = $_GET['under5_id']; 
        $vaccine   = $_GET['vaccine'];  

        $bcg = 0;
        $opv = 0;
        $pcv = 0;
        $dtp = 0;
        $rota = 0;
        $measles = 0;
        $count_children = 0;

        $childrens=$connexion->query("SELECT * FROM zambia_children WHERE uuid = '" . $uuid . "'");
        $childrens->setFetchMode(PDO::FETCH_ASSOC);  
        while($child = $childrens->fetch())
        { 
        	 $count_children = $count_children + 1;
             $uuid         = $child['uuid'];
             $dob          = $child['dob'];
             $age          = $child['age']; 
             $sex          = $child['sex']; 
             $province     = $child['province']; 
             $district     = $child['district']; 
             $facility     = $child['health_facility']; 
             $zone         = $child['zone'];
             $location     = $child['location']; 
             $chw_phone    = $child['chw_phone']; 
             $mother_phone = $child['mother_phone'];
             $dist_faci_zone = $child['dist_faci_zone']; 
         }

        if($count_children != 0) {   

	        $vaccines=$connexion->query("SELECT * FROM zambia_vaccine WHERE uuid = '" . $uuid . "'");
	        $vaccines->setFetchMode(PDO::FETCH_ASSOC);
	        while($resultVaccine = $vaccines->fetch())
	        {
	        	if($resultVaccine['vaccine'] == 'BCG')
	            {
	                    $bcg = 1;
	            } 
	            if($resultVaccine['vaccine'] == 'OPV')
	            {
	                    $opv = $opv + 1;
	            }
	            if($resultVaccine['vaccine'] == 'DTP')
	            {
	                    $dtp = $dtp + 1;
	            }
	            if($resultVaccine['vaccine'] == 'PCV')
	            {
	                    $pcv = $pcv + 1;
	            }
	            if($resultVaccine['vaccine'] == 'Rota')
	            {
	                    $rota = $rota + 1;
	            }
	            if($resultVaccine['vaccine'] == 'Measles')
	            {
	                    $measles = $measles + 1;
	            } 
	            if($bcg == 1 and $opv >= 3 and $dtp == 3 and $pcv == 3 and $rota == 2 and $measles >= 1)
	            {
	                    $fully = 100;
	            }
	            else
	            {
	                    $fully = 0;
	            }  
	        }

	        if($vaccine == 'BCG' and $bcg == 1)
	        {
	            
	        } 
	        elseif($vaccine == 'OPV' and $opv == 4)
	        {
	            
	        } 
	        elseif($vaccine == 'DTP' and $dtp == 3)
	        {
	            
	        } 
	        elseif($vaccine == 'PCV' and $pcv == 3)
	        {
	            
	        } 
	        elseif($vaccine == 'Rota' and $rota == 2)
	        {
	            
	        }
	        elseif($vaccine == 'Measles' and $measles == 2)
	        {
	            
	        } 
	        else
	        {
	            $connexion->exec("INSERT INTO zambia_vaccine(uuid, under5_id, vaccine) VALUES('" . $uuid . "', '" . $under5_id . "', '" . $vaccine . "') ");
	        }  

	        $percents=$connexion->query("SELECT * FROM zambia_percent WHERE uuid = '" . $uuid . "'");
           
	        $percents->setFetchMode(PDO::FETCH_ASSOC);
	        $count_percent = 0;
	        while($percent = $percents->fetch())
	        {
	            $count_percent = $count_percent + 1;
	        }
            
            //var_dump($count_percent);
	        if($count_percent == 0)
	        {
	            //echo 'No';
                $bcg = 0;
		        $opv = 0;
		        $pcv = 0;
		        $dtp = 0;
		        $rota = 0;
		        $measles = 0;
	             $vaccines=$connexion->query("SELECT * FROM zambia_vaccine WHERE uuid = '" . $uuid . "'");
	        $vaccines->setFetchMode(PDO::FETCH_ASSOC);
	        while($resultVaccine = $vaccines->fetch())
	        {
	        	if($resultVaccine['vaccine'] == 'BCG')
	            {
	                    $bcg = 1;
	            } 
	            if($resultVaccine['vaccine'] == 'OPV')
	            {
	                    $opv = $opv + 1;
	            }
	            if($resultVaccine['vaccine'] == 'DTP')
	            {
	                    $dtp = $dtp + 1;
	            }
	            if($resultVaccine['vaccine'] == 'PCV')
	            {
	                    $pcv = $pcv + 1;
	            }
	            if($resultVaccine['vaccine'] == 'Rota')
	            {
	                    $rota = $rota + 1;
	            }
	            if($resultVaccine['vaccine'] == 'Measles')
	            {
	                    $measles = $measles + 1;
	            } 
	            if($bcg == 1 and $opv >= 3 and $dtp == 3 and $pcv == 3 and $rota == 2 and $measles >= 1)
	            {
	                    $fully = 100;
	            }
	            else
	            {
	                    $fully = 0;
	            }  
	        }
	           $connexion->exec("INSERT INTO zambia_percent(uuid, age, sex, province, district, health_facility, zone, location, chw_phone, mother_phone, bcg, opv, dtp, pcv, rota, measles, fully, dob, dist_faci_zone) VALUES('" . $uuid . "', '" . $age . "', '" . $sex . "', '" . $province . "', '" . $district . "' , '" . $facility . "' , '" . $zone . "', '" . $location . "' , '" . $chw_phone . "' , '" . $mother_phone . "' , '" . $bcg . "' , '" . $opv . "' , '" . $dtp . "' , '" . $pcv . "', '" . $rota . "', '" . $measles . "', '" . $fully . "', '" . $dob . "', '" . $dist_faci_zone . "')");
	        }
	        else
	        {
	            echo 'Match'; 
	            $bcg = 0;
		        $opv = 0;
		        $pcv = 0;
		        $dtp = 0;
		        $rota = 0;
		        $measles = 0;
	             $vaccines=$connexion->query("SELECT * FROM zambia_vaccine WHERE uuid = '" . $uuid . "'");
				        $vaccines->setFetchMode(PDO::FETCH_ASSOC);
				        while($resultVaccine = $vaccines->fetch())
				        {
				        	if($resultVaccine['vaccine'] == 'BCG')
				            {
				                    $bcg = 1;
				            } 
				            if($resultVaccine['vaccine'] == 'OPV')
				            {
				                    $opv = $opv + 1;
				            }
				            if($resultVaccine['vaccine'] == 'DTP')
				            {
				                    $dtp = $dtp + 1;
				            }
				            if($resultVaccine['vaccine'] == 'PCV')
				            {
				                    $pcv = $pcv + 1;
				            }
				            if($resultVaccine['vaccine'] == 'Rota')
				            {
				                    $rota = $rota + 1;
				            }
				            if($resultVaccine['vaccine'] == 'Measles')
				            {
				                    $measles = $measles + 1;
				            } 
				            if($bcg == 1 and $opv >= 3 and $dtp == 3 and $pcv == 3 and $rota == 2 and $measles >= 1)
				            {
				                    $fully = 100;
				            }
				            else
				            {
				                    $fully = 0;
				            }  
				        } 
	            $connexion->exec("UPDATE zambia_percent SET bcg='" . $bcg . "' WHERE uuid = '" . $uuid . "' "); 

	            $connexion->exec("UPDATE zambia_percent SET opv='" . $opv . "' WHERE uuid = '" . $uuid . "' "); 

	            $connexion->exec("UPDATE zambia_percent SET dtp='" . $dtp . "' WHERE uuid = '" . $uuid . "' "); 

	            $connexion->exec("UPDATE zambia_percent SET pcv='" . $pcv . "' WHERE uuid = '" . $uuid . "' "); 

	            $connexion->exec("UPDATE zambia_percent SET rota='" . $rota . "' WHERE uuid = '" . $uuid . "' "); 

	            $connexion->exec("UPDATE zambia_percent SET measles='" . $measles . "' WHERE uuid = '" . $uuid . "' "); 

	            $connexion->exec("UPDATE zambia_percent SET fully='" . $fully . "' WHERE uuid = '" . $uuid . "' "); 
	        }

        }//endif $count_children 

        $vaccines->closeCursor();

        $childrens->closeCursor();
    }

?> 