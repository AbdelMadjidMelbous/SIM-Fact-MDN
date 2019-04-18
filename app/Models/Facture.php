<?php

namespace SimFactMdn\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facture extends Model
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

    public function fact_details()
    {
        return $this->hasMany('SimFactMdn\Models\Fact_Detail', 'fact_id', 'id');
    }
        
    public function bl()
    {
        return $this->hasOne('SimFactMdn\Models\Bl', 'fact_id', 'id');
    }
    public function lieu_livr()
    {
        return $this->belongsTo('SimFactMdn\Models\Lieu_Livr', 'lieu_livr_id');
    }

    public function bl_details()
    {
        return $this->hasMany('SimFactMdn\Models\Bl_Detail', 'bl_id', 'id');
    }
    public function cheque()
    {
        return $this->belongsTo('SimFactMdn\Models\Cheque', 'fact_id');
    }
}
