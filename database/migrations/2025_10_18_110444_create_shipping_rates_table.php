<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipping_rates', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('shipping_zone_id')->constrained('shipping_zones')->onDelete('cascade');
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->onDelete('cascade');
            $table->decimal('cost', 10, 2)->default(0);
            $table->timestamps();
            $table->unique(['shipping_zone_id', 'vendor_id']);
        });


    }

    public function down(): void
    {
        Schema::dropIfExists('shipping_rates');
    }
};
