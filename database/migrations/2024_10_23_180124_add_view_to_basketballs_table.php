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
        Schema::table('basketballs', function (Blueprint $table) {
            $table->unsignedBigInteger('views')->default(0);
            $table->integer(column: 'likes')->default(0); // Default 0 likes
            $table->foreignId('basketball_id')->constrained()->onDelete('cascade'); $table->dropColumn('views');
             
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('basketballs', function (Blueprint $table) {
            $table->dropColumn('views');
            $table->dropColumn('likes');
            $table->dropColumn('basketball_id');
        });
    }
};
