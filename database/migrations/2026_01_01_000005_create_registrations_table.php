<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('conference_session_id')->constrained('conference_sessions')->cascadeOnDelete();
            $table->enum('status', ['registered', 'cancelled'])->default('registered');
            $table->timestamps();

            $table->unique(['user_id', 'conference_session_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
