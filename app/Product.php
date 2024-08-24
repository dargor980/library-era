<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    

    public function contentSale()
    {
        return $this->belongsTo(ContentSale::class, 'product_id');
    }

    public function providerProduct()
    {
        return $this->belongsTo(ProviderProduct::class, 'product_id');
    }

    public function productHistory()
    {
        return $this->belongsTo(ProductHistory::class, 'product_id');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function unitType()
    {
        return $this->hasMany(UnitType::class);
    }

    public function category()
    {
        return $this->hasMany(Category::class);
    }
}
