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
        Schema::create('colas', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->integer('ultima_asignacion')->default(0);
            $table->string('category_id')->nullable(false);
            $table->string('status',10);
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categoria')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colas');
    }
};
