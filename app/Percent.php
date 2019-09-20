<?php

namespace blog;

use Illuminate\Database\Eloquent\Model;

class Percent extends Model
{
    /**
     * The database table used by the model.
     *
     * @var array
     */
    protected $table = 'zambia_percent';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'age', 'sex','province', 'district',
        'health_facility', 'location', 'chw_phone',
        'mother_phone', 'zone', 'bcg','opv', 'dtp', 
        'pcv','rota','measles','fully','dist_faci_zone','dob','mvacc_id',
    ];
}