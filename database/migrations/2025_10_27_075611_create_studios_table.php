<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('studios', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('capacity');
            $table->json('layout')->nullable(); // untuk denah kursi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('studios');
    }
};
