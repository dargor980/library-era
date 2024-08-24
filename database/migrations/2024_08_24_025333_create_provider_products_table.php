<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("provider_id");
            $table->unsignedBigInteger("product_id");
            $table->timestamps();

            $table->foreign("provider_id")->references("id")->on("providers");
            $table->foreign("product_id")->references("id")->on("products");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provider_products');
    }
}
