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
        Schema::create('vista_rols', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('rol_id');
            $table->string('vista_id');
            $table->string('status', 10);
            $table->timestamps();

            $table->foreign('vista_id')
                ->references('id')
                ->on('vistas')
                ->onDelete('cascade');

            $table->foreign('rol_id')
                ->references('id')
                ->on('rols')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vista_rols');
    }
};
