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
        Schema::create('debit_notes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('referenceNo');
            $table->date('date');
            $table->string('product');
            $table->decimal('quantity', 8, 2);
            $table->decimal('rate', 8, 2);
            $table->decimal('discount', 5, 2);
            $table->decimal('vat', 5, 2)->nullable();
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
        // ccscls
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debit_notes');
    }
};
