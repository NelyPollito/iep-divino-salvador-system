<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration

    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->integer('sender_id')->index();

            $table->integer('receiver_id')->index();

            $table->string('type', 50);

            $table->string('subject', 150);

            $table->text('body');

            $table->timestamp('read_at')->nullable();

            $table->timestamps();

            $table->foreign('sender_id')
                  ->references('iduser')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('receiver_id')
                  ->references('iduser')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};