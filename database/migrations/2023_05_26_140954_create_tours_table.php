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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('is_public')->default(0);
            $table->string('image');
            $table->unsignedBigInteger('likes')->nullable();
            $table->string('title');
            $table->text('description');
            $table->string('price');
            $table->string('currency');
            $table->string('hotel_stars');
            $table->string('city');
            $table->text('tour_composition');
            $table->text('amenities');
            $table->unsignedBigInteger('days');
            $table->unsignedBigInteger('nights');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
