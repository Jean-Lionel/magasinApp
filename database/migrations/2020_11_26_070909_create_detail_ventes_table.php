<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_ventes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')->references('products')->on('id');
            $table->float('quantite');
            $table->double('price_unitaire',62,2);
            $table->string('code_product')->nullable();
            $table->string('name')->nullable();
            $table->string('unite_mesure')->nullable();
            $table->date('date_expiration');
            $table->foreignId('vente_id')->references('ventes')->on('id')->onDelete('cascade');
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
        Schema::dropIfExists('detail_ventes');
    }
}
