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
        Schema::create('inven_adjustments', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('entryNo');
            $table->string('reference');
            $table->decimal('quantity', 8, 2);
            $table->decimal('rate', 8, 2);
            $table->decimal('amount', 10, 2);
            $table->string('vat');
            $table->string('discount');
            $table->string('product');
            $table->string('note');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inven_adjustments');
    }
};
