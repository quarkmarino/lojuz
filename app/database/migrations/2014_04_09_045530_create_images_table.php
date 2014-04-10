<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('gallery_id')->nullable()->unsigned()->index();
			$table->integer('product_id')->nullable()->unsigned()->index();
			$table->string('name');
			$table->string('url');
			$table->integer('status');
			$table->text('comment');
			$table->timestamps();

			$table->foreign('gallery_id')->references('id')->on('galleries')->onUpdate('cascade');
			$table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('images');
	}

}
