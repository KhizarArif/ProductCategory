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
            $table->string('name');
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('subcat_id');
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->integer('price');
            $table->integer('qty');
            $table->string('photo')->nullable();
            $table->foreign('cat_id')->references('id')->on('categories');
            $table->foreign('subcat_id')->references('id')->on('subcategories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
