<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimento_caixas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agendamento_id')->nullable();

            $table->unsignedBigInteger('caixa_id');
            $table->foreign('caixa_id')->references('id')->on('caixas')
                ->onDelete('cascade');

            $table->integer('tipo'); // 0 = receita | 1 = despesa
            $table->text('descricao')->nullable();

            $table->integer('formaPag')->default(0); // 0 - Dinheiro // 1 - Pix // 2 - Cartão de Débito // 3 - Cartão de Crédito  // 4 - Transferência // 5 - Cheque // 6 - Boleto
            $table->decimal('valorPag', $precision = 15, $scale = 2)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('movimento_caixas');
    }
};
