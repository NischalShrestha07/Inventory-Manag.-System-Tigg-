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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->string('tax');
            $table->unsignedBigInteger('primary_unit');
            $table->string('hscode');
            $table->timestamps();


            $table->foreign('primary_unit')->references('id')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });
        Schema::table('u_o_m_s', function (Blueprint $table) {
            $table->dropForeign(['primary_unit']);
        });

        Schema::dropIfExists('products');
    }
};
