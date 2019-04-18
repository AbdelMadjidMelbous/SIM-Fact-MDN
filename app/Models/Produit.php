<?php

namespace SimFactMdn\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
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
    
    /**
     * Get the brand that the product belongs to.
    */
    public function type_produit()
    {
        return $this->belongsTo('SimFactMdn\Models\Type_Produit', 'type_id');
    }
    public function tva()
    {
        return $this->belongsTo('SimFactMdn\Models\Tva', 'tva_id');
    }
    public function unite_mesure()
    {
        return $this->belongsTo('SimFactMdn\Models\Unite_mesure', 'u_mesure');
    }
    public function bc_details()
    {
        return $this->hasMany('SimFactMdn\Models\Bc_detail', 'produit_id', 'id');
    }
    public function bl_details()
    {
        return $this->hasMany('SimFactMdn\Models\Bl_Detail', 'produit_id', 'id');
    }
}
