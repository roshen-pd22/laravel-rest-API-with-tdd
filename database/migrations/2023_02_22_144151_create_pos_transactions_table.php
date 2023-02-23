<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('pos_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('id_transazione');
            $table->integer('num_tessera');
            $table->integer('circuito');
            $table->integer('progressivo_tessera');
            $table->decimal('saldo_punti');
            $table->decimal('importo_transazione');
            $table->integer('tipo_transazione');
            $table->integer('pos1');
            $table->decimal('pos1_saldo_euro');
            $table->integer('pos2');
            $table->decimal('pos2_saldo_euro');
            $table->integer('pos3');
            $table->decimal('pos3_saldo_euro');
            $table->integer('pos4');
            $table->decimal('pos4_saldo_euro');
            $table->integer('pos5');
            $table->decimal('pos5_saldo_euro');
            $table->integer('giorno')->length(2);
            $table->integer('mese')->length(2);
            $table->integer('anno')->length(4);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pos_transactions');
    }
};
