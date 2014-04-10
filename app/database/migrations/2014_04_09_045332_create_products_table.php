<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('catalog_id')->unsigned()->index();
			$table->string('name', 64);
			$table->text('tags')->nullable();
			$table->enum('type', array("product", "service"))->default('product');
			$table->decimal('price', 5, 2);
			$table->timestamps();

			$table->foreign('catalog_id')->references('id')->on('catalogs')->onUpdate('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
