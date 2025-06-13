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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->date('date')->nullable();
            $table->string('gender')->nullable();
            $table->string('NIK')->nullable();
            $table->string('social_media_account')->nullable();
            $table->string('agree_handbook')->nullable();
            $table->string('proof')->nullable();
            $table->string('booking_trx_id')->nullable();

            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('sub_total_amount');
            $table->unsignedBigInteger('grand_total_amount');

            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            $table->softDeletes();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
