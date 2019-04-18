<?php

namespace SimFactMdn\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bl_Detail extends Model
{
    use SoftDeletes;
    protected $table = 'bl_details';
    
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

    public function bl()
    {
        return $this->belongsTo('SimFactMdn\Models\Bl', 'bl_id');
    }
    public function produit()
    {
        return $this->belongsTo('SimFactMdn\Models\Produit', 'produit_id');
    }
    public function Bc_detail()
    {
        return $this->belongsTo('SimFactMdn\Models\Bc_detail', 'bc_id');
    }
    public function facture()
    {
        return $this->belongsTo('SimFactMdn\Models\Facture', 'fact_id');
    }
}
