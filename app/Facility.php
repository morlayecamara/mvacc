<?php

namespace blog;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    /**
     * The database table used by the model.
     *
     * @var array
     */
    protected $table = 'zambia_health_facility';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lat', 'lng', 'province', 'district', 'Code',
    ];
}
