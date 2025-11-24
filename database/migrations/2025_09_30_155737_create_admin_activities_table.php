<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('admin_activities', function (Blueprint $table) {
            $table->id();

            // Who did it
            $table->unsignedBigInteger('admin_id')->index();

            // What happened (short code like: contact.deleted, career.deleted, profile_update_request.activated, employer.deactivated)
            $table->string('action');

            // On which record (polymorphic target; nullable for general actions)
            $table->string('subject_type')->nullable();   // e.g., App\Models\Contact
            $table->unsignedBigInteger('subject_id')->nullable();

            // Optional human message
            $table->text('message')->nullable();

            // Before/after snapshot or any extra context
            $table->json('changes')->nullable();

            // Request context
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent', 1024)->nullable();

            $table->timestamps();

            // FK note: your Admin model uses table "admin" (not "admins")
            $table->foreign('admin_id')->references('id')->on('admin')->cascadeOnDelete();
            $table->index(['subject_type', 'subject_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_activities');
    }
};
