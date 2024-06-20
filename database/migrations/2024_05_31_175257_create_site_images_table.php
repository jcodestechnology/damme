<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteImagesTable extends Migration
{
    public function up()
    {
        Schema::create('site_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('site_id');
            $table->string('image_path');
            $table->timestamps();

            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_images');
    }
}

