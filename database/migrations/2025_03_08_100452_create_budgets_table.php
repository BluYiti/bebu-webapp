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
        Schema::create('budgets', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Ensure using InnoDB
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key for user
            $table->string('category'); // Category of the budget (e.g., groceries, rent)
            $table->decimal('amount', 10, 2); // Budgeted amount
            $table->date('start_date'); // Start date of the budget period
            $table->date('end_date'); // End date of the budget period
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
