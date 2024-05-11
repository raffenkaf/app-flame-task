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
        Schema::create('oblasts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->polygon('area_as_polygon')->nullable()->default(null);
            $table->multiPolygon('area_as_multipolygon')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oblasts');
    }
};
