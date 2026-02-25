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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->timestamps(); 
            $table->string('title');
            $table->decimal('amount', 8, 2);
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            // Laravel suit la convention de nommage anglaise, donc category et pas categorie 
            $table->foreignId('user_id')->constrained();
            $table->foreignId('colocation_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
