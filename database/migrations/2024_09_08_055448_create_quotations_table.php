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
        // Schema::create('quotations', function (Blueprint $table) {
        //     // $table->id();
        //     // $table->string('customer_name');
        //     // $table->date('date');
        //     // $table->date('expiry_date');
        //     // $table->string('currency');


        //     // $table->string('credit_notes');
        //     // $table->string('product_name');
        //     // $table->text('terms');

        //     // $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
