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
        Schema::create('varient_products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('category');
            $table->string('tax');
            $table->string('primary_unit');
            $table->string('selling_price');
            $table->string('purchase_price');

            // Assuming you want to store attributes and options separately
            $table->foreignId('attribute_id')->nullable()->constrained('varient_attributes')->onDelete('set null');
            $table->foreignId('option_id')->nullable()->constrained('variant_options')->onDelete('set null');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varient_products');
    }
};
