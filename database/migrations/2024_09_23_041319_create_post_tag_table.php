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
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // Foreign key ke tabel 'posts'
            $table->foreignId('tag_id')->constrained()->onDelete('cascade'); // Foreign key ke tabel 'tags'
            $table->timestamps();

            $table->unique(['post_id', 'tag_id']); // Mencegah duplikasi pasangan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tag');
    }
};
