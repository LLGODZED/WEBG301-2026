<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConferenceSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('conference_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('level')->default('Beginner');
            $table->enum('status', ['draft', 'published', 'cancelled'])->default('published');
            $table->unsignedInteger('max_attendees')->default(30);
            $table->foreignId('room_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('speaker_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('track_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();

            $table->index(['start_time', 'end_time']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('conference_sessions');
    }
}
