<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingRate extends Model
{
    protected $guarded = [];
    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function zone() {
        return $this->belongsTo(ShippingZone::class);
    }

    public function vendor() {
        return $this->belongsTo( Vendor::class, 'seller_id');
    }
}
