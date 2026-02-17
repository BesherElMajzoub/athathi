<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('district_pages', function (Blueprint $table) {
            $table->id();
            $table->string('cluster_key', 50)->index();
            $table->string('cluster_name_ar', 100);
            $table->string('neighborhood_name_ar', 100);
            $table->string('neighborhood_slug', 100)->unique();
            $table->string('meta_title', 200)->nullable();
            $table->string('meta_description', 300)->nullable();
            $table->longText('content_ar');
            $table->json('faqs')->nullable();
            $table->json('landmarks')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft')->index();
            $table->integer('word_count')->default(0);
            $table->timestamps();

            $table->index(['cluster_key', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('district_pages');
    }
};
