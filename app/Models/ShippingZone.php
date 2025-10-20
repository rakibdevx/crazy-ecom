<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingZone extends Model
{
    protected $fillable = [
        'name',
        'country',
        'division',
        'district',
        'area',
        'type',
        'base_cost',
        'additional_cost_per_kg',
        'min_order_amount',
        'is_active',
    ];

    public function shippingRate()
    {
        return $this->hasOne(ShippingRate::class, 'shipping_zone_id');
    }
}
