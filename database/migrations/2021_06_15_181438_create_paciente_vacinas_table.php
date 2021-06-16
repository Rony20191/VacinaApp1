<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacienteVacinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paciente_vacinas', function (Blueprint $table) {
            $table->id();
            $table->date('data_vacinacao');
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('vacina_id');
            $table->unsignedBigInteger('dose_id');
            $table->boolean('reincidencia');
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->foreign('vacina_id')->references('id')->on('vacinas');
            $table->foreign('dose_id')->references('id')->on('doses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paciente_vacinas');
    }
}
