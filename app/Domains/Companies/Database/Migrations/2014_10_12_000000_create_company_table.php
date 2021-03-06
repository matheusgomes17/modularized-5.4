<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('razao_social')->nullable();
            $table->string('nome_fantasia');
            $table->string('cnpj')->nullable()->index();
            $table->uuid('user_id')->nullable()->index();
            $table->string('user_type')->nullable()->index();
            $table->date('data_fundacao')->nullable()->index();
            $table->string('inscricao_estadual')->nullable();
            $table->string('telefone')->nullable()->index();
            $table->string('celular')->nullable()->index();
            $table->string('cep')->nullable()->index();
            $table->string('logradouro')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('municipio')->nullable();
            $table->string('uf')->nullable();
            $table->string('ibge')->nullable(); // cod_municipio_completo IBGE
            $table->string('site')->nullable();
            $table->text('social')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
