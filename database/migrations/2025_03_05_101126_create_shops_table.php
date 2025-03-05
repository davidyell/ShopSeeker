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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->decimal('latitude', 10, 7)->index();
            $table->decimal('longitude', 10, 7)->index();
            // Do we need indexes on open and store type?
            $table->boolean('is_open');
            // TODO: Convert the store type from an Enum to association
            $table->string('store_type');
            $table->float('max_delivery_distance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
