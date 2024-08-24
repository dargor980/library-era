<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("sale_id");
            $table->unsignedBigInteger("product_id");
            $table->integer("quantity");
            $table->integer("subtotal");
            $table->timestamps();

            $table->foreign("sale_id")->references("id")->on("sales");
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
        Schema::dropIfExists('content_sales');
    }
}
