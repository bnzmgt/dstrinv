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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('invoice_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->date('payment_date');

            $table->decimal('amount', 15, 2);

            $table->string('payment_method', 50);

            $table->string('reference_number', 100)->nullable();

            $table->longText('notes')->nullable();

            $table->timestamps();

            $table->index('invoice_id');
            $table->index('payment_date');
            $table->index('payment_method');
            $table->index('reference_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};