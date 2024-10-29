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
        Schema::create('licitaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->unsignedBigInteger('id_usuario')->index();
            $table->unsignedBigInteger('id_estado')->index();
            $table->unsignedBigInteger('id_cliente')->index();
            $table->foreign('id_usuario')->references('id')->on('usuarios');
            $table->foreign('id_estado')->references('id')->on('estados');
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licitaciones');
    }
};
