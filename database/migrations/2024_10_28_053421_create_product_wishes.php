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
        Schema::create('product_wishes', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('product_id');

            $table->foreign('product_id')->references('id')->on('products')->restrictOnDelete()->restrictOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_wishes');
    }
};
