<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    

    public function history()
    {
        return $this->hasMany(History::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
