<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentSale extends Model
{
    
    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }
}
