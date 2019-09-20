<?php

namespace blog;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
     /**
     * The database table used by the model.
     *
     * @var array
     */
    protected $table = 'zambia_province';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lat', 'lng',
    ];
}
