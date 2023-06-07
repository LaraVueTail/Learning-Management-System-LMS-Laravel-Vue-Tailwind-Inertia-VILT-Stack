<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('video');
            $table->text('description')->unique();
            $table->string('thumbnail')->nullable();
            $table->foreignId('course_id');
            $table->timestamps();
        });

        // $chapters = DB::connection()->table('chapters')->get();

        // foreach($chapters as $chapter)
        // {
        //    $chapter->order = $chapter->id;
        //    $chapter->save();
        // }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
