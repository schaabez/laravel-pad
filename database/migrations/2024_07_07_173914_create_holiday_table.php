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
        Schema::create('holiday', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('country')->nullable();
            $table->integer("day");
            $table->integer("month");
            $table->string('name');
            $table->boolean("stateHoliday")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('holiday');
    }
};
