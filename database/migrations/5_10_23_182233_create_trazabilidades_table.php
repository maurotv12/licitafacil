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
        Schema::create('trazabilidades', function (Blueprint $table) {
            $table->id();
            $table->longText('descripcion');
            $table->unsignedBigInteger('id_archivo')->nullable()->index();
            $table->unsignedBigInteger('id_licitacion')->nullable()->index();
            $table->unsignedBigInteger('id_tipo_trazabilidad')->nullable()->index();
            $table->unsignedBigInteger('id_usuario')->nullable()->index();
            $table->unsignedBigInteger('id_usuario_trazabilidad')->index();
            $table->foreign('id_archivo')->references('id')->on('archivos');
            $table->foreign('id_licitacion')->references('id')->on('licitaciones');
            $table->foreign('id_tipo_trazabilidad')->references('id')->on('tipo_trazabilidades');
            $table->foreign('id_usuario')->references('id')->on('usuarios');
            $table->foreign('id_usuario_trazabilidad')->references('id')->on('usuarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trazabilidades');
    }
};
