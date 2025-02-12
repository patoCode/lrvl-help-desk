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
        Schema::create('configuration_bitacoras', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->text('event');
            $table->string('key',50);
            $table->text('string_value');
            $table->decimal('numeric_value',18,6);
            $table->string('registry_by')->nullable(false);
            $table->string('status',10);
            $table->string('configuration_id');
            $table->timestamps();

            $table->foreign('configuration_id')
                ->references('id')
                ->on('configurations')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuration_bitacoras');
    }
};
