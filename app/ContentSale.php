<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ContentSale
 *
 * @property int $id
 * @property int $sale_id
 * @property int $product_id
 * @property int $quantity
 * @property int $subtotal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $product
 * @property-read int|null $product_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Sale[] $sale
 * @property-read int|null $sale_count
 * @method static \Illuminate\Database\Eloquent\Builder|ContentSale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentSale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentSale query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContentSale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentSale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentSale whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentSale whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentSale whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentSale whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContentSale whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
