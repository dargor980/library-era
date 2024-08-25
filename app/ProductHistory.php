<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductHistory
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $product_id
 * @property int $history_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\History[] $history
 * @property-read int|null $history_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $product
 * @property-read int|null $product_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProductHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductHistory whereHistoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductHistory whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
