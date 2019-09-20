<?php
namespace blog\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;


class AgeController extends Controller
{

      public function getAge($param)
      {

            $month = 0;

            $dateYear = date('Y');
            $dateYear = intval($dateYear);
            $dateMonth = date('m');
            $dateMonth = intval($dateMonth);


            $dob = $param;
            $dobString = strtotime($dob);

            $dobYear = date('Y',$dobString);
            $dobYear = intval($dobYear);
            //var_dump($dobYear);die();

            $dobMonth = date('m',$dobString);
            $dobMonth = intval($dobMonth);

            $dobPieces = date('Y-m-d',$dobString);

            $dobPieces = Date::now()->timespan($dobPieces);
            $pieces = explode(",", $dobPieces);
            //var_dump($pieces);die();
            $pos_year = strpos($dobPieces, 'year');
            $pos_years = strpos($dobPieces, 'years');
            $pos_month = strpos($dobPieces, 'month');
            $pos_months = strpos($dobPieces, 'months');
            //var_dump($pos_month);die();

                        if(($pos_years != false or $pos_year != false) and ($pos_months != false or $pos_month != false))
                        {
                              //echo $pieces[1] . ' ' . $pos_year . ' ok year <br>';
                              $year = intval($pieces[0]);
                              $month = intval($pieces[1]);
                        }
                        elseif(($pos_years != false or $pos_year != false) and ($pos_months == false or $pos_month == false))
                        {
                              //echo $pieces[0] . ' ' . $pos_year . ' ko year <br>';
                              $year = intval($pieces[0]);
                              $month = 0;
                        }
                        elseif(($pos_years == false or $pos_year == false) and ($pos_months != false or $pos_month != false))
                        {
                              //echo $pieces[0] . ' ' . $pos_year . ' ko year <br>';
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

            //echo $age;
            return $age;


}

}
