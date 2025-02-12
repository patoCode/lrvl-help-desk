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
        Schema::create('solicitud_bitacoras', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->integer('nro_evento')->default(0);
            $table->text('evento');
            $table->text('observacion');
            $table->string('registry_by')->nullable(false);
            $table->string('usuario_id');
            $table->string('category_id');
            $table->string('solicitud_id');
            $table->string('tecnico_id');
            $table->string('status_bitacora',10);
            $table->string('status',10);
            $table->timestamps();

            $table->foreign('usuario_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('categoria')
                ->onDelete('cascade');

            $table->foreign('solicitud_id')
                ->references('id')
                ->on('solicitud')
                ->onDelete('cascade');

            $table->foreign('tecnico_id')
                ->references('id')
                ->on('tecnicos')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_bitacoras');
    }
};
