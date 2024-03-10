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
            $table->uuid('id')->primary();
            $table->uuid('subscriptionId')->index('subscriptionIdIndex');
            $table->uuid('originalTransactionId')->index('originalTransactionIdIndex');
            $table->uuid('lastTransactionId');
            $table->uuid('providerTransactionId')->nullable();
            $table->uuid('paymentHash')->nullable();
            $table->string('paymentProvider', 20)->nullable();
            $table->string('providerStatus', 20)->nullable();
            $table->string('paymentStatus', 20)->nullable();
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
