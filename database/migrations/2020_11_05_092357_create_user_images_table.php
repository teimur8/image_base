<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_images', function (Blueprint $table) {
            $table->id();

            $table->string('npaId', 50);
            $table->string('fio1', 50);
            $table->string('fio2', 50);
            $table->string('qualification', 50);
            $table->string('phone', 20);
            $table->string('email', 20);
            $table->string('instagram', 50);
            $table->string('photos', 500);

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
        Schema::dropIfExists('user_images');
    }
}