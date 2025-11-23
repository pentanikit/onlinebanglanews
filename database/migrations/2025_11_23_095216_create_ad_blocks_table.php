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
        Schema::create('ad_blocks', function (Blueprint $table) {
            $table->id();

            
            $table->string('position_key')->default('home_sidebar');

            
            $table->unsignedTinyInteger('slot')->comment('Ad block number (1-5)');

            
            $table->string('title')->nullable();

            
            $table->string('image')->nullable();

            
            $table->string('url')->nullable();

            
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            
            $table->unique(['position_key', 'slot']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_blocks');
    }
};
