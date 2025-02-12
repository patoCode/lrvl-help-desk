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
        Schema::create('configurations', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('nombre')->nullable(false);
            $table->text('description')->nullable(false);
            $table->string('key',50)->nullable(false);
            $table->text('string_value');
            $table->decimal('numeric_value',18,6);
            $table->string('registry_by')->nullable(false);
            $table->string('status', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
};
