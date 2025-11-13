<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('menu_id')
                ->constrained('menus')
                ->cascadeOnDelete();

            // Self-referencing parent (for nested menus)
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('menu_items')
                ->nullOnDelete();

            // Data
            $table->string('label');
            $table->string('url')->nullable();          // e.g. /news, https://...
            $table->string('type')->nullable();         // 'custom', 'category', 'page'
            $table->unsignedBigInteger('reference_id')->nullable(); // ID of referenced entity
            $table->unsignedInteger('order_column')->default(0);    // for sorting

            $table->timestamps();

            // Helpful indexes
            $table->index(['menu_id', 'parent_id', 'order_column']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
