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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agendamento_id');
            $table->foreign('agendamento_id')->references('id')->on('agendamentos')
                ->onDelete('cascade');

            $table->unsignedBigInteger('caixa_id');
            $table->foreign('caixa_id')->references('id')->on('caixas')
                ->onDelete('cascade');

            $table->string('dinheiro')->nullable();
            $table->string('pix')->nullable();
            $table->string('boleto')->nullable();
            $table->string('transferencia')->nullable();
            $table->string('ct_debito')->nullable();
            $table->string('ct_credito')->nullable();
            $table->decimal('total', $precision = 15, $scale = 2);

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
        Schema::dropIfExists('pagamentos');
    }
};
