<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->text('notes')->nullable();

            // 7-13. Shipping Info
            $table->foreignId('shipping_zone_id')->nullable()->constrained('shipping_zones')->nullOnDelete();
            $table->string('street_address');
            $table->string('city')->nullable();
            $table->decimal('shipping_amount', 10, 2)->default(0);

            // 14-22. Order Summary
            $table->decimal('subtotal', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('grand_total', 10, 2)->default(0);
            $table->integer('total_items')->default(0);
            $table->integer('total_vendors')->default(0);
            $table->string('currency', 10)->default('USD');

            // 23-28. Payment
            $table->string('payment_method')->nullable();
            $table->enum('payment_status', ['pending','paid','failed','refunded'])->default('pending');
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->decimal('refund_amount', 10, 2)->default(0);
            $table->timestamp('paid_at')->nullable();
            $table->string('transaction_id')->nullable();

            // 29-35. Coupon / Discounts
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->nullOnDelete();
            $table->decimal('coupon_discount', 10, 2)->default(0);

            // 36-43. Central Status
            $table->enum('order_status', ['pending','processing','partially_delivered','delivered','cancelled','returned'])->default('pending');
            $table->timestamp('placed_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->text('status_notes')->nullable();

            // 51-55. Extra optional
            $table->string('invoice_number')->nullable();
            $table->boolean('is_gift')->default(false);
            $table->string('gift_message')->nullable();
            $table->boolean('is_priority')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
