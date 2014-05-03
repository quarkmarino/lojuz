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
			$table->integer('catalog_id')->nullable()->unsigned()->index();
			$table->integer('product_id')->nullable()->unsigned()->index();
			$table->string('name', 255);
			$table->string('dirname', 255);
			$table->string('file', 255);
			$table->string('largethumb', 255);
			$table->string('thumb', 255);
			$table->string('minithumb', 255);
			$table->string('slide', 255);
			$table->integer('status')->default(1);
			$table->text('comment');
			$table->timestamps();

			$table->foreign('gallery_id')->references('id')->on('galleries')->onUpdate('cascade');
			$table->foreign('catalog_id')->references('id')->on('catalogs')->onUpdate('cascade');
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
