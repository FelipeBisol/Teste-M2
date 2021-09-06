<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('discount_type');
            $table->integer('discount_value');
            $table->foreignId('campaigns_id')->constrained('campaigns');
            $table->foreignId('products_id')->constrained('products');
            $table->bigInteger('price');
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
        Schema::dropIfExists('product_campaigns');
    }
}
