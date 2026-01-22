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
        Schema::create('tool_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_id')->constrained()->onDelete('cascade');
            $table->string('locale', 10);
            $table->string('name');
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('faq')->nullable();
            $table->json('use_cases')->nullable();
            $table->timestamps();
            
            $table->unique(['tool_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_translations');
    }
};
