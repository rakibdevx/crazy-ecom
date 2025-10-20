<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommissionRule extends Model
{
     use HasFactory;

    protected $fillable = [
        'commission_id',
        'applies_to',
        'applies_id',
        'condition',
        'priority',
    ];

    protected $casts = [
        'condition' => 'array',
    ];

    // 🔗 Relation with Commission
    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }

    // 🔗 Polymorphic relation style (optional idea)
    public function applies()
    {
        return match ($this->applies_to) {
            'category' => $this->belongsTo(Category::class, 'applies_id'),
            'subcategory' => $this->belongsTo(SubCategory::class, 'applies_id'),
            'vendor' => $this->belongsTo(Vendor::class, 'applies_id'),
            // 'product' => $this->belongsTo(Product::class, 'applies_id'),
            default => null,
        };
    }
}
