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
        Schema::create('tour_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id');
            $table->unsignedBigInteger('tag_id');

            $table->index('tour_id', 'tour_tag_tour_idx');
            $table->index('tag_id', 'tour_tag_tag_idx');

            $table->foreign('tour_id', 'tour_tag_tour_fk')->on('tours')->references('id');
            $table->foreign('tag_id', 'tour_tag_tag_fk')->on('tags')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_tags');
    }
};
