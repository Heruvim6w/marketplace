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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('goods_id')->index();
            $table->unsignedBigInteger('external_id');
            $table->string('sku');
            $table->decimal('price');
            $table->decimal('old_price');
            $table->integer('quantity')->nullable();
            $table->boolean('available')->default(true);
            $table->timestampsTz();
        });

        Schema::create('property_proposal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id')->index();
            $table->unsignedBigInteger('proposal_id')->index();
            $table->string('value');
            $table->timestampsTz();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proposal_id')->index();
            $table->string('type')->nullable();
            $table->string('url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
        Schema::dropIfExists('proposal_property');
        Schema::dropIfExists('images');
    }
};
