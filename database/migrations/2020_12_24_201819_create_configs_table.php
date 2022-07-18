<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('title',100)->nullable();
            $table->string('acronym',50)->nullable();
            $table->string('image',100)->nullable();
            $table->string('creci',100)->nullable();
            $table->string('cpf_cnpj',100)->nullable();
            $table->string('favicon',100)->nullable();
            $table->longText('about')->nullable();
            $table->string('slug',150)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_tags')->nullable();
            $table->longText('email_happy')->nullable();
            $table->string('postalCode')->nullable();
            $table->string('number')->nullable();
            $table->string('address')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('complement')->nullable();
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
        Schema::dropIfExists('configs');
    }
}
