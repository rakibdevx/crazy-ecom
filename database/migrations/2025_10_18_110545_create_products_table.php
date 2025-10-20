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
        {
            Schema::create('products', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->id();

                // Relational tables
                $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
                $table->foreignId('sub_category_id')->nullable()->constrained('sub_categories')->nullOnDelete();
                $table->foreignId('child_category_id')->nullable()->constrained('child_categories')->nullOnDelete();
                $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();

                // Identifiers
                $table->string('sku')->unique()->nullable();
                $table->string('barcode')->nullable();

                // Names
                $table->string('name');
                $table->string('slug')->unique();
                // Pricing
                $table->decimal('cost_price', 12, 2)->nullable();
                $table->decimal('old_price', 5, 2)->nullable();
                $table->decimal('sale_price', 12, 2)->nullable();
                $table->timestamp('sale_starts_at')->nullable();
                $table->timestamp('sale_ends_at')->nullable();

                // Inventory
                $table->boolean('has_variants')->default(false);
                $table->integer('stock_quantity')->default(0);
                $table->integer('low_stock_threshold')->default(5);
                $table->boolean('pre_order')->default(false);

                // Shipping / Dimensions
                $table->decimal('weight_kg', 8, 3)->nullable();
                $table->decimal('length_cm', 8, 2)->nullable();
                $table->decimal('width_cm', 8, 2)->nullable();
                $table->decimal('height_cm', 8, 2)->nullable();
                $table->decimal('shipping_cost', 10, 2)->nullable();

                // Product Type & Status
                $table->enum('product_type', ['simple', 'variable', 'digital', 'bundle'])->default('simple');
                $table->enum('status',['active','inactive','suspend'])->default('active');
                $table->enum('featured',['yes','no'])->default('yes');
                $table->enum('new',['yes','no'])->default('yes');
                $table->enum('trending',['yes','no'])->default('yes');
                $table->enum('best_seller',['yes','num'])->default('yes');

                // Content
                $table->text('short_description')->nullable();
                $table->longText('description')->nullable();
                $table->text('specifications')->nullable(); // for tech specs or details

                // Media (handled by separate tables, but fallback fields)
                $table->string('thumbnail')->nullable();

                // SEO
                $table->string('meta_title')->nullable();
                $table->text('meta_description')->nullable();
                $table->string('meta_keywords')->nullable();

                // Extras
                $table->json('tags')->nullable();
                $table->integer('view_count')->default(0);
                $table->integer('sold_count')->default(0);

                // Admin / Vendor
                $table->foreignId('vendor_id')
                    ->nullable()
                    ->constrained('vendors')
                    ->cascadeOnDelete();
                $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();

                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
