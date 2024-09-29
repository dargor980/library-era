<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Sale
 *
 * @property int $id
 * @property int $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Sale extends Model
{
    protected $fillable = ['id', 'total', 'payment_type_id', 'created_at'];
    
    public function content()
    {
        $this->belongsTo(ContentSale::class, 'sale_id');
    }
}
