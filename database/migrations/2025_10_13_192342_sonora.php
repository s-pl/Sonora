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
        Schema::create('sonora', function (Blueprint $table) {
          // A spotify like app model
            $table->id();
            $table->string('name');
            $table->string('artist');
            $table->string('album');
            $table->string('genre');
            $table->integer('year');
            $table->string('cover_url');
            $table->longText('audio_file');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
