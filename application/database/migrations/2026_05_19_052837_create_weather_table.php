<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weathers', function (Blueprint $table) {
            $table->id();
            $table->decimal('latitude', 8, 5);
            $table->decimal('longitude', 8, 5);
            $table->timestamp('weather_time');
            $table->integer('interval')->nullable();
            $table->float('temperature')->nullable();
            $table->float('windspeed')->nullable();
            $table->integer('winddirection')->nullable();
            $table->boolean('is_day')->default(true);
            $table->integer('weathercode')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weathers');
    }
};
