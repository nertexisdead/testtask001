<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitor_visits', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_key', 64)->index();
            $table->string('ip', 45)->nullable()->index();
            $table->string('city')->nullable()->index();
            $table->string('device')->nullable()->index();
            $table->text('user_agent')->nullable();
            $table->text('page_url')->nullable();
            $table->timestamp('visited_at')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_visits');
    }
};
