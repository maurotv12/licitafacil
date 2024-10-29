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
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ruta');
            $table->unsignedBigInteger('id_tipo_archivo')->index();
            $table->unsignedBigInteger('id_licitacion')->index();
            $table->foreign('id_tipo_archivo')->references('id')->on('tipo_archivos');
            $table->foreign('id_licitacion')->references('id')->on('licitaciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivos');
    }
};
