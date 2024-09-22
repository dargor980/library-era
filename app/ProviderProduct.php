<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProviderProduct
 *
 * @property int $id
 * @property int $provider_id
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $product
 * @property-read int|null $product_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Provider[] $provider
 * @property-read int|null $provider_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProviderProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProviderProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProviderProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProviderProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProviderProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProviderProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProviderProduct whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProviderProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProviderProduct extends Model
{
    protected $fillable = ['id', 'provider_id', 'product_id'];
    
    public function provider()
    {
        return $this->hasMany(Provider::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
