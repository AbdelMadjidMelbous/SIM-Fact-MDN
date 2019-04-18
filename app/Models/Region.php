<?php

namespace SimFactMdn\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
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

    public function lieu_livrs()
    {
        return $this->hasMany('SimFactMdn\Models\Lieu_Livr', 'region_id', 'id');
    }

    public function getTotalQuantityCom()
    {
        $total = 0;
        foreach ($this->lieu_livrs as $lieu) {
            $total += $lieu->getTotalQuantityComLieu();
        }
        return $total;
    }
}
