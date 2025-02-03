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
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
             $table->text('description')->nullable();
              $table->string('author'); 
              $table->string('file_url'); // URL to the e-book file
               $table->string('cover_image_url')->nullable(); // URL to the cover image 
               $table->date('published_date')->nullable();
                $table->enum('status', ['available', 'unavailable'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ebooks');
    }
};
