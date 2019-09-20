<?php

namespace blog;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    /**
     * The database table used by the model.
     *
     * @var array
     */
    protected $table = 'zambia_children';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'under5_id', 'dob',
        'sex', 'province', 'district',
        'health_facility', 'location', 'chw_phone',
        'mother_phone', 'zone', 'Name',
        'Birth', 'mvacc_id', 'reason','dist_faci_zone','age',
    ];
}
