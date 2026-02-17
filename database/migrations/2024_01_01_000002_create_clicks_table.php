<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clicks', function (Blueprint $table) {
            $table->id();
            $table->string('ip_hash', 64)->index();
            $table->string('button_id', 100)->index();
            $table->string('button_label', 200)->nullable();
            $table->string('page', 500);
            $table->string('user_agent', 500)->nullable();
            $table->timestamps();

            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clicks');
    }
};
