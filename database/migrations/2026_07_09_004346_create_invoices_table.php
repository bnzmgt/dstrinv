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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('invoice_number', 50)->unique();

            $table->string('title');

            $table->date('issue_date');
            $table->date('due_date');

            $table->string('status', 30)
                ->default('draft');

            $table->longText('notes')->nullable();

            $table->timestamp('sent_at')->nullable();
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();

            $table->index('project_id');
            $table->index('status');
            $table->index('due_date');
            $table->index('paid_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};