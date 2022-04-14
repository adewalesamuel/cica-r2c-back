<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pack_id')
            ->constrained()
            ->onDelete('cascade');
            $table->foreignId('programme_id')
            ->constrained()
            ->onDelete('cascade');
            $table->foreignId('utilisateur_id')
            ->constrained()
            ->onDelete('cascade');
            $table->integer('prix')->unsigned();
            $table->string('mode_paiement');
            $table->enum('status_paiement', ['paye', 'en-attente', 'annule']);
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
        Schema::dropIfExists('inscriptions');
    }
}
