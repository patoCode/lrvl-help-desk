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
        Schema::create('grupo_usuarios', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('usuario_id');
            $table->string('tecnico_id');
            $table->string('grupo_id');
            $table->string('status', 10);
            $table->timestamps();

            $table->foreign('usuario_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('tecnico_id')
                ->references('id')
                ->on('tecnicos')
                ->onDelete('cascade');

            $table->foreign('grupo_id')
                ->references('id')
                ->on('grupos')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo_usuarios');
    }
};
