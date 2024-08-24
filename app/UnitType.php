<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitType extends Model
{
    

    public function product()
    {
        return $this->belongsTo(Product::class, 'unit_type_id');
    }
}
