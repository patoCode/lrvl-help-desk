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
        Schema::create('tecnico_colas', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->integer('order');
            $table->string('tecnico_id');
            $table->string('cola_id');
            $table->string('status', 10);
            $table->string('registry_by');
            $table->timestamps();

            $table->foreign('tecnico_id')
                ->references('id')
                ->on('tecnicos')
                ->onDelete('cascade');

            $table->foreign('cola_id')
                ->references('id')
                ->on('colas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tecnico_colas');
    }
};
