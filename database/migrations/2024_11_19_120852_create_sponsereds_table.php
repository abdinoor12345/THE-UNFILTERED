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
        Schema::create('sponsereds', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->text('header1');  

            $table->text('content1'); 
            $table->text('header2')->nullable();  
            $table->text('content2')->nullable(); 
            $table->text('header3')->nullable();  
            $table->text('content3')->nullable();  
            $table->string('image_url')->nullable();
             $table->string('slug');
             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

             $table->unsignedBigInteger('user_id');  
             $table->unsignedBigInteger('views')->default(0);  
             $table->unsignedBigInteger('likes')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsereds');
    }
};
