<?php

namespace SimFactMdn\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lieu_Livr extends Model
{
    use SoftDeletes;
    protected $table = 'lieu_livrs';
    
    
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
        
    public function region()
    {
        return $this->belongsTo('SimFactMdn\Models\Region', 'region_id');
    }
    public function bc_details()
    {
        return $this->hasMany('SimFactMdn\Models\Bc_detail', 'lieu_livr_id', 'id');
    }

    public function bls()
    {
        return $this->hasMany('SimFactMdn\Models\Bl', 'lieu_livr_id', 'id');
    }
    public function factures()
    {
        return $this->hasMany('SimFactMdn\Models\Facture', 'lieu_livr_id', 'id');
    }

    public function getTotalQuantityComLieu()
    {
        return $this->bc_details()->sum(DB::raw('quantite_com'));
    }
}
