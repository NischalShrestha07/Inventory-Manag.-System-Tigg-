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
            $table->integer('entryNum');
            $table->string('reference');
            $table->bigInteger('amount');
            $table->text('note');

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
