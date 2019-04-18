<?php

namespace SimFactMdn\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marche extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
     protected $dates = ['deleted_at'];

     /**
     * The attributes that can't be fillable.
     *
     * @var array
     */
     protected $guarded = ['id', 'created_at', 'updated_at'];

     public function bcs()
     {
         return $this->hasMany('SimFactMdn\Models\Bc','marche_id','id');
     } 
     
}
