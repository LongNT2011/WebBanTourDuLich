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
        Schema::create('tourdetails', function (Blueprint $table) {
            $table->id();
            $table->date('checkInDate');
            $table->date('checkOutDate');
            $table->string('vehicle');
            $table->integer('maxParticipant');
            $table->integer('childrenPrice');
            $table->integer('adultPrice');
            $table->integer('discount')->nullable();
            $table->string('depatureLocation');
            $table->text('tripDescription')->nullable();
            $table->foreignId('tour_id')->constrained('tours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourdetails');
    }
};
