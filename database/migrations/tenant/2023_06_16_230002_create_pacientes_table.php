<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('nome_social')->nullable();
            $table->date('dtnascimento');
            $table->tinyInteger('sexo')->default(0); // 0 - masculino | 1 - feminino
            $table->string('cpf')->nullable();
            $table->string('celular')->nullable();
            $table->string('cep')->nullable();
            $table->string('end_rua')->nullable();
            $table->string('end_numero')->nullable();
            $table->string('end_complemento')->nullable();
            $table->string('end_bairro')->nullable();
            $table->string('end_cidade')->nullable();

            $table->string('nome_mae')->nullable();
            $table->string('resp_menor')->nullable();
            $table->string('resp_cpf')->nullable();

            $table->string('cod_acesso')->nullable();
            $table->string('senha_acesso')->nullable();

            $table->boolean('newsletter')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
