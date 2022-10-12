<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oficinas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('tiempo_por_paciente');
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->unsignedInteger('edad');
            $table->foreignId('oficina_id')->constrained('oficinas');
            $table->string('direccion');
            $table->string('genero');
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
        Schema::create('cita_medicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors');
            $table->foreignId('paciente_id')->constrained('pacientes');
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
        Schema::create('diagnosticos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes');
            $table->text('descripcion');
            $table->boolean('estado')->default(true);
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
        Schema::dropIfExists('oficinas');
        Schema::dropIfExists('pacientes');
        Schema::dropIfExists('doctors');
        Schema::dropIfExists('cita_medicas');
        Schema::dropIfExists('diagnosticos');
    }
}
