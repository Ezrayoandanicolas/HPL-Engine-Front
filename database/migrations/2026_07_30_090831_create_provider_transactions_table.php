<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provider_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('agent_sign', 100)->unique();
            $table->string('username', 100);
            $table->decimal('amount', 18, 2)->default(0);
            $table->string('type', 30)->comment('user_deposit / user_withdraw / user_withdraw_reset');
            $table->string('status', 20)->default('pending')->comment('pending / success / failed');
            $table->string('message', 255)->nullable();
            $table->text('response_raw')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provider_transactions');
    }
};
