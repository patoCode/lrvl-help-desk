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
        Schema::create('solicitud', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->text('description');
            $table->text('code')->nullable(false);
            $table->text('priority')->nullable(false);
            $table->string('registry_by')->nullable(false);
            $table->string('updated_by');
            $table->boolean('is_promediable')->default(true);
            $table->string('category_id');
            $table->string('usuario_id');
            $table->string('tecnico_id')->nullable();
            $table->string('cola_id')->nullable();
            $table->string('status',10);
            $table->timestamps();


            $table->foreign('category_id')
                ->references('id')
                ->on('categoria')
                ->onDelete('cascade');

            $table->foreign('usuario_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

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
        Schema::dropIfExists('solicituds');
    }
};
