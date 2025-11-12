<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();

            // if you want to link logged-in user comments:
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->string('author_name')->nullable(); // for guest
            $table->string('author_email')->nullable();
            $table->text('body');

            $table->boolean('is_approved')->default(false);
            $table->timestamps();

            $table->index(['post_id', 'is_approved']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
