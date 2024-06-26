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
        Schema::create('fruit_vegetable', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('image_url');
            $table->string('tipo'); // 'fruit' or 'vegetable'
            $table->string('descripcion');
            $table->decimal('precio_unidad', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fruit_vegetable');
    }
};
