<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip_hash', 64)->index();
            $table->string('user_agent', 500)->nullable();
            $table->string('referrer', 500)->nullable();
            $table->string('page', 500)->index();
            $table->string('country', 100)->nullable();
            $table->string('device_type', 20)->nullable();
            $table->timestamps();

            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
