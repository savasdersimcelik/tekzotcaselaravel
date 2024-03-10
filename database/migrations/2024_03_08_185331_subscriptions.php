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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('subscriberId')->index('subscriberIdIndex');
            $table->integer('subscriptionId')->index('subscriptionIdIndex');
            $table->string('subscriptionType', 10);
            $table->string('country', 2);
            $table->string('language', 2);
            $table->string('status', 10)->index('statusIndex');
            $table->string('realStatus', 10)->index('realStatusIndex');
            $table->timestamp('startDate')->index('startDateIndex');
            $table->timestamp('expireDate')->index('expireDateIndex');
            $table->timestamp('renewalDate')->nullable()->index('renewalDateIndex');
            $table->timestamp('cancelDate')->nullable()->index('cancelDateIndex');
            $table->string('cancelCode', 50)->nullable()->index('cancelCodeIndex');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
