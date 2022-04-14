<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('mots_cles')->nullable();
            $table->json('auteurs');
            $table->longText('contenu')->nullable();
            $table->enum('status', ['brouillon','soumis', 'relecture', 'termine']);
            $table->foreignId('utilisateur_id')
            ->constrained()
            ->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('resumes');
    }
}
