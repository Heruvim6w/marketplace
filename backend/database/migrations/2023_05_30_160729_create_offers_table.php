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
            $table->id();
            $table->timestampTz('order_date')->nullable()->comment('Дата оформления заказа');
            $table->unsignedBigInteger('buyer_id');
            $table->unsignedBigInteger('delivery_id');
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('goods_id');
            $table->timestampsTz();
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
