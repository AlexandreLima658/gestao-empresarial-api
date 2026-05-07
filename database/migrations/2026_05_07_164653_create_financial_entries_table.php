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
        Schema::create('financial_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enterprise_id')->constrained('enterprises');
            $table->foreignId('cost_center_id')->constrained('cost_centers');
            $table->string('description');
            $table->decimal('amount', 12, 2);
            $table->string('type');
            $table->date('entry_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_entries');
    }
};
