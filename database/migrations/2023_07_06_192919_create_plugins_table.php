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
        // 'base', 'name', 'path', 'github_url', 'active', 'author'
        Schema::create('plugins', function (Blueprint $table) {
            $table->id();
            $table->string('base', 50);
            $table->string('name', 50);
            $table->string('path', 50);
            $table->text('github_url');
            $table->boolean('active')->default(1);
            $table->string('author', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plugins');
    }
};
