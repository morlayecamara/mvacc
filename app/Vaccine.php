<?php

namespace blog;

use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
     /**
     * The database table used by the model.
     *
     * @var array
     */
    protected $table = 'zambia_vaccine';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'under5_id', 'vaccine', 
    ];
}
