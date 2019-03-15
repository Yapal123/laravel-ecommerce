<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('secname');
            $table->string('email');
            $table->string('adress');
            $table->integer('phone');
            $table->string('comment');
            $table->integer('prod_id');
            $table->string('prod_name');
            $table->integer('prod_price');
            $table->integer('prod_quantity');
            $table->integer('prod_subtotal');
            $table->integer('delivery');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
           

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
