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
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('external_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('brand');
            $table->string('sku');
            $table->tinyInteger('status');
            $table->timestampsTz();
        });

        Schema::create('goods_property', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id')->index();
            $table->unsignedBigInteger('goods_id')->index();
            $table->string('value');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods');
        Schema::dropIfExists('goods_property');
    }
};
