<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementDettesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement_dettes', function (Blueprint $table) {
            $table->id();
            $table->double('montant',64,2)->nullable();
            $table->double('montant_restant',64,2)->nullable();
            $table->foreignId('order_id');
            $table->string('status')->default('NON PAYE');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paiement_dettes');
    }
}
