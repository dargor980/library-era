<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    
    public function content()
    {
        $this->belongsTo(ContentSale::class, 'sale_id');
    }
}
