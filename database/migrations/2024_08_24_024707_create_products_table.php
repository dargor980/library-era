<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreign("category_id")->references("id")->on("categories");
            $table->foreign("unit_type_id")->references("id")->on("unit_types");
            $table->foreign("stock_id")->references("id")->on("stocks");
            $table->string("name");
            $table->integer("price");
            $table->integer("cost");
            $table->integer("profit");
            $table->timestamps();
            
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("unit_type_id");
            $table->unsignedBigInteger("stock_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
