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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('category');  
            $table->decimal('price', 10, 2);  
            $table->integer('stock');  
            $table->string('image_url'); 
            $table->string('type'); // Type of item (e.g., "Shoes", "Jersey", "Ball")
            $table->string('size')->nullable(); // Size (e.g., "Small", "Medium", "Large" for jerseys, or shoe sizes)
            $table->string('brand')->nullable(); // Brand (e.g., "Nike", "Adidas", "Puma")
            $table->boolean('is_available')->default(true);  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
