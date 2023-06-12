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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments("id_order");
            $table->dateTime("dt_order");
            $table->integer('amount');
            $table->string("status",10);

            $table->unsignedInteger('id_product');
            $table->foreign('id_product')->references('id_product')->on('products');

            $table->unsignedInteger('id_client');
            $table->foreign('id_client')->references('id_client')->on('clients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
