<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();

            // Relation to Order
            $table->foreignId('order_id')->constrained()->onDelete('cascade');

            // Product & Vendor Info
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->nullOnDelete();

            // Product Details
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('final_price', 10, 2);

            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('warranty')->nullable();
            $table->boolean('is_fragile')->default(false);

            // Status
            $table->enum('status', ['pending','processing','shipped','delivered','cancelled','returned'])->default('pending');

            // Shipping / Tracking (optional per product)
            $table->string('shipping_company')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('tracking_url')->nullable();
            $table->decimal('shipping_cost', 10, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
