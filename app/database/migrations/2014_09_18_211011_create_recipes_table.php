<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('recipes', function(Blueprint $table)
    {
      $table->increments('id');
      $table->string('title', 140);
      $table->string('slug')->unique();
      $table->text('description')->nullable()->default(null);
      $table->text('code');
      $table->integer('user_id');
      $table->integer('views')->default(0);
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
    Schema::drop('recipes');
	}

}
