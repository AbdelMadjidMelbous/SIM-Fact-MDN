<?php

namespace SimFactMdn\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bl extends Model
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

    public function bl_details()
    {
        return $this->hasMany('SimFactMdn\Models\Bl_Detail', 'bl_id', 'id');
    }
        
    public function lieu_livr()
    {
        return $this->belongsTo('SimFactMdn\Models\Lieu_Livr', 'lieu_livr_id');
    }

    public function facture()
    {
        return $this->belongsTo('SimFactMdn\Models\Facture', 'fact_id');
    }
    public function bc()
    {
        return $this->belongsTo('SimFactMdn\Models\Bc', 'bc_id');
    }
}
