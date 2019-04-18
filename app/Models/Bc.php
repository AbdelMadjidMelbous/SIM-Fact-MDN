<?php

namespace SimFactMdn\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bc extends Model
{
    use SoftDeletes;
    
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

    public function marche()
    {
        return $this->belongsTo('SimFactMdn\Models\Marche', 'marche_id');
    }
    public function bc_details()
    {
        return $this->hasMany('SimFactMdn\Models\Bc_detail', 'bc_id', 'id');
    }
    public function bls()
    {
        return $this->hasMany('SimFactMdn\Models\Bl', 'bc_id', 'id');
    }

    public function getTotalQuantity()
    {
        return $this->bc_details()->sum(DB::raw('quantite_com'));
    }
}
