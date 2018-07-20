<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
  		Schema::defaultStringLength(191);
  		Schema::create('auction', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('user_id')->unsigned()->nullable();
              $table->integer('currentbidderid')->unsigned()->nullable();
  			      $table->string('itemname');
              $table->float('minbid',8,2);
			        $table->float('currentbid',8,2);
			        $table->string('currentbidder')->nullable();
              $table->float('buyout',8,2)->nullable();
              $table->foreign('currentbidderid')->references('id')->on('users');
              $table->foreign('user_id')->references('id')->on('users');
              $table->string('description');
			        $table->string('itemlocation');
              $table->string('itemimage')->nullable();
              $table->string('date');
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
        Schema::dropIfExists('auction');
    }
}
