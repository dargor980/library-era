<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Product
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $cost
 * @property int $profit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $category_id
 * @property int $unit_type_id
 * @property int $stock_id
 * @property string $bar_code
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $category
 * @property-read int|null $category_count
 * @property-read \App\ContentSale $contentSale
 * @property-read \App\ProductHistory $productHistory
 * @property-read \App\ProviderProduct $providerProduct
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Stock[] $stock
 * @property-read int|null $stock_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UnitType[] $unitType
 * @property-read int|null $unit_type_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBarCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUnitTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $fillable = ['id', 'name', 'price', 'cost', 'profit', 'category_id', 'unit_type_id', 'stock_id', 'bar_code'];

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
