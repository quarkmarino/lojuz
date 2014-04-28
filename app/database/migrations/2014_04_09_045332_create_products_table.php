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
			$table->integer('catalog_id')->nullable()->unsigned()->index();
			$table->string('name', 64);
			$table->text('description')->nullable()->default(null);
			$table->text('tags');
			$table->enum('type', array("product", "service"))->default('product');
			$table->decimal('price', 5, 2);
			$table->integer('status')->default(1);
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
