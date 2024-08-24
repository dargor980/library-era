<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    
    public function providerProduct()
    {
        return $this->belongsTo(ProviderProduct::class, 'provider_id');
    }
}
