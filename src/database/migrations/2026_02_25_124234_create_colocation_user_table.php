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
        Schema::create('colocation_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps(); 
            $table->foreignId('user_id')->constrained();
            $table->foreignId('colocation_id')->constrained()->onDelete('cascade');
            $table->enum('role',['owner', 'member'])->default('member');
            $table->decimal('balance', 10, 2)->default(0.00);
            $table->dateTime('left_at')->nullable();
            $table->unique(['user_id', 'colocation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colocation_user');
    }
};
