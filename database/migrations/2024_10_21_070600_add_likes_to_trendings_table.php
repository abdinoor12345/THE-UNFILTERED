<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
     public function up()
     {
         Schema::table('trendings', function (Blueprint $table) {
             $table->integer(column: 'likes')->default(0); // Default 0 likes
         });
     }
     
     public function down()
     {
         Schema::table('trendings', function (Blueprint $table) {
             $table->dropColumn('likes');
         });
     }
     
};
