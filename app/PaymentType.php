<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    public const PAYMENT_TYPE = ['cash' => 1, 'transfer' => 2];

    protected $fillable = ['id', 'name'];
}
