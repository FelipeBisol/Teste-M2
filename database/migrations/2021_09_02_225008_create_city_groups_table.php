<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityGroupsTable extends Migration
{

    public function up(){
        Schema::create('city_groups', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description");
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(){
        Schema::dropIfExists('city_groups');
    }
}
