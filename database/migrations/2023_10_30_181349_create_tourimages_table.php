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
        Schema::create('tourimages', function (Blueprint $table) {
            $table->id();
            $table->string('imageUrl')->nullable();
            $table->timestamps();
            $table->foreignId('tour_detail_id')->constrained('tourdetails')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourimages');
    }
};
