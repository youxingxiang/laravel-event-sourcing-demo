<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodStockFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_stock_flows', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('good_id')->default(0);
            $table->unsignedInteger('num')->default(0);
            $table->unsignedTinyInteger('type')->default(0);
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
        Schema::dropIfExists('good_stock_flows');
    }
}
