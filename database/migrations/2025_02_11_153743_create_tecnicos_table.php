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
        Schema::create('tecnicos', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('usuario_id');
            $table->string('registry_by');
            $table->string('updated_by');
            $table->string('status',10);
            $table->timestamps();

            $table->foreign('usuario_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tecnicos');
    }
};
