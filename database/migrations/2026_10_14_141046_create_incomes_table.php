<?php

use App\Enums\IncomeCategory;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('amount', unsigned: true);
            $table->string('note')->nullable();
            $table->date('date')->useCurrent();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->enum('category', IncomeCategory::cases());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
