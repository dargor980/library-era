<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    
    public function productHistory()
    {
        return $this->belongsTo(ProductHistory::class, 'history_id');
    }
}
