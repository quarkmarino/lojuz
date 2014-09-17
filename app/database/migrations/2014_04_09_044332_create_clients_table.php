<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clients', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->string('name', 255);
			$table->text('comment')->nullable();
			$table->date('since')->nullable();
			$table->integer('status')->default(1);
			$table->string('unique', 255);
			$table->string('logo', 255);
			$table->string('largethumb', 255);
			$table->string('thumb', 255);
			$table->string('slide', 255);
			$table->string('tinythumb', 255);
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clients');
	}

}
