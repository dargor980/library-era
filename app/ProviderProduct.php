<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderProduct extends Model
{
    
    public function provider()
    {
        return $this->hasMany(Provider::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
