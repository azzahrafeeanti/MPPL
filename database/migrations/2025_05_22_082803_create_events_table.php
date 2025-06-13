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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->date('date');
            $table->time('time');
            $table->string('location');
            $table->string('photo');
            $table->unsignedBigInteger('stock');
            $table->unsignedBigInteger('price');
            $table->boolean('in_stock')->default(true);
            $table->boolean('is_active')->default(true);

            $table->foreignId('ticket_id')->constrained()->cascadeOnDelete();
            
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
