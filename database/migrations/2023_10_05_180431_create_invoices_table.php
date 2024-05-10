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

            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->integer('count_id')->unique();
            $table->string('code', 50);
            $table->date('date');
            $table->decimal('sub_total', 20, 2);
            $table->decimal('discount', 20, 2);
            $table->decimal('grand_total', 20, 2);
            $table->decimal('amount_paid', 20, 2)->default(0.00);
            $table->decimal('amount_due', 20, 2);
            $table->text('note')->nullable();
            $table->string('payment_status');
            $table->foreignId('user_id')->constrained();

            $table->timestamps();
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
