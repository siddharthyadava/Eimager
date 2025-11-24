<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('register_data')) {
        Schema::create('register_data', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('password');
            $table->string('aadhar_number');
            $table->string('pan_number');
            $table->string('dob');
            $table->string('unique_id');
            $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('register_data');
    }
};

