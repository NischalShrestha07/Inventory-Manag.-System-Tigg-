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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('invoiceNo');
            $table->string('referenceNo');
            $table->date('invoiceDate');
            $table->date('dueDate');
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
        Schema::dropIfExists('invoices');
    }
};
