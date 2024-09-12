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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('referenceNo');
            $table->string('orderNo');
            $table->date('date');
            $table->string('cterms');
            $table->string('stage');
            $table->string('account');
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
        Schema::dropIfExists('purchase_orders');
    }
};
