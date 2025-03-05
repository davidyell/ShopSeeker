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
        Schema::create('postcodes', function (Blueprint $table) {
            $table->id();
            $table->string('pcd')->index();
            $table->string('pcd2')->index();
            $table->string('pcds')->index();
            $table->string('dointr');
            $table->string('doterm')->nullable();
            $table->string('oscty')->nullable();
            $table->string('ced')->nullable();
            $table->string('oslaua')->nullable();
            $table->string('osward')->nullable();
            $table->string('parish')->nullable();
            $table->string('usertype');
            $table->integer('oseast1m');
            $table->integer('osnrth1m');
            $table->string('osgrdind');
            $table->string('oshlthau')->nullable();
            $table->string('nhser')->nullable();
            $table->string('ctry');
            $table->string('rgn')->nullable();
            $table->string('streg')->nullable();
            $table->string('pcon')->nullable();
            $table->string('eer')->nullable();
            $table->string('teclec')->nullable();
            $table->string('ttwa')->nullable();
            $table->string('pct')->nullable();
            $table->string('itl')->nullable();
            $table->string('statsward')->nullable();
            $table->string('oa01')->nullable();
            $table->string('casward')->nullable();
            $table->string('park')->nullable();
            $table->string('lsoa01')->nullable();
            $table->string('msoa01')->nullable();
            $table->string('ur01ind')->nullable();
            $table->string('oac01')->nullable();
            $table->string('oa11')->nullable();
            $table->string('lsoa11')->nullable();
            $table->string('msoa11')->nullable();
            $table->string('wz11')->nullable();
            $table->string('ccg')->nullable();
            $table->string('bua11')->nullable();
            $table->string('buasd11')->nullable();
            $table->string('ru11ind')->nullable();
            $table->string('oac11')->nullable();
            $table->decimal('lat', 10, 7)->index();
            $table->decimal('long', 10, 7)->index();
            $table->string('lep1')->nullable();
            $table->string('lep2')->nullable();
            $table->string('pfa')->nullable();
            $table->integer('imd')->nullable();
            $table->string('calncv')->nullable();
            $table->string('stp')->nullable();
            $table->string('oa21')->nullable();
            $table->string('lsoa21')->nullable();
            $table->string('msoa21')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postcodes');
    }
};
