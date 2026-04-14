<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workshop_id')->constrained('workshops')->cascadeOnDelete();
            $table->foreignId('participant_id')->constrained('participants')->cascadeOnDelete();
            $table->date('registration_date');
            $table->string('payment_status')->default('Pending');
            $table->string('attendance_status')->default('Registered');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['workshop_id', 'participant_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
