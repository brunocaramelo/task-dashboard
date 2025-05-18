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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('code')->nullable()->unique();
            $table->bigInteger('rapporteur_id');
            $table->bigInteger('responsible_id')->nullable();
            $table->bigInteger('status_id');
            $table->longText('description')->nullable();


            $table->foreign('responsible_id')->references('id')->on('users');
            $table->foreign('rapporteur_id')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
