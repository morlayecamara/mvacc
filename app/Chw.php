<?php

namespace blog;

use Illuminate\Database\Eloquent\Model;

class Chw extends Model
{
    /**
     * The database table used by the model.
     *
     * @var array
     */
    protected $table = 'zambia_chw';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'chw_name', 'chw_phone',
        'province', 'district',
        'health_facility', 'location',
        'zone', 
    ];
}
