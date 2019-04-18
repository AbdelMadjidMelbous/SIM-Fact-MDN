<?php

namespace SimFactMdn\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bc_detail extends Model
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
        
    public function bc()
    {
        return $this->belongsTo('SimFactMdn\Models\Bc', 'bc_id');
    }
    public function produit()
    {
        return $this->belongsTo('SimFactMdn\Models\Produit', 'produit_id');
    }
    public function lieu_livr()
    {
        return $this->belongsTo('SimFactMdn\Models\Lieu_Livr', 'lieu_livr_id');
    }
    public function bl_details()
    {
        return $this->hasMany('SimFactMdn\Models\Bl_Detail', 'bc_id', 'id');
    }
}
