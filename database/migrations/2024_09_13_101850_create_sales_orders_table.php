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
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('orderno');
            $table->string('referenceno');
            $table->date('date');
            $table->string('deliverydate');
            $table->string('stage');
            $table->decimal('quantity', 8, 2);
            $table->decimal('rate', 8, 2);
            $table->decimal('discount', 5, 2);
            $table->decimal('vat', 5, 2)->nullable();
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};
