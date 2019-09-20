<?php

namespace blog;

use Illuminate\Database\Eloquent\Model;

class Mother extends Model
{
    /**
     * The database table used by the model.
     *
     * @var array
     */
    protected $table = 'zambia_mother';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'mother_name', 'mother_phone',
        'province', 'district',
        'health_facility', 'location', 
        'zone', 'chw_phone',
    ];
}
