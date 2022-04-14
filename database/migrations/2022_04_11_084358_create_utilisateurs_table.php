<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilisateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('mot_de_passe');
            $table->string('civilite')->nullable();
            $table->string('fonction');
            $table->string('specialite');
            $table->string('profession');
            $table->string('societe');
            $table->string('service');
            $table->string('adresse')->nullable();
            $table->string('code_postal');
            $table->string('ville');
            $table->string('pays');
            $table->string('telephone');
            $table->string('fax')->nullable();
            $table->string('autres')->nullable();
            $table->boolean('has_accepted_conditions')->default(true);
            $table->boolean('is_r2c_member')->nullable()->default(false);
            $table->string('api_token')->nullable();
            $table->softDeletes();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('utilisateurs');
    }
}
